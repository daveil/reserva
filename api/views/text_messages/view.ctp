<div class="textMessages view">
<h2><?php  __('Text Message');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $textMessage['TextMessage']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mobile Number'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $textMessage['TextMessage']['mobile_number']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Message'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $textMessage['TextMessage']['message']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $textMessage['TextMessage']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Text Message', true), array('action' => 'edit', $textMessage['TextMessage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Text Message', true), array('action' => 'delete', $textMessage['TextMessage']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $textMessage['TextMessage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Text Messages', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Text Message', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
