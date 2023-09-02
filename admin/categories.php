<?php include('db_connect.php');?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-category">
				<div class="card">
					<div class="card-header">
						    Room Category Form
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Room Name</label>
								<input type="text" class="form-control" name="name">
							</div>
							<div class="form-group">
								<label class="control-label">Price</label>
								<input type="number" class="form-control " name="price" step="any">
							</div>
							<div class="form-group">
								<label class="control-label">Size</label>
								<input type="number" class="form-control " name="size" step="any">
							</div>
							<div class="form-group">
								<label class="control-label">Bed</label>
								<input type="text" class="form-control" name="bed" >
							</div>	
							<div class="form-group">
								<label class="control-label">Capacity</label>
								<input type="number" class="form-control" name="capacity">
							</div>	
							<div class="form-group">
								<label class="control-label">Services</label>
								<input type="text" class="form-control" name="services">
							</div>	
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#manage-category').get(0).reset()"> Cancel</button>
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
									<th class="text-center">#</th>
									<th class="text-center">Room</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$cats = $conn->query("SELECT * FROM room_type_tbl order by id asc");
								while($row=$cats->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										<p>Name : <b><?php echo $row['room_name'] ?></b></p>
										<p>Price : <b><?php echo "₱".number_format($row['cost'],2) ?></b></p>
										<p>Size : <b><?php echo $row['size'] ?></b></p>
										<p>Bed : <b><?php echo $row['bed'] ?></b></p>
										<p>Capacity : <b><?php echo $row['capacity'] ?></b></p>
										<p>Services : <b><?php echo $row['services'] ?></b></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_cat" type="button" 
											data-id="<?php echo $row['id'] ?>" 
											data-name="<?php echo $row['room_name'] ?>" 
											data-price="<?php echo $row['cost'] ?>"
											data-size="<?php echo $row['size'] ?>"
											data-bed="<?php echo $row['bed'] ?>"
											data-capacity="<?php echo $row['capacity'] ?>"
											data-services="<?php echo $row['services'] ?>"
										>Edit</button>
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
<style>
	img#cimg,.cimg{
		max-height: 10vh;
		max-width: 6vw;
	}
	td{
		vertical-align: middle !important;
	}
</style>
<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$('#manage-category').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_category',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
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
		var cat = $('#manage-category')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
		cat.find("[name='price']").val($(this).attr('data-price'))
		cat.find("[name='size']").val($(this).attr('data-size'))
		cat.find("[name='bed']").val($(this).attr('data-bed'))
		cat.find("[name='capacity']").val($(this).attr('data-capacity'))
		cat.find("[name='services']").val($(this).attr('data-services'))
		end_load()
	})
	$('.delete_cat').click(function(){
		_conf("Are you sure to delete this category?","delete_cat",[$(this).attr('data-id')])
	})
	function delete_cat($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_category',
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