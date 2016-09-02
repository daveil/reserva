<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('type');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('patient_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Patients', true), array('controller' => 'patients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient', true), array('controller' => 'patients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Modules', true), array('controller' => 'user_modules', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Module', true), array('controller' => 'user_modules', 'action' => 'add')); ?> </li>
	</ul>
</div>