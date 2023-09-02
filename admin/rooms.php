<?php include('db_connect.php');?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-room">
				<div class="card">
					<div class="card-header">
						    Room Form
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Room No.</label>
								<input type="text" class="form-control" name="room-number">
							</div>
							<div class="form-group">
								<label class="control-label">Category</label>
								<select class="custom-select browser-default" name="category_id">
									<?php 
									$cat = $conn->query("SELECT * FROM room_type_tbl order by `room_name` asc ");
									$room_types = array();
									while($row= $cat->fetch_assoc()) {
										$cat_name[$row['id']] = $row['room_name'];
										?>
										<option value="<?php echo $row['id'] ?>"><?php echo $row['room_name'] ?></option>
									<?php
									}
									?>
								</select>
							</div>
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#manage-room').get(0).reset()"> Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">Room #</th>
									<th class="text-center">Room Type</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$rooms = $conn->query("SELECT * FROM room_tbl order by `room_number` asc");
								while($row=$rooms->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $row['room_number']?></td>
									<td class="text-center"><?php echo $cat_name[$row['room_type_id']] ?></td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_cat" type="button" data-id="<?php echo $row['id'] ?>" data-room-number="<?php echo $row['room_number'] ?>" data-room-type-id="<?php echo $row['room_type_id'] ?>">Edit</button>
										<button class="btn btn-sm btn-danger delete_cat" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>

<script>
	$('#manage-room').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_room',
			method:"POST",
			data: $(this).serialize(),
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					alert_toast("Data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	})
	$('.edit_cat').click(function(){
		start_load()
		var cat = $('#manage-room')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='room-number']").val($(this).attr('data-room-number'))
		cat.find("[name='category_id']").val($(this).attr('data-room-type-id'))
		cat.find("[name='status']").val($(this).attr('data-status'))
		end_load()
	})
	$('.delete_cat').click(function(){
		_conf("Are you sure to delete this room?","delete_cat",[$(this).attr('data-id')])
	})
	function delete_cat($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_room',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>