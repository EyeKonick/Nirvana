<?php
  session_start();
  include 'db_connection.php';
  $selected_room_name = "";
  $query = "SELECT * FROM `room_type_tbl`";
  $room_types_sql = mysqli_query($connection, $query);
  
  $_SESSION['room_types'] = array();
  while ($room_type = mysqli_fetch_assoc($room_types_sql)){
    array_push($_SESSION['room_types'], $room_type);
  }
  
  if(isset($_GET['room_id']) && !empty($_GET['room_id'])){
    $_SESSION['selected_room_id'] = $_GET['room_id'];
    $selected_room_id = $_SESSION['selected_room_id'];
    $query = "SELECT `room_tbl`.*, `room_type_tbl`.`room_name` FROM `room_tbl` INNER JOIN `room_type_tbl` ON `room_tbl`.room_type_id = `room_type_tbl`.id WHERE `room_tbl`.`id`=$selected_room_id";
    $room_sql = mysqli_query($connection, $query);
    $selected_room = mysqli_fetch_assoc($room_sql);
    $selected_room_name = $selected_room['room_name'];
  }
  if (isset($_POST["date_in"]) && !empty($_POST["date_in"]) &&  isset($_POST["date_out"]) &&!empty($_POST["date_out"])){
    $date_in = new DateTime($_POST['date_in']);
    $date_out = new DateTime($_POST['date_out']);
    $formated_in = $date_in->format("Y-m-d");
    $formated_out = $date_out->format("Y-m-d");
    $selected_room_id = $_SESSION['selected_room_id'];
    $query = "INSERT INTO `bookings_tbl` (`room_id`, `check_in`, `check_out`) VALUES ($selected_room_id, '$formated_in', '$formated_out');";
    $query_success = mysqli_query($connection, $query);

    
  }
