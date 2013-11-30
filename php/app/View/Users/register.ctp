<?php echo $this->Session->flash('auth'); ?>

<?php echo $this->Form->create('User', array('class' => 'form')); ?>
	
	<div class="control-group">
        <?php
        	echo $this->Form->label('email', 'Email', array(
        		'class' => 'control-label'
        	));
	        echo $this->Form->input('email', array(
	        	'label' => false,
	        	'div' => 'controls',
	        	'class' => 'input',
	        	'placeholder' => 'Enter your email'
	        ));
	    ?>
	</div>
	    
	<div class="control-group">
        <?php
        	echo $this->Form->label('password', 'Password', array(
        		'class' => 'control-label'
        	));
	        echo $this->Form->input('password', array(
	        	'label' => false,
	        	'div' => 'controls',
	        	'class' => 'input',
	        	'placeholder' => 'Enter your password'
	        ));
        ?>
	</div>

	<div class="control-group">
        <?php
        	echo $this->Form->label('first_name', 'First name', array(
        		'class' => 'control-label'
        	));
	        echo $this->Form->input('first_name', array(
	        	'label' => false,
	        	'div' => 'controls',
	        	'class' => 'input',
	        	'placeholder' => 'Enter your first name'
	        ));
	    ?>
	</div>

	<div class="control-group">
        <?php
        	echo $this->Form->label('last_name', 'Last name', array(
        		'class' => 'control-label'
        	));
	        echo $this->Form->input('last_name', array(
	        	'label' => false,
	        	'div' => 'controls',
	        	'class' => 'input',
	        	'placeholder' => 'Enter your last name'
	        ));
	    ?>
	</div>

	<div class="control-group">
        <?php
        	echo $this->Form->label('image', 'Profile image', array(
        		'class' => 'control-label'
        	));
	        echo $this->Form->input('image', array(
	        	'label' => false,
	        	'type' => 'file',
	        	'div' => 'controls',
	        	'class' => 'input',
	        	'placeholder' => 'Upload a profile image'
	        ));
	    ?>
	</div>
        
    <div class="form-actions">
		<?php echo $this->Form->submit(__('Register'), array('class' => 'btn btn-primary', 'div' => false)); ?>
	</div>
	
<?php echo $this->Form->end(); ?>