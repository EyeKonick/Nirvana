<?php 
  session_start(); 

  try {
    require_once('db_conn.php');

    $query = 'SELECT *, r.id
              FROM room_tbl AS r
              INNER JOIN room_type_tbl AS rt ON r.room_type_id = rt.id
              WHERE rt.room_name LIKE "%kubo%"
              ORDER BY rt.cost DESC,  rt.room_name ASC;';
    $statement = $connection->prepare($query);

    if($statement->execute()) {
      $rooms = $statement->fetchAll(PDO::FETCH_OBJ);
    }
  } catch(PDOException $exception) {
    echo $messageFailed = $exception->getMessage();
  }

  if(isset($_POST['button_check_availability'])) {
    try {
      $isUnavailable = false;

      require_once('db_conn.php');

      $checkIn = $_POST['date_to_check'];

      $query = 'SELECT *, r.id
                FROM room_tbl AS r
                INNER JOIN room_type_tbl AS rt ON r.room_type_id = rt.id
                INNER JOIN bookings_tbl AS b ON r.id = b.room_id
                WHERE b.check_in = :checkIn OR b.check_in < :checkIn OR b.check_out > :checkIn AND
                b.isBooked = 1 AND rt.room_name LIKE "%kubo%"
                ORDER BY rt.cost DESC, rt.room_name ASC;';

      $checkInDate = date('Y-m-d', strtotime($checkIn));

      $statement = $connection->prepare($query);
      $statement->bindParam('checkIn', $checkInDate, PDO::PARAM_STR);

      if($statement->execute()) {
        $bookedRooms = $statement->fetchAll(PDO::FETCH_OBJ);
      }
    } catch(PDOException $exception) {
      echo $messageFailed = $exception->getMessage();
    }
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
    <link rel="stylesheet" href="basic/style.css" type="text/css" />
  </head>

  <body>
    <!-- Page Preloder
    <div id="preloder">
      <div class="loader"></div>
    </div> -->

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
          <li><a href="./rooms.php">Cottage</a></li>
          <li><a href="./about-us.php">About Us</a></li>
          <li>
            <a href="./pages.php">Pages</a>
            <ul class="dropdown">
              <li><a href="./room-details.php">Cottage Details</a></li>
              <li><a href="./blog-details.php">Blog Details</a></li>
              <li><a href="#">Family Cottage</a></li>
              <li><a href="#">Premium Cottage</a></li>
            </ul>
          </li>
          <li><a href="./blog.php">News</a></li>
          <li><a href="./contact.php">Contact</a></li>
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
                    <li class="active"><a href="./rooms.php">Cottage</a></li>
                    <li><a href="./about-us.php">About Us</a></li>
                    <li><a href="./contact.php">Contact</a></li>
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
              <h2>Our Cottages</h2>
              <div class="bt-option">
                <a href="./home.php">Home</a>
                <span>Cottages</span>
                <form action="rooms.php" method="post">
                  <div class="check-date mt-5">
                    <label for="date-out">Check Date Available: </label>
                    <input type="text" class="date-input" id="date-out" name="date_to_check" value=""/>
                    <i class="icon_calendar"></i>
                  </div>
                  <button class="btn btn-primary primary-btn mt-3 p-2" type="submit" name="button_check_availability">Check Availability</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Breadcrumb Section End -->

    <div class="col-lg-12">
          <div class="room-pagination">
              <a href="rooms.php">Small</a>
              <a href="medium.php">medium</a>
              <a href="bahaykubo.php" class="active">Bahay Kubo</a>
              <a href="venuehall.php">Venue Hall</a>
            </div>

     <!-- Rooms Section Begin -->
    <section class="rooms-section spad">
      <div class="container">
        <div class="row">
          <?php foreach($rooms as $room): ?>
          <div class="col-lg-4 col-md-6">
            <div class="room-color">
              <div class="room-item">
                <img src="img/room/<?=$room->image_src?>" alt="" />
                <div class="ri-text">
                  <h4><?=$room->room_name?></h4>
                  <h3>₱<?=$room->cost?></h3>
                  <table>
                    <tbody>
                      <tr>
                        <td class="r-o">Capacity:</td>
                        <td>Max person <?=$room->capacity?></td>
                      </tr>
                      <tr>
                        <td class="r-o">Services:</td>
                        <td><?=$room->services?></td>
                      </tr>
                    </tbody>
                  </table>
                  <?php if(!isset($_POST['button_check_availability'])): ?>
                    <a href="index.php?room_id=<?=$room->id?>" class="btn primary-btn text-center"><br>
                      <?php echo 'Available'; ?>
                    </a>
                  <?php else: ?>
                    <?php
                    // Load all data from bookings table that are booked
                    foreach($bookedRooms as $bookedRoom) {
                      // When data match their id from bookings to room table, set their cottage into unavailable. Otherwise, set into available
                      if($bookedRoom->room_id === $room->id && $bookedRoom->isBooked === 1) {
                        $isUnavailable = true;
                      } else {
                        $isUnavailable = false;

                        // When cottage is booked according to specified date but still available, will loop until the cottage will set into
                        // unavailable
                        foreach($bookedRooms as $bookedRoom) {
                          if($bookedRoom->room_id === $room->id && $bookedRoom->isBooked === 1) {
                            $isUnavailable = true;
                          }
                        }
                      }
                    }
                    
                    // If variable $isUnavailable is true, the cottage will be unavailable. Otherwise, when variable $isUnavailable is false will
                    // be available
                    ?>
                    <?php if($isUnavailable === true): ?>
                      <a href="index.php?room_id=<?=$room->id?>" class="btn primary-btn text-center disabled"><br>
                        <?php echo 'Unavailable'; ?>
                      </a>
                    <?php else: ?>
                      <a href="index.php?room_id=<?=$room->id?>" class="btn primary-btn text-center"><br>
                        <?php echo 'Available'; ?>
                      </a>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
          <!-- <div class="col-lg-12">
            <div class="room-pagination">
              <a href="#">1</a>
              <a href="#">2</a>
              <a href="#">Next <i class="fa fa-long-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
    Rooms Section End -->

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
