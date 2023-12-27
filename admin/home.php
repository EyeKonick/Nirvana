<?php
require_once('CheckAuth.php');
require_once('../db_conn.php');

function validate($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$messageFailed = '';

try {
	$query = 'SELECT *, bookings_tbl.id
				    FROM bookings_tbl
				    INNER JOIN room_tbl ON bookings_tbl.room_id = room_tbl.id
				    INNER JOIN room_type_tbl ON room_tbl.room_type_id = room_type_tbl.id
				    WHERE bookings_tbl.isBooked = 1 AND bookings_tbl.isDeleted = 0 OR bookings_tbl.isBooked = 0 AND bookings_tbl.isDeleted = 0
            ORDER BY bookings_tbl.isBooked DESC, bookings_tbl.name ASC, room_type_tbl.room_name ASC;';
	
	$statement = $connection->prepare($query);
	if($statement->execute()) {
		$bookings = $statement->fetchAll(PDO::FETCH_OBJ);
	}

  if(isset($_POST['confirm_check_out'])) {
    $id = validate($_GET['id']);
    
    $query = 'UPDATE bookings_tbl
				      INNER JOIN room_tbl ON bookings_tbl.room_id = room_tbl.id
				      INNER JOIN room_type_tbl ON room_tbl.room_type_id = room_type_tbl.id
              SET isBooked = 0
				      WHERE bookings_tbl.id = :id;';

    $statement = $connection->prepare($query);
    $statement->bindParam('id', $id, PDO::PARAM_INT);

    if($statement->execute()) {
      header('location: home.php?messageSuccess=Successfully checked out!');
    }
  }
} catch(PDOException $exception) {
	$messageFailed = $exception->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Google Font -->
    <link
      href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap"
      rel="stylesheet"
    />

    <!-- Css Styles -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="../css/elegant-icons.css" type="text/css" />
    <link rel="stylesheet" href="../css/flaticon.css" type="text/css" />
    <link rel="stylesheet" href="../css/owl.carousel.min.css" type="text/css" />
    <link rel="stylesheet" href="../css/nice-select.css" type="text/css" />
    <link rel="stylesheet" href="../css/jquery-ui.min.css" type="text/css" />
    <link rel="stylesheet" href="../css/magnific-popup.css" type="text/css" />
    <link rel="stylesheet" href="../css/slicknav.min.css" type="text/css" />
    <link rel="stylesheet" href="../basic/style.css" type="text/css" />

	<title>Admin | Home</title>
</head>
<body>
	<!-- Page Preloder -->
    <div id="preloder">
      <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header-section header-normal">
      <div class="menu-item">
        <div class="container">
          <div class="row">
            <div class="col-lg-2">
              <div class="logo">
                <a href="./index.php">
                  <img src="img/light-logo.png" alt="" />
                </a>
              </div>
            </div>
            <div class="col-lg-10">
              <div class="nav-menu">
                <nav class="mainmenu">
                  <ul>
                    <li class="active"><a href="#">Books</a></li>      
                    <li><a href="logout.php">Logout</a></li>      
                  </ul>
                </nav>
                <div class="nav-right search-switch">
                  <i class="icon_search"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- Header End -->

	<div class="container">
		<table class="table table-hover">
      <?php if(isset($_GET['messageSuccess'])): ?>
			<div class="alert alert-success">
				<?php echo $_GET['messageSuccess']; ?>
			</div>
			<?php elseif($messageFailed): ?>
			<div class="alert alert-danger">
				<?php echo $messageFailed; ?>
			</div>
			<?php endif; ?>
			<thead>
				<tr>
	
				</tr>
				<th class="text-center">#</th>
				<th class="text-center">Cottage Type</th>
				<th class="text-center">Check In</th>
				<th class="text-center">Check Out</th>
				<th class="text-center">Name</th>
				<th class="text-center">Contact Number</th>
				<th class="text-center">Action</th>
			</thead>
			<tbody>
				<?php foreach($bookings as $booking): ?>
          <tr>
            <td><?=$booking->id;?></td>
            <td><?=$booking->room_name;?></td>
            <td><?=$booking->check_in;?></td>
            <td><?=$booking->check_out;?></td>
            <td><?=$booking->name;?></td>
            <td><?=$booking->contact_number;?></td>
            <td>
              <?php if($booking->isConfirmed == 0): ?>
                <a href="confirm_confirm.php?id=<?=$booking->id;?>" class="btn btn-success">Confirm</a>
              <?php else: ?>
                <a href="#" class="btn btn-success disabled">Confirmed</a>
              <?php endif; ?>
              <?php if($booking->isBooked == 1): ?>
                <a href="confirm_check_out.php?id=<?=$booking->id;?>" class="btn btn-warning">Check Out</a>
              <?php else: ?>
                <a href="#" class="btn btn-warning disabled">Checked Out</a>
              <?php endif; ?>
              <a href="confirm_delete.php?id=<?=$booking->id;?>" class="btn btn-danger">Delete</a>
            </td>
          </tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>


	<!-- Js Plugins -->
  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.magnific-popup.min.js"></script>
  <script src="../js/jquery.nice-select.min.js"></script>
  <script src="../js/jquery-ui.min.js"></script>
  <script src="../js/jquery.slicknav.js"></script>
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/main.js"></script>
  </script>
</body>
</html>