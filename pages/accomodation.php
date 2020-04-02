<?php 
// print_r($_POST);
$sqla = "SELECT * from insertqry where status=1";
$f = 0;
$area = '';
if (isset($_POST['area'])) {
    $area = $_POST['area'];
    $area_c = ucfirst($area);
    $sqla .= " and address like '%$area%' or address like '%$area_c%'";
}
// print_r($sqla);
$stmt = $pdocon->prepare($sqla);
$f = $stmt->execute();
// unset($sqla);
$result = $stmt->fetchAll();
// unset($stmt);
?>

<style>
   * { box-sizing: border-box; }

body {
  font-family: sans-serif;
}

/* ---- button ---- */

.button {
  display: inline-block;
  padding: 10px 18px;
  margin-bottom: 10px;
  background: #EEE;
  border: none;
  border-radius: 7px;
  background-image: linear-gradient( to bottom, hsla(0, 0%, 0%, 0), hsla(0, 0%, 0%, 0.2) );
  color: #222;
  font-family: sans-serif;
  font-size: 16px;
  text-shadow: 0 1px white;
  cursor: pointer;
}

.button:hover {
  background-color: #8CF;
  text-shadow: 0 1px hsla(0, 0%, 100%, 0.5);
  color: #222;
}

.button:active,
.button.is-checked {
  background-color: #28F;
}

.button.is-checked {
  color: white;
  text-shadow: 0 -1px hsla(0, 0%, 0%, 0.8);
}

.button:active {
  box-shadow: inset 0 1px 10px hsla(0, 0%, 0%, 0.8);
}

/* ---- button-group ---- */
/*.button-group{
  position: relative;
  right: 80px;
}*/
.button-group:after {
  content: '';
  display: block;
  clear: both;
}

.button-group .button {
  /*float: left;*/
  position: relative;
    /* text-align: center; */
  left: 28%;
  border-radius: 0;
  margin-left: 0;
  margin-right: 1px;
}
@media only screen and (max-width: 750px) {
  .button-group .button {
  /*float: left;*/
  position: relative;
    /* text-align: center; */
  left: 10%;
  border-radius: 0;
  margin-left: 0;
  margin-right: 1px;
}
}
.button-group .button:first-child { border-radius: 0.5em 0 0 0.5em; }
.button-group .button:last-child { border-radius: 0 0.5em 0.5em 0; }

/* ---- isotope ---- */

.grid {
  border: 1px solid #333;
}

/* clear fix */
.grid:after {
  content: '';
  display: block;
  clear: both;
}
.element-item { width: 32%; }
@media only screen and (max-width: 750px) {
  .element-item { width: 100%; }
}
</style>
<section>
<div class=" my-3 col-lg-12 col-md-12 col-sm-12">
    <div class="modal-title">
      <h1 class="text-capitalize text-center text-red m-3">Accomodation list</h1>
    </div>
    <hr class="w-50 mx-auto">
    <small class="d-block text-center mb-5"> Be the first to accommodate yourself in Hostel or PG near your desired location at cheapest prices</small>
        <section class="isotop">
          <div class="button-group filters-button-group">
            <button class="button is-checked" data-filter="*">show all</button>
            <button class="button" data-filter=".hostel">Hostel</button>
            <button class="button" data-filter=".paying_guest">Paying Guest</button>
            <button class="button" data-filter=".room_rent">Room Rent</button>
            <button class="button" data-filter=".flat">Flat</button>
            <button class="button" data-filter=".rent_house">Rent House</button>
          </div>
        </section>
        <div class="container abcd">
          <div class="row">
        <?php
        if($stmt->rowCount() != 0){
          foreach ($result as $rs) {
        ?>

        <div class="element-item col-lg-4 mb-4 <?php echo $rs['accomodation'] ?> grid-item"  data-area="<?php echo $rs['accomodation'] ?>">
          <div class="card">
            <img class="card-img-top" src="uploads/<?php echo $rs['picture'] ?>" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title text-capitalize"><?php echo $rs['accomodation_name'] ?></h5>
              <button class="type text-capitalize"><?php echo $rs['type'] ?></button>
              <p class="card-text" row="2"><?php echo $rs['address'] ?></p>
              <a href="#" class="price">&#8377;<?php echo $rs['price'] ?></a>
              <div class="overlay">
                <div class="text row ">
                  <div class="col-md-12">
                    <!-- <div class="row"> -->
                      <div class="col-md-12"><h5 class="card-title text-capitalize"><i class="fa fa-address-book p-2"></i><?php echo $rs['accomodation_name'] ?></h5></div>
                      <div class="col-md-12"><p class="text-capitalize"><i class="fa fa-transgender p-2"></i><?php echo $rs['type'] ?></p></div>
                    <!-- </div> -->
                    <!-- <div class="row"> -->
                      <div class="col-md-12"><p class=""><i class="fa fa-money p-2"></i>&#8377;<?php echo $rs['price'] ?></p></div>
                      <div class="col-md-12"><p class=""><i class="fa fa-location-arrow p-2"></i><?php echo $rs['mobile'] ?></p>
                      </div>
                    <!-- </div> -->
                    <div class="col-md-12"><p class="card-text" row="3"><i class="fa fa-map-marker p-2"></i><?php echo $rs['address'] ?></p>
                      <div class="col-md-12"><p class="card-text"><i class="fa fa-info-circle p-2"></i><?php echo $rs['info'] ?></p></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } }else{
        echo '<script>alert("The requested Data could not be found.");</script>';
        // echo '<div class="container"><div class="row"><div class="col-md-12">' . $sysmsg['no_data'] . '</div></div></div';
      }
      ?>
        </div>
      </div>
    </div>
</section>
<script>
  // external js: isotope.pkgd.js

// init Isotope
var $grid = $('.abcd').isotope({
  itemSelector: '.element-item',
  percentPosition: true,
    masonry: {
    // use element for option
    columnWidth: '.element-item'
  }
});
// filter functions
var filterFns = '';
// bind filter button click
$('.filters-button-group').on( 'click', 'button', function() {
  var filterValue = $( this ).attr('data-filter');
  // use filterFn if matches value
  filterValue = filterFns[ filterValue ] || filterValue;
  $grid.isotope({ filter: filterValue });
});
// change is-checked class on buttons
$('.button-group').each( function( i, buttonGroup ) {
  var $buttonGroup = $( buttonGroup );
  $buttonGroup.on( 'click', 'button', function() {
    $buttonGroup.find('.is-checked').removeClass('is-checked');
    $( this ).addClass('is-checked');
  });
});

</script>