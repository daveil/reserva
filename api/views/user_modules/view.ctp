<div class="userModules view">
<h2><?php  __('User Module');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $userModule['UserModule']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($userModule['User']['id'], array('controller' => 'users', 'action' => 'view', $userModule['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Module'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($userModule['Module']['name'], array('controller' => 'modules', 'action' => 'view', $userModule['Module']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Module', true), array('action' => 'edit', $userModule['UserModule']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete User Module', true), array('action' => 'delete', $userModule['UserModule']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $userModule['UserModule']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Modules', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Module', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Modules', true), array('controller' => 'modules', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Module', true), array('controller' => 'modules', 'action' => 'add')); ?> </li>
	</ul>
</div>
