<!DOCTYPE html>
<html lang="en">

<head>

	<?php echo $this->Html->charset(); ?>

	<title><?php echo $title_for_layout; ?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
	<meta name="description" content="A simple user application">
	<meta name="author" content="Antonio Rizzo">

	<?php
		$this->Html->meta('favicon.png', '/favicon.png', array('type' => 'icon', 'inline' => false));
		
		$this->Html->css('/styles.min', null, array('inline' => false));

		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>

	<!--[if (gte IE 6)&(lte IE 8)]>
		<link rel="stylesheet" href="/styles.ie.css" />
	<![endif]-->

</head>

<body>

	<div class="site">

		<header class="site-header" role="banner">
			<div class="brand">
				<?php echo __('A simple user application'); ?>
				<small>
					<?php
						echo __('by') . ' ' . $this->Html->link('Antonio Rizzo', 'https://github.com/antoniozzo', array(
							'target' => '_blank'
						));
					?>
				</small>
			</div>
			<a href="#" class="icon toggle toggle-medium">Menu</a>
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