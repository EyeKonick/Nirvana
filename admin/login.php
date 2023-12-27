<?php 
session_start();

function validate($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

$messageFailed = '';

if(isset($_POST['btn_login'])) {
	try {
		require_once('../db_conn.php');
	
		$username = validate($_POST['username']);
		$password = validate($_POST['password']);
	
		$query = 'SELECT *
					FROM users
					WHERE username = :username AND `password` = :password';
		
		$statement = $connection->prepare($query);
		$statement->bindParam('username', $username, PDO::PARAM_STR);
		$statement->bindParam('password', $password, PDO::PARAM_STR);
	
		if($statement->execute()) {
			$user = $statement->fetch(PDO::FETCH_OBJ);

			if($statement->rowCount() > 0) {
				$_SESSION['user_id'] = $user->id;
				$_SESSION['name'] = $user->name;
				$_SESSION['username'] = $user->username;
				$_SESSION['password'] = $user->password;
				$_SESSION['isLoggedIn'] = true;

				header('location: home.php');
			} else {
				$messageFailed = 'Failed to login! Incorrect username or password!';
			}
		}
	} catch(PDOException $exception) {
		echo $messageFailed = $exception->getMessage();
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">

  <title>Nirvana Admin</title>

</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
	    background: #007bff;
		align-items: center;
	}
	main#main{
		width:100%;
		height: calc(100%);
		background:white;
	}
	#login-right{
		display: flex;
		align-items: center;
		justify-content: center;
		height: 100vh;
		background: skyblue;
	}
	#login-right .card{
		position: absolute;
		background: rgba(0, 0, 0, .5);
		color: white;
		width: 500px;
	}
</style>

<body>


  <main id="main" class=" alert-info">
  		<div id="login-right">
  			<div class="card col-md-8">
  				<div class="card-body">
  					<form id="login-form" action="" method="post">
						<?php if($messageFailed): ?>
						<div class="alert alert-danger">
							<?php echo $messageFailed; ?>
						</div>
						<?php endif; ?>
  						<div class="form-group">
  							<label for="username" class="control-label">Username</label>
  							<input type="text" id="username" name="username" class="form-control">
  						</div>
  						<div class="form-group">
  							<label for="password" class="control-label">Password</label>
  							<input type="password" id="password" name="password" class="form-control">
  						</div>
  						<center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary" name="btn_login">Login</button></center>
  					</form>
  				</div>
  			</div>
  		</div>
   

  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else if(resp == 2){
					location.href ='voting.php';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>	
</html>