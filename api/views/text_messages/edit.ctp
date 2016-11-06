<div class="textMessages form">
<?php echo $this->Form->create('TextMessage');?>
	<fieldset>
		<legend><?php __('Edit Text Message'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('mobile_number');
		echo $this->Form->input('message');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('TextMessage.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('TextMessage.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Text Messages', true), array('action' => 'index'));?></li>
	</ul>
</div>