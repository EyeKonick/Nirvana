<?php 
  session_start(); 
  include 'db_connection.php';
  // Get all room types to display in rooms page
  if(!$_SESSION['room_types']){
    
    $query = "SELECT * FROM `room_type_tbl`";
    $room_types_sql = mysqli_query($connection, $query);

    $_SESSION['room_types'] = array();
    while ($room_type = mysqli_fetch_assoc($room_types_sql)){
      array_push($_SESSION['room_types'], $room_type);
    }
  }

  // get all rooms in room table
  $query = "SELECT * FROM `room_tbl`";
  $room_sql = mysqli_query($connection, $query);
  $rooms = array();
  while ($room = mysqli_fetch_assoc($room_sql)){
    array_push($rooms, $room);
  }

  // get all tickets that are within the date for check room availability
  if(isset($_POST['date_to_check']) && !empty($_POST['date_to_check'])){
    $date = new DateTime($_POST['date_to_check']);
    $date_to_check = $date->format("Y-m-d");
    $query = "SELECT `room_id` FROM `bookings_tbl` WHERE `check_in` <= '$date_to_check' AND `check_out` >= '$date_to_check'";
    $bookings_sql = mysqli_query($connection, $query); 
    
    // Loop through tickets and rooms to check if room is already booked and remove it in rooms to indicate it is unavailable
    while($booking =  mysqli_fetch_assoc($bookings_sql)){
      for ($i=0; $i < sizeof($rooms); $i++) { 
        if($rooms[$i]['id'] == $booking['room_id']){
          unset($rooms[$i]);
        }
      }
    }
  }else{
    $_POST['date_to_check'] = "";
  }
