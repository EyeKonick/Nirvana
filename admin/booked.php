<?php include('db_connect.php'); 
$room_type = $conn->query("SELECT * FROM room_type_tbl");
$room_type_array = array();
while($row = $room_type->fetch_assoc()){
	$room_type_array[$row['id']] = $row;
}

$room = $conn->query("SELECT * FROM room_tbl");
$room_array = array();
while($row = $room->fetch_assoc()){
	$room_array[$row['id']] = $row;
}

?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row mt-3">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered">
							<thead>
								<th>#</th>
								<th>Room Type</th>
								<th>Check in</th>
								<th>Check out</th>
								<th>Date Created</th>
								<th>Action</th>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$checked = $conn->query("SELECT * FROM bookings_tbl ORDER BY `id` ASC");
								while($row=$checked->fetch_assoc()):
									$room_id = $row['room_id'];
									$room = $room_array[$room_id];
									$room_type_id = $room['room_type_id'];
									$room_type = $room_type_array[$room_type_id];
									$room_name = $room_type['room_name'];
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="text-center"><?php echo $room_name  ?></td>
									<td class=""><?php echo $row['check_in'] ?></td>
									<td class=""><?php echo $row['check_out'] ?></td>
									<td class=""><?php echo $row['date_created'] ?></td>
									<td class="text-center">
											<button class="btn btn-sm btn-primary check_out" type="button" data-id="<?php echo $row['id'] ?>">View</button>
									</td>
								</tr>
							<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$('table').dataTable()
	$('.check_out').click(function(){
		uni_modal("Check Out","manage_check_out.php?checkout=1&id="+$(this).attr("data-id"))
	})
	$('#filter').submit(function(e){
		e.preventDefault()
		location.replace('index.php?page=check_in&category_id='+$(this).find('[name="category_id"]').val()+'&status='+$(this).find('[name="status"]').val())
	})
</script>