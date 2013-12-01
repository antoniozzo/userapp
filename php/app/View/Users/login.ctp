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
        
    <div class="form-actions">
		<?php echo $this->Form->submit(__('Login'), array('class' => 'btn btn-primary', 'div' => false)); ?>
	</div>
	
<?php echo $this->Form->end(); ?>