<div class="userModules form">
<?php echo $this->Form->create('UserModule');?>
	<fieldset>
		<legend><?php __('Edit User Module'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('module_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('UserModule.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('UserModule.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List User Modules', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Modules', true), array('controller' => 'modules', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Module', true), array('controller' => 'modules', 'action' => 'add')); ?> </li>
	</ul>
</div>