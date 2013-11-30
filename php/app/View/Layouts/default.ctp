<!DOCTYPE html>
<html lang="en">

<head>

	<?php echo $this->Html->charset(); ?>

	<title><?php echo $title_for_layout; ?></title>

	<?php
		$this->Html->meta('favicon.png', '/favicon.png', array('type' => 'icon', 'inline' => false));
		$this->Html->meta('viewport', 'width=device-width, initial-scale=1.0', array('inline' => false));
		$this->Html->meta('description', 'A simple user application', array('inline' => false));
		$this->Html->meta('author', 'Antonio Rizzo', array('inline' => false));
		
		$this->Html->css('/styles.min', null, array('inline' => false));

		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>

</head>

<body>

	<div class="site">

		<header class="site-header" role="banner">
		</header>

		<aside class="site-sidebar">
			<?php echo $this->element('navigation'); ?>
		</aside>

		<section class="site-content" role="main">
			<div class="site-container">

				<?php echo $this->Session->flash(); ?>

				<div class="page">

					<h1 class="page-header">

						<?php if (isset($image_for_layout)) : ?>
							<?php echo $this->Html->image($image_for_layout, array('class' => 'page-image')); ?>
						<?php endif; ?>

						<?php if (isset($icon_for_layout)) : ?>
							<span class="icon <?php echo $icon_for_layout; ?>-large"></span>
						<?php endif; ?>

						<?php echo $title_for_layout; ?>

					</h1>

					<div class="page-content">
						<?php echo $this->fetch('content'); ?>
					</div>

				</div>

			</div>
		</section>

		<section class="site-footer" role="contentinfo">
		</section>

	</div>

	<?php
		echo $this->Html->script('http://code.jquery.com/jquery-latest.min.js');
		echo $this->Html->script('/scripts.min');
	?>

</body>
</html>