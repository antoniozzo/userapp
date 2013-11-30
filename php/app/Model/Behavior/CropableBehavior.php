<?php

App::uses('ModelBehavior', 'Model');
App::uses('Folder', 'Utility');

class CropableBehavior extends ModelBehavior
{
    public $mapMethods = array(
    	'/cropDelete/' => 'cropDelete'
    );

	private $quality = 80;


	/**
	 * setup method
	 *
	 * @param object $model instance of model
	 * @param array $config array of configuration settings.
	 * @return void
	 */
	public function setup(Model $Model, $settings = array())
	{
		if (!isset($this->settings[$Model->alias]))
		{
			foreach($settings as $field => $options)
			{
				$this->settings[$Model->alias][$field] = array_merge(array(
					'thumbnailSizes' => array(),
					'maxWidth' => 1200,
					'maxHeight' => 1200
				), (array)$options);
			}
		}
	}
    
    
	/**
	 * beforeSave method
	 *
	 * @return bool
	 */
	public function beforeSave(Model $Model, $options = array())
	{
		foreach ($this->settings[$Model->alias] as $field => $options)
		{
			if (!isset($Model->data[$Model->alias]['id'])) {
				unset($Model->data[$Model->alias][$field]);
				continue;
			}

			if (isset($Model->data[$Model->alias][$field]))
			{
				$image = $Model->data[$Model->alias][$field];
				unset($Model->data[$Model->alias][$field]);

				$dir = new Folder('files/' . strtolower($Model->alias) . '/' . $field . '/' . $Model->data[$Model->alias]['id'], true, 0755);
				$dir = $dir->path;

				if (isset($image['tmp_name']) && $image['tmp_name'] !== '')
				{
					$img = new Imagick($image['tmp_name']);
					$name = Inflector::slug(pathinfo($image['name'], PATHINFO_FILENAME));
					$ext = pathinfo($image['name'], PATHINFO_EXTENSION);
					$file = $name . '.' . $ext;

					if ($options['maxWidth'])
						$img->resizeImage($options['maxWidth'], 0, Imagick::FILTER_LANCZOS, 1);

					if ($options['maxHeight'])
						$img->resizeImage(0, $options['maxHeight'], Imagick::FILTER_LANCZOS, 1);

					$img->writeImage($dir . '/' . $file);

					foreach ($options['thumbnailSizes'] as $prefix => $thumbOptions)
					{
						$img = new Imagick($dir . '/' . $file);

						$q = (isset($thumbOptions['quality'])) ? (int)$thumbOptions['quality'] : $this->quality;
						$sizes = explode('x', $thumbOptions['size']);

						$img->cropThumbnailImage($sizes[0], $sizes[1]);
						$img->setImageCompressionQuality($q);
						$img->setImageFormat($img->getImageFormat());
						$img->writeImage($dir . '/' . $prefix . '_' . $file);
					}

					$Model->data[$Model->alias][$field] = $file;
				}
				else if (isset($image['src']))
				{
					$src = $image['src'];

					foreach ($image['crops'] as $crop)
					{
						$img = new Imagick($dir . '/' . $src);

						$prefix = $crop['prefix'] . '_';

						$q = (isset($options['thumbnailSizes'][$crop['prefix']]['quality'])) ? (int)$options['thumbnailSizes'][$crop['prefix']]['quality'] : $this->quality;
						$sizes = explode('x', $options['thumbnailSizes'][$crop['prefix']]['size']);

						$img->cropImage((int)$crop['cropW'], (int)$crop['cropH'], (int)$crop['cropX'], (int)$crop['cropY']);
						$img->resizeImage($sizes[0], $sizes[1], Imagick::FILTER_LANCZOS, 1);
						$img->setImageCompressionQuality($q);
						$img->setImageFormat($img->getImageFormat());
						$img->writeImage($dir . '/' . $prefix . $src);
					}

					$Model->data[$Model->alias][$field] = $src;
				}
			}
		}

        return true;
    }


	/**
	 * cropDelete method
	 *
	 * @return bool
	 */
	public function cropDelete(Model $Model, $id = null, $field = 'image')  
    {
    	if (!$id) {
    		return false;
    	}

		$dir = new Folder('files/' . strtolower($Model->alias) . '/' . $field . '/' . $id);

		if ($dir->delete()) {
			$Model->read(null, $id);
			$Model->set($field, null);
			if ($Model->save()) {
				return true;
			}
		}

		return false;
    }
}