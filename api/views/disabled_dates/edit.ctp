<div class="disabledDates form">
<?php echo $this->Form->create('DisabledDate');?>
	<fieldset>
		<legend><?php __('Edit Disabled Date'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('date');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('DisabledDate.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('DisabledDate.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Disabled Dates', true), array('action' => 'index'));?></li>
	</ul>
</div>