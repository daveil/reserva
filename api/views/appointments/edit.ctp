<div class="appointments form">
<?php echo $this->Form->create('Appointment');?>
	<fieldset>
		<legend><?php __('Edit Appointment'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('ref_no');
		echo $this->Form->input('patient_id');
		echo $this->Form->input('schedule');
		echo $this->Form->input('concern');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Appointment.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Appointment.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Appointments', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Patients', true), array('controller' => 'patients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient', true), array('controller' => 'patients', 'action' => 'add')); ?> </li>
	</ul>
</div>