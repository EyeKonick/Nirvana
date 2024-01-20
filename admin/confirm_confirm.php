<?php
require_once('CheckAuth.php');

require_once('../db_conn.php');

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

try {
    if(isset($_GET['id'])) {
        $id = validate($_GET['id']);

        $query = 'SELECT *, bookings_tbl.id
				    FROM bookings_tbl
				    INNER JOIN room_tbl ON bookings_tbl.room_id = room_tbl.id
				    INNER JOIN room_type_tbl ON room_tbl.room_type_id = room_type_tbl.id
				    WHERE bookings_tbl.id = :id;';

        $statement = $connection->prepare($query);
        $statement->bindParam('id', $id, PDO::PARAM_INT);

        if($statement->execute()) {
            $booking = $statement->fetch(PDO::FETCH_OBJ);
        }
    }

    if(isset($_POST['confirm'])) {
        $id = validate($_GET['id']);

        $query = 'UPDATE bookings_tbl
                    INNER JOIN room_tbl ON bookings_tbl.room_id = room_tbl.id
                    INNER JOIN room_type_tbl ON room_tbl.room_type_id = room_type_tbl.id
                    SET isConfirmed = 1
                    WHERE bookings_tbl.id = :id;';
        
        $statement = $connection->prepare($query);
        $statement->bindParam('id', $id, PDO::PARAM_INT);

        if($statement->execute()) {
            header('Location: booked.php?messageSuccess=Booking successfully confirmed!');
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

    <div class="modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to confirm?</p>
            </div>
            <div class="modal-footer">
                <a href="booked.php" class="btn btn-primary" data-bs-dismiss="modal">Back</a>
                <form action="confirm_confirm.php?id=<?=$booking->id;?>" method="post">
                    <button type="submit" class="btn btn-danger" name="confirm">Yes</button>
                </form>
            </div>
            </div>
        </div>
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
    <script>
        $(document).ready(function() {
            $('.modal').modal('show');
        });
    </script>
</body>
</html>