?>
<!DOCTYPE html>
<html lang="zxx">
  <head>
    <meta charset="UTF-8" />
    <meta name="description" content="Nirvana" />
    <meta name="keywords" content="Sona, unica, creative, html" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
          <li><a href="./about-us.php">About Us</a></li>
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
                    <li class="active"><a href="./index.php">Home</a></li>
                    <li><a href="./rooms.php">Rooms</a></li>
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

    <!-- Hero Section Begin -->
    <section class="hero-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="hero-text">
              <h1>Nirvana Highland Resort</h1>
              <p>BARANGAY AGTAMBI, DAO, CAPIZ</p>
            </div>
          </div>
          <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
            <div class="booking-form">
              <h3>Booking Your Hotel</h3>
              <form action="rooms.php">
                <div class="choose-room mb-3">
                  <button onclick="location.href='rooms.php'">Choose room</button>
                  <input class="room-field" type="text" placeholder="<?php echo $selected_room_name ?>" disabled>
                </div>
              </form>
              <form action="index.php" method="post">
              <div class="check-date">
                  <label for="date-in">Check In:</label>
                  <input type="text" class="date-input" id="date-in" name="date_in"/>
                  <i class="icon_calendar"></i>
                </div>
                <div class="check-date">
                  <label for="date-out">Check Out:</label>
                  <input type="text" class="date-input" id="date-out" name="date_out"/>
                  <i class="icon_calendar"></i>
                </div>
                <button type="submit" class="book_btn">BOOK NOW
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="hero-slider owl-carousel">
        <div class="hs-item set-bg" data-setbg="img/hero/hero-1.jpg"></div>
        <div class="hs-item set-bg" data-setbg="img/hero/hero-2.jpg"></div>
        <div class="hs-item set-bg" data-setbg="img/hero/hero-3.jpg"></div>
      </div>
    </section>
    <!-- Hero Section End -->

    <!-- About Us Section Begin -->
    <section class="aboutus-section spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="about-text">
              <div class="section-title">
                <span>About Us</span>
                <h2>NIRVANA<br />HIGHLAND RESORT</h2>
              </div>
              <p class="f-para">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Possimus eos quia neque maxime sapiente officiis magni optio
                facere iure animi? Inventore repudiandae cupiditate vitae
                numquam itaque unde sint nam provident..
              </p>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="about-pic">
              <div class="row">
                <div class="col-sm-6">
                  <img src="img/about/about-1.jpg" alt="" />
                </div>
                <div class="col-sm-6">
                  <img src="img/about/about-2.jpg" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- About Us Section End -->

    <!-- Home Room Section Begin -->
    <section class="hp-room-section">
      <div class="container-fluid">
        <div class="hp-room-items">
          <div class="row">
            <?php
              // Temporary array for room images -> TODO: Remove if replacement is found
              $png_array = array("img/room/venue-hall.png","img/room/bahay-kubo.png", "img/room/bahay-medium.png", "img/room/bahay-medium.png");
              for($count = 0; $count < 4; $count++){
            ?>
            <div class="col-lg-3 col-md-6">
              <div
                class="hp-room-item set-bg"
                data-setbg=<?php echo $png_array[$count] ?>
              >
                <div class="hr-text">
                  <h3><?php echo $_SESSION['room_types'][$count]['room_name'] ?></h3>
                  <h2>₱<?php echo $_SESSION['room_types'][$count]['cost'] ?><span>/Pernight</span></h2>
                  <table>
                    <tbody>
                      <tr>
                        <td class="r-o">Size:</td>
                        <td><?php echo $_SESSION['room_types'][$count]['size'] ?> ft</td>
                      </tr>
                      <tr>
                        <td class="r-o">Capacity:</td>
                        <td>Max person <?php echo $_SESSION['room_types'][$count]['capacity'] ?></td>
                      </tr>
                      <tr>
                        <td class="r-o">Bed:</td>
                        <td><?php echo $_SESSION['room_types'][$count]['bed'] ?></td>
                      </tr>
                      <tr>
                        <td class="r-o">Services:</td>
                        <td><?php echo $_SESSION['room_types'][$count]['services'] ?></td>
                      </tr>
                    </tbody>
                  </table>
                  <a href="./rooms.php" class="primary-btn">SEE MORE</a>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </section>
    <!-- Home Room Section End -->

    <!-- Testimonial Section Begin -->
    <section class="testimonial-section spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-title">
              <span>Testimonials</span>
              <h2>What Customers Say?</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8 offset-lg-2">
            <div class="testimonial-slider owl-carousel">
              <div class="ts-item">
                <p>
                  My experience in Nirvana's Highlands Resort was a memorable experience together with my friends. I never get bored because there are lots of activities to do inside the resort. For me, this is the best place to go if you are planing to unwind,or to have vacation, and even a venue for some ocasions such as birthdays, wedding etc. 
                </p>
                <div class="ti-author">
                  <div class="rating">
                    <i class="icon_star"></i>
                    <i class="icon_star"></i>
                    <i class="icon_star"></i>
                    <i class="icon_star"></i>
                    <i class="icon_star-half_alt"></i>
                  </div>
                  <h5>- Jennel Franco</h5>
                </div>
                <img style="height: 100px; width: 100px; border-radius: 50%;" src="img/testimonial/user1.jpg" alt="" />
              </div>
              <div class="ts-item">
                <p>
                  Ang Nirvana's Highlands Resort ay masarap balik balikan dahil sa ganda ng tanawin, masarap mag swimming, at maraming pwedeng gawin na siguradong sulit ang pera mo. Ang paligid doon ay napakalinis na kahit isang pirasong plastic ay wala kang makikita dahil disiplinado ang mga tao doon. kaya ano pang hinihintay mo, ayain mo na ang iyong mga barkada or kapamilya dahil mas lalong mag-eenjoy ka pag marami kang kasama. 
                </p>
                <div class="ti-author">
                  <div class="rating">
                    <i class="icon_star"></i>
                    <i class="icon_star"></i>
                    <i class="icon_star"></i>
                    <i class="icon_star"></i>
                    <i class="icon_star-half_alt"></i>
                  </div>
                  <h5>- Benji Apostol</h5>
                </div>
                <img style="height: 100px; width: 100px; border-radius: 50%;" src="img/testimonial/user2.jpg" alt="" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Testimonial Section End -->

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

<?php

  if($query_success){

    ?>

    <script>

    swal({
      title: "Good job!",
      text: "Successfully Booked",
      icon: "success",
    });

    </script>

    <?php
  }


?>