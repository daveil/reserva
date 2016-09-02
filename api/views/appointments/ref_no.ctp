<?php echo $this->Html->css('../../js/bower_components/Bootflat/css/site.min');?>
<style type="text/css">td{ vertical-align: middle !important;}</style>
<div class="container">
<h1>Thank you for making a reservation!</h1>
<table class="table table-bordered">
	<tbody>
		<tr>
			<td>REF NO:</td>
			<td><h4><?php echo $appointment['Appointment']['ref_no']?></h4></td>
			
		</tr>
		<tr>
			<td>Schedule:</td>
			<td><?php
				$schedule  = date('M d, Y D',strtotime($appointment['Appointment']['schedule']));
				echo $schedule;
			?></td>
		</tr>
		<tr>
			<td>Name:</td>
			<td>
				<?php echo $appointment['Patient']['name']?>
			</td>
		</tr>
	</tbody>
</table>
</div>
<script>window.print();</script>