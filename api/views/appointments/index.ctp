<div class="appointments index">
	<h2><?php __('Appointments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('ref_no');?></th>
			<th><?php echo $this->Paginator->sort('patient_id');?></th>
			<th><?php echo $this->Paginator->sort('schedule');?></th>
			<th><?php echo $this->Paginator->sort('concern');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($appointments as $appointment):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $appointment['Appointment']['id']; ?>&nbsp;</td>
		<td><?php echo $appointment['Appointment']['ref_no']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($appointment['Patient']['name'], array('controller' => 'patients', 'action' => 'view', $appointment['Patient']['id'])); ?>
		</td>
		<td><?php echo $appointment['Appointment']['schedule']; ?>&nbsp;</td>
		<td><?php echo $appointment['Appointment']['concern']; ?>&nbsp;</td>
		<td><?php echo $appointment['Appointment']['created']; ?>&nbsp;</td>
		<td><?php echo $appointment['Appointment']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $appointment['Appointment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $appointment['Appointment']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $appointment['Appointment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $appointment['Appointment']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Appointment', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Patients', true), array('controller' => 'patients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient', true), array('controller' => 'patients', 'action' => 'add')); ?> </li>
	</ul>
</div>