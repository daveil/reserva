<table>
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
<style>
	table tr>td{border:1px solid #000;}
</style>
<script>window.print();</script>
