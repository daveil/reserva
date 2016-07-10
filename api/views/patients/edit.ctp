<div class="patients form">
<?php echo $this->Form->create('Patient');?>
	<fieldset>
		<legend><?php __('Edit Patient'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('contact_no');
		echo $this->Form->input('age');
		echo $this->Form->input('adddress');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Patient.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Patient.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Patients', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Appointments', true), array('controller' => 'appointments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appointment', true), array('controller' => 'appointments', 'action' => 'add')); ?> </li>
	</ul>
</div>