<div class="disabledDates view">
<h2><?php  __('Disabled Date');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disabledDate['DisabledDate']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disabledDate['DisabledDate']['date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disabledDate['DisabledDate']['status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disabledDate['DisabledDate']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $disabledDate['DisabledDate']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Disabled Date', true), array('action' => 'edit', $disabledDate['DisabledDate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Disabled Date', true), array('action' => 'delete', $disabledDate['DisabledDate']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $disabledDate['DisabledDate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Disabled Dates', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Disabled Date', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
