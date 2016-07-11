<div class="appointments form">
<?php echo $this->Form->create('Appointment');?>
	<fieldset>
		<legend><?php __('Add Appointment'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Appointments', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Patients', true), array('controller' => 'patients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient', true), array('controller' => 'patients', 'action' => 'add')); ?> </li>
	</ul>
</div>