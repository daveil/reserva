<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('type');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('name');
		echo $this->Form->input('age');
		echo $this->Form->input('contact_no');
		echo $this->Form->input('address');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('User.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List User Modules', true), array('controller' => 'user_modules', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Module', true), array('controller' => 'user_modules', 'action' => 'add')); ?> </li>
	</ul>
</div>