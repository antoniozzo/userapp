<nav class="nav" role="navigation">

	<ul>
		
		<?php if ($current_user) : ?>

			<li class="nav-section">
				<?php echo $current_user['full_name']; ?>
			</li>

			<li<?php echo ($this->params->action === 'view') ? ' class="current"' : ''; ?>>
				<?php
					echo $this->Html->link('<span class="icon profile-medium"></span>Profile', array(
						'controller' => 'users',
						'action' => 'view'
					), array(
						'escape' => false
					));
				?>
			</li>

			<li<?php echo ($this->params->action === 'edit') ? ' class="current"' : ''; ?>>
				<?php
					echo $this->Html->link('<span class="icon edit-medium"></span>Settings', array(
						'controller' => 'users',
						'action' => 'edit'
					), array(
						'escape' => false
					));
				?>
			</li>

			<li>
				<?php
					echo $this->Html->link('<span class="icon logout-medium"></span>Logout', array(
						'controller' => 'users',
						'action' => 'logout'
					), array(
						'escape' => false
					));
				?>
			</li>

		<?php else : ?>

			<li<?php echo ($this->params->action === 'login') ? ' class="current"' : ''; ?>>
				<?php
					echo $this->Html->link('<span class="icon logout-medium"></span>Login', array(
						'controller' => 'users',
						'action' => 'login'
					), array(
						'escape' => false
					));
				?>
			</li>

			<li<?php echo ($this->params->action === 'register') ? ' class="current"' : ''; ?>>
				<?php
					echo $this->Html->link('<span class="icon edit-medium"></span>Register', array(
						'controller' => 'users',
						'action' => 'register'
					), array(
						'escape' => false
					));
				?>
			</li>

		<?php endif; ?>

	</ul>

</nav>