?>
<!DOCTYPE html>
<html lang="zxx">
  <head>
    <meta charset="UTF-8" />
    <meta name="description" content="Sona Template" />
    <meta name="keywords" content="Sona, unica, creative, html" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>NIRVANA HIGHLAND RESORT</title>

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
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css" />
    <link rel="stylesheet" href="css/flaticon.css" type="text/css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css" />
    <link rel="stylesheet" href="css/nice-select.css" type="text/css" />
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
  </head>

  <body>
    <!-- Page Preloder -->
    <div id="preloder">
      <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Section Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="canvas-open">
      <i class="icon_menu"></i>
    </div>
    <div class="offcanvas-menu-wrapper">
      <div class="canvas-close">
        <i class="icon_close"></i>
      </div>
      <div class="search-icon search-switch">
        <i class="icon_search"></i>
      </div>
      <div class="header-configure-area">
        <div class="language-option">
          <img src="img/flag.jpg" alt="" />
          <span>EN <i class="fa fa-angle-down"></i></span>
          <div class="flag-dropdown">
            <ul>
              <li><a href="#">Zi</a></li>
              <li><a href="#">Fr</a></li>
            </ul>
          </div>
        </div>
        <a href="#" class="bk-btn">Booking Now</a>
      </div>
      <nav class="mainmenu mobile-menu">
        <ul>
          <li class="active"><a href="./index.php">Home</a></li>
          <li><a href="./rooms.php">Rooms</a></li>
          <li><a href="./about-us.html">About Us</a></li>
          <li>
            <a href="./pages.html">Pages</a>
            <ul class="dropdown">
              <li><a href="./room-details.html">Room Details</a></li>
              <li><a href="./blog-details.html">Blog Details</a></li>
              <li><a href="#">Family Room</a></li>
              <li><a href="#">Premium Room</a></li>
            </ul>
          </li>
          <li><a href="./blog.html">News</a></li>
          <li><a href="./contact.html">Contact</a></li>
        </ul>
      </nav>
      <div id="mobile-menu-wrap"></div>
      <div class="top-social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-tripadvisor"></i></a>
        <a href="#"><i class="fa fa-instagram"></i></a>
      </div>
      <ul class="top-widget">
        <li><i class="fa fa-phone"></i> (12) 345 67890</li>
        <li><i class="fa fa-envelope"></i> info.colorlib@gmail.com</li>
      </ul>
    </div>
    <!-- Offcanvas Menu Section End -->

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
                    <li><a href="./index.php">Home</a></li>
                    <li class="active"><a href="./rooms.php">Rooms</a></li>
                    <li><a href="./about-us.html">About Us</a></li>
                    <li><a href="./contact.html">Contact</a></li>
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

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb-text">
              <h2>Our Rooms</h2>
              <div class="bt-option">
                <a href="./home.html">Home</a>
                <span>Rooms</span>
                <form action="rooms.php" method="post">
                  <div class="check-date mt-5">
                    <label for="date-out">Check Date Available: </label>
                    <input type="text" class="date-input" id="date-out" name="date_to_check" value="<?php echo $_POST['date_to_check'] ?>"/>
                    <i class="icon_calendar"></i>
                  </div>
                  <button class="btn btn-primary primary-btn mt-3 p-2" type="submit">Check Availability</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Rooms Section Begin -->
    <section class="rooms-section spad">
      <div class="container">
        <div class="row">
          <?php
            for($count = 4; $count < 10; $count++ ){
              $room_type = $_SESSION['room_types'][$count];
              $status = "unavailable";
              $avail_room_id = 0;
              // set status of rooms into available if have a matching id in rooms array.
              foreach($rooms as $room){
                if($room["room_type_id"] == $room_type['id']){
                  $status = "available";
                  $avail_room_id = $room['id'];
                }
              }
          ?>
          <div class="col-lg-4 col-md-6">
            <div class="room-color">
              <div class="room-item">
                <img src="img/room/room-<?php echo $count - 3 ?>.jpg" alt="" />
                <div class="ri-text">
                  <h4><?php echo $room_type['room_name'] ?></h4>
                  <h3>₱<?php echo $room_type['cost'] ?><span>/Pernight</span></h3>
                  <table>
                    <tbody>
                      <tr>
                        <td class="r-o">Size:</td>
                        <td><?php echo $room_type['size'] ?> ft</td>
                      </tr>
                      <tr>
                        <td class="r-o">Capacity:</td>
                        <td>Max person <?php echo $room_type['capacity'] ?></td>
                      </tr>
                      <tr>
                        <td class="r-o">Bed:</td>
                        <td><?php echo $room_type['bed'] ?></td>
                      </tr>
                      <tr>
                        <td class="r-o">Services:</td>
                        <td><?php echo $room_type['services'] ?></td>
                      </tr>
                    </tbody>
                  </table>
                  <a href="index.php?room_id=<?php echo $avail_room_id ?>" class="primary-btn"><br>
                  <?php 
                    echo $status;
                  ?>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <div class="col-lg-12">
            <div class="room-pagination">
              <a href="#">1</a>
              <a href="#">2</a>
              <a href="#">Next <i class="fa fa-long-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Rooms Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
          <div class="footer-text">
            <div class="row">
              <div class="col-lg-4">
                <div class="ft-about">
                  <div class="logo">
                    <a href="#">
                      <img src="img/light-logo.png" alt="" />
                    </a>
                  </div>
                  <p>
                    We inspire and reach millions of travelers<br />
                    across 90 local websites
                  </p>
                  <div class="fa-social">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-tripadvisor"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-youtube-play"></i></a>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 offset-lg-1">
                <div class="ft-contact">
                  <h6>Contact Us</h6>
                  <ul>
                    <li>(12) 345 67890</li>
                    <li>nirvana.com</li>
                    <li>Barangay Agtambi Dao Capiz</li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-3 offset-lg-1">
                <div class="ft-newslatter">
                  <h6>New latest</h6>
                  <p>Get the latest updates and offers.</p>
                  <form action="#" class="fn-form">
                    <input type="text" placeholder="Email" />
                    <button type="submit"><i class="fa fa-send"></i></button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="copyright-option">
          <div class="container">
            <div class="row">
              <div class="col-lg-7">
                <ul>
                  <li><a href="#">Contact</a></li>
                  <li><a href="#">Terms of use</a></li>
                  <li><a href="#">Privacy</a></li>
                  <li><a href="#">Environmental Policy</a></li>
                </ul>
              </div>
              <div class="col-lg-5">
                <div class="co-text">
                    <p>
                      <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                      Copyright &copy;
                      <script>
                        document.write(new Date().getFullYear());
                        </script>
                    All rights reserved 
                    <span  style="font-size: 1px; opacity: 0;">
  
                      | This template is made with
                      <i class="fa fa-heart" aria-hidden="true"></i> by
                      <a href="https://colorlib.com" target="_blank">Colorlib</a>
                      
                    </span>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                  </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>
    <!-- Footer Section End -->

    <!-- Search model Begin -->
    <div class="search-model">
      <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch"><i class="icon_close"></i></div>
        <form class="search-model-form">
          <input type="text" id="search-input" placeholder="Search here....." />
        </form>
      </div>
    </div>
    <!-- Search model end -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
