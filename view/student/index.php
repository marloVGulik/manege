<div class="container">
	<table border="1">
		<tr>
			<th>#</th>
			<th>Naam</th>
		</tr>
		
		<?php foreach($value as $tmpVal) {
			?>
				<tr>
					<td><?= $tmpVal['student_id'] ?></td>
					<td><?= $tmpVal['student_name'] ?></td>
				</tr>			
			<?php
		} ?>
		


	</table>
</div>