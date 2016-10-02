<?php echo $this->Html->css('../../js/bower_components/Bootflat/css/site.min');?>
<style type="text/css">td{ vertical-align: middle !important;}</style>
<div class="container">
<?php
	$date =  date('M d Y',strtotime($_GET['date']));
?>
<h3>Appointments: <?php echo $date;?></h3>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Concern</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($appointments as $appointment):?>
				<tr>
					<td><?php echo $appointment['Appointment']['ref_no']?></td>
					<td><?php echo $appointment['Patient']['name']?></td>
					<td><?php echo $appointment['Appointment']['concern']?></td>
				</tr>
		<?php endforeach;?>
	</tbody>
</table>
</div>
<script>window.print();</script>
