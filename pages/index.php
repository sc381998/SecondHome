<?php 
if (!defined('fileIncluded')) {
    exit();
}
$name = '';
$accomodation_name = '';
$email = '';
$city = '';
$mobile = '';
$accomodation = '';
$price = '';
$type = '';
$picture = '';
$address = '';
$status = 1;
$flag = 1;
$msg = '';
$to ='';
$from = '';
$tmp = '';
//$subject = "Feedback from $subject";
$subject = '';
$find = '';
$replace = '';
$Mailbody ='';
$hidden = false;
$formShow = true;
$process = false;
$hasError = true;
$info = '';
//If the form is submitted
// print_r($_FILES);
// exit();
// print_r($_POST);

if (!empty($_POST)) {
  // echo "string";
    
    $name = @strip_tags($_POST['name']);
    $accomodation_name = @strip_tags($_POST['accomodationname']);
    $email = @strip_tags($_POST['email']);
    $city = @strip_tags($_POST['city']);
    $mobile = @strip_tags($_POST['phonenumber']);
    $pageLink = @$_SERVER['HTTP_REFERER'];
    $accomodation = @strip_tags($_POST['accomodation']);
    $price = @strip_tags($_POST['price']);
    $type = @strip_tags($_POST['type']);
    // $picture = $_FILES['file']['name'];
    $picture = @strip_tags($_FILES['file']['name']);
    $tmp = @strip_tags($_FILES['file']['tmp_name']);
    $address = @strip_tags($_POST['address']);
    $info = @strip_tags($_POST['info']);
    $status = 1;
    $path = "uploads/";
   
if (!$sys->validateMe($name) || !$sys->validateMe($accomodation_name) || !$sys->validateMe($email, 'email') || !is_numeric($mobile) || !is_numeric($price)) {
        $process = false;
        $hasError = true;
    } else if ($chk->validCaptcha() == false) {
        $hasError = true;
        $process = false;
    } else {
        $hasError = false;
        $process = true;
    }

    // Alls Right Baby Insert to DB & Mail
    if ($process == true && $hasError == false) {
        // Prepare the SQL for the Record Addition
      $statement = $pdocon->prepare('INSERT INTO insertqry 
        (name, accomodation_name, email, city, mobile, accomodation, price, type, picture, address, info, status)
        VALUES (:name, :accomodation_name, :email, :city, :mobile, :accomodation, :price, :type, :picture, :address, :info, :status)');

    $mResult = $statement->execute([
      ':name' => $name,
      ':accomodation_name' => $accomodation_name,
      ':email' => $email,
      ':city' => $city,
      ':mobile' => $mobile,
      ':accomodation' => $accomodation,
      ':price' => $price,
      ':type' => $type,
      ':picture' => $picture,
      ':address' => $address,
      ':info' => $info,
      ':status' => $status
    ]);
            if ($mResult) {
                $msg = $sysmsg['contact_message_success'];
                $formShow = false;
                $hidden = false;
                echo '<script>console.log("succesfully done")</script>';
                move_uploaded_file($tmp, $path . $picture);
                $flag =1;
            } else {
              echo '<script>console.log("succesfully not done")</script>';
            }
    }
}

if (!empty($msg) && $flag ==1) {
    echo '<div class="container"><div class="row"><div class="col-md-12">' . $msg . '</div></div></div>';
    $flag++;
}
$stmt = $pdocon->prepare("SELECT * FROM insertqry");
$stmt->execute();
$result = $stmt->fetchAll();
// print_r($result);

?>
<div id="mybutton">
  <button type="button" data-toggle="modal" data-target="#myModal" class="feedback">Submit Your Accomodation</button>
</div>
<section class="container bg-black-50 align-content-center">
  <div class="col-lg-12 col-md-12">
    <div class="modal-title">
      <h1 class="text-capitalize text-center text-red m-3">Categories</h1>
    </div>
    <hr class="w-50 mx-auto">
    <small class="d-block text-center"> Be the first to accommodate yourself in Hostel or PG near your desired location at cheapest prices.</small>
    <div class="row">
      <div class="col-lg-4 col-sm-12">
        <div class="mt-4 card text-white mptCard category-section-card" >
          <img class="categories-img rounded" src="assets/img/hostel.jpg" alt="Card image cap">
          <div class="category-section-card__img-overlay">
            <span class="">Hostel</span>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12">
        <div class="mt-4 card text-white mptCard category-section-card" >
          <img class="categories-img rounded" src="assets/img/pg.jpg" alt="Card image cap">
          <div class="category-section-card__img-overlay">
            <span class="">Paying Guest</span>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12">
        <div class="mt-4 card text-white mptCard category-section-card" >
          <img class="categories-img rounded" src="assets/img/flat.jpg" alt="Card image cap">
          <div class="category-section-card__img-overlay">
            <span class="">Flat/Apartment</span>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12">
        <div class="mt-4 card text-white mptCard category-section-card" >
          <img class="categories-img rounded" src="assets/img/roomrent.jpg" alt="Card image cap">
          <div class="category-section-card__img-overlay">
            <span class="">Room Rent</span>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12">
        <div class="mt-4 card text-white mptCard category-section-card" >
          <img class="categories-img rounded" src="assets/img/renthouse.jpg" alt="Card image cap">
          <div class="category-section-card__img-overlay">
            <span class="">Rent House</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- add hostel start -->
<section class="submit-property-one text-center">
  <div class="card img-fluid bg-1">
    <img class="card-img-top bg-2" src="assets/img/img-23.jpg" alt="Card image">
    <div class="card-img-overlay mt-5">
      <h4 class="card-title text-success">SECOND HOME</h4>
      <p class="card-text text-left">SecondHome Help You to Find PG, Hostels, Service Apartment &amp; much more with Suitable Accommodation.</br>

<strong>SecondHome</strong> is an online place where you will be able to effortlessly search for a decent, nice stay for yourself in the location of your choice. With growing awareness about careers the youth is out of their house to find a right and a
fulfilling job for themselves and for which they travel places either to take matching education or work as interns or else take up jobs. <strong>SecondHome</strong> provides you a range of accommodation according to your suitability at just
the click of a key. </br>
</br>
The best way to address this need was through a mix of technology and  offline efforts. On the technology front, we ended up discovering innumerous websites that will only communicate listings, random broker contacts, wrong photos to name a few, and many times just end up adding to the miseries of the home seeker as well as the sharer.</br></p>
      <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-lg text-light btn-success text-center border-0 mt-5 feedback">Submit Your Accomodation</button>
    </div>
  </div>
</section>
<!-- add list end -->
<div class="container abcd my-3">
    <div class="modal-title">
      <h1 class="text-capitalize text-center text-red m-3">Hostel & PG list</h1>
    </div>
    <hr class="w-50 mx-auto">
    <small class="d-block text-center mb-5"> Be the first to accommodate yourself in Hostel or PG near your desired location at cheapest prices. To check out all<a class="fs-18" href="accomodation.php"> click here</a></small>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner row w-100 mx-auto">
        <?php
           foreach ($result as $k => $rs) {
            if ($k == 1) { ?>
        <div class="carousel-item col-md-4 active">
          <div class="card">
            <img class="card-img-top" src="uploads/<?php echo $rs['picture'] ?>" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title text-capitalize"><?php echo $rs['accomodation_name'] ?></h5>
              <button class="type"><?php echo $rs['type'] ?></button>
              <p class="card-text" row="2"><?php echo $rs['address'] ?></p>
              <a href="#" class="price">&#8377;<?php echo $rs['price'] ?></a>
              <div class="overlay">
                <div class="text row">
                  <div class="col-md-12">
                    <!-- <div class="row"> -->
                      <div class="col-md-12"><h5 class="card-title text-capitalize"><i class="fa fa-address-book p-2"></i><?php echo $rs['accomodation_name'] ?></h5></div>
                      <div class="col-md-12"><p class=""><i class="fa fa-transgender p-2"></i><?php echo $rs['type'] ?></p></div>
                      <div class="col-md-12"><p class=""><i class="fa fa-money p-2"></i>&#8377;<?php echo $rs['price'] ?></p></div>
                      <div class="col-md-12"><p class=""><i class="fa fa-location-arrow p-2"></i><?php echo $rs['mobile'] ?></p>
                      </div>
                    <div class="col-md-12"><p class=""><i class="fa fa-map-marker p-2"></i><?php echo $rs['address'] ?></p>
                    </div>
                    <div class="col-md-12"><p class=""><i class="fa fa-info-circle p-2"></i><?php echo $rs['info'] ?></p></div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      <?php }else{?>
        <div class="carousel-item col-md-4">
          <div class="card">
            <img class="card-img-top" src="uploads/<?php echo $rs['picture'] ?>" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title text-capitalize"><?php echo $rs['accomodation_name'] ?></h5>
              <button class="type"><?php echo $rs['type'] ?></button>
              <p class="card-text" row="2"><?php echo $rs['address'] ?></p>
              <a href="#" class="price">&#8377;<?php echo $rs['price'] ?></a>
              <div class="overlay">
                <div class="text row">
                  <div class="col-md-12">
                    <!-- <div class="row"> -->
                      <div class="col-md-12"><h5 class="card-title text-capitalize"><i class="fa fa-address-book p-2"></i><?php echo $rs['accomodation_name'] ?></h5></div>
                      <div class="col-md-12"><p class=""><i class="fa fa-transgender p-2"></i><?php echo $rs['type'] ?></p></div>
                      <div class="col-md-12"><p class=""><i class="fa fa-money p-2"></i>&#8377;<?php echo $rs['price'] ?></p></div>
                      <div class="col-md-12"><p class=""><i class="fa fa-location-arrow p-2"></i><?php echo $rs['mobile'] ?></p>
                      </div>
                    <div class="col-md-12"><p class=""><i class="fa fa-map-marker p-2"></i><?php echo $rs['address'] ?></p>
                    </div>
                    <div class="col-md-12"><p class=""><i class="fa fa-info-circle p-2"></i><?php echo $rs['info'] ?></p></div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      <?php } } ?>
      </div>
    </div>
  </div>
<!-- hostel list start -->




<!-- hostel list end -->
<script>
$(document).ready(function(){
  "use strict";
  // Auto-scroll
  $('#myCarousel').carousel({
    interval: 4000
  });

  // // Control buttons
  // $('.next').click(function () {
  //   $('.carousel').carousel('next');
  //   return false;
  // });
  // $('.prev').click(function () {
  //   $('.carousel').carousel('prev');
  //   return false;
  // });

  // On carousel scroll
  $("#myCarousel").on("slide.bs.carousel", function (e) {
    var $e = $(e.relatedTarget);
    var idx = $e.index();
    var itemsPerSlide = 3;
    var totalItems = $(".carousel-item").length;
    if (idx >= totalItems - (itemsPerSlide - 1)) {
      var it = itemsPerSlide - (totalItems - idx);
      for (var i = 0; i < it; i++) {
        // append slides to end 
        if (e.direction == "left") {
          $(
            ".carousel-item").eq(i).appendTo(".carousel-inner");
        } else {
          $(".carousel-item").eq(0).appendTo(".carousel-inner");
        }
      }
    }
  });
});
</script>

