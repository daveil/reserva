<div class="patients view">
<h2><?php  __('Patient');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $patient['Patient']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $patient['Patient']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Contact No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $patient['Patient']['contact_no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Age'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $patient['Patient']['age']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Adddress'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $patient['Patient']['adddress']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $patient['Patient']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $patient['Patient']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Patient', true), array('action' => 'edit', $patient['Patient']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Patient', true), array('action' => 'delete', $patient['Patient']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $patient['Patient']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Patients', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Patient', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Appointments', true), array('controller' => 'appointments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appointment', true), array('controller' => 'appointments', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php __('Related Users');?></h3>
	<?php if (!empty($patient['User'])):?>
		<dl>	<?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $patient['User']['id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $patient['User']['type'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Username');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $patient['User']['username'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Password');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $patient['User']['password'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Patient Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $patient['User']['patient_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $patient['User']['created'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $patient['User']['modified'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit User', true), array('controller' => 'users', 'action' => 'edit', $patient['User']['id'])); ?></li>
			</ul>
		</div>
	</div>
	<div class="related">
	<h3><?php __('Related Appointments');?></h3>
	<?php if (!empty($patient['Appointment'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Ref No'); ?></th>
		<th><?php __('Patient Id'); ?></th>
		<th><?php __('Schedule'); ?></th>
		<th><?php __('Concern'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($patient['Appointment'] as $appointment):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $appointment['id'];?></td>
			<td><?php echo $appointment['ref_no'];?></td>
			<td><?php echo $appointment['patient_id'];?></td>
			<td><?php echo $appointment['schedule'];?></td>
			<td><?php echo $appointment['concern'];?></td>
			<td><?php echo $appointment['created'];?></td>
			<td><?php echo $appointment['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'appointments', 'action' => 'view', $appointment['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'appointments', 'action' => 'edit', $appointment['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'appointments', 'action' => 'delete', $appointment['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $appointment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Appointment', true), array('controller' => 'appointments', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
