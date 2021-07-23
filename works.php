<?php 
include('path.php');

$title = 'Our Portfolio';
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<?php include(ROOT_PATH . '/app/includes/link_open_top.php'); ?>

<body class="active-dark">
    <?php include(ROOT_PATH . '/app/includes/header_open.php'); ?>
<!--Breadcrumb Area-->
<section class="breadcrumb-area banner-3">
<div class="text-block">
<div class="container">
<div class="row">
<div class="col-lg-12 v-center">
<div class="bread-inner">
<div class="bread-menu">
<ul>
<li><a href="index.html">Home</a></li>
<li><a href="#">Portfolio</a></li>
</ul>
</div>
<div class="bread-title">
<h2>Our Projects</h2>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!--End Breadcrumb Area-->
<!--Start Portfolio-->
<section class="portfolio-page pad-tb">
<div class="container">
<div class="row justify-content-left">
<div class="col-lg-6">
<div class="common-heading pp">
<span>Our Work</span>
<h2>Portfolio</h2>
</div>
</div>
<div class="col-lg-6 v-center">
<div class="filters">
<ul class="filter-menu">
<li data-filter="*" class="is-checked">All</li>
<li data-filter=".website">Website</li>
<li data-filter=".app">Mobile App</li>
<li data-filter=".graphic">Graphic</li>
</ul>
</div>
</div>
</div>
<div class="row card-list">
<div class="col-lg-4 col-md-6 grid-sizer"></div>
<div class="col-lg-4 col-sm-4 mt40 single-card-item website">
<div class="isotope_item up-hor">
<div class="item-image">
<a href="#"><img src="<?php echo BASE_URL . '/assets/open/images/'; ?>portfolio/app-img1.jpg" alt="image" class="img-fluid" /> </a>
</div>
<div class="item-info-div shdo">
<h4><a href="#">Pets Care & Training App</a></h4>
<p>iOs, Android</p>
</div>
</div>
</div>
<div class="col-lg-4 col-sm-4 mt40 single-card-item website">
<div class="isotope_item up-hor">
<div class="item-image">
<a href="#"><img src="<?php echo BASE_URL . '/assets/open/images/'; ?>portfolio/app-img2.jpg" alt="image" class="img-fluid" /> </a>
</div>
<div class="item-info-div shdo">
<h4><a href="#">Car Rental App</a></h4>
<p>Graphic, Print</p>
</div>
</div>
</div>
<div class="col-lg-12 col-sm-12 single-card-item app">
                <div class="portfolio-block bg-gradient8">
                  <div class="portfolio-item-info">
                    <span>ios, design</span>
                    <h3 class="mt30 mb30"><a href="#">UX design for a startup focusing on measuring Team Performance</a></h3>
                    <div class="reviews-card pr-shadow">
                      <div class="review-text">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                      </div>
                      <div class="-client-details-">
                        <div class="-reviewr">
                          <img src="<?php echo BASE_URL . '/assets/open/images/'; ?>client/reviewer-a.jpg" alt="Good Review" class="img-fluid">
                        </div>
                        <div class="reviewer-text">
                          <h4>Mario Speedwagon</h4>
                          <p>Business Owner, <small>Jaipur</small></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="portfolio-item-image">
                    <a href="#"><img src="<?php echo BASE_URL . '/assets/open/images/'; ?>portfolio/website-mockup1.jpg" alt="portfolio" class="img-fluid"/> </a>
                  </div>
                </div>
              </div>
<div class="col-lg-4 col-sm-4 mt40 single-card-item app graphic">
<div class="isotope_item up-hor">
<div class="item-image">
<a href="#"><img src="<?php echo BASE_URL . '/assets/open/images/'; ?>portfolio/app-img3.jpg" alt="image" class="img-fluid" /> </a>
</div>
<div class="item-info-div shdo">
<h4><a href="#">Event Management App</a></h4>
<p>Graphic, Print</p>
</div>
</div>
</div>
<div class="col-lg-4 col-sm-4 mt40 single-card-item app">
<div class="isotope_item up-hor">
<div class="item-image">
<a href="#"><img src="<?php echo BASE_URL . '/assets/open/images/'; ?>portfolio/app-img4.jpg" alt="image" class="img-fluid" /> </a>
</div>
<div class="item-info-div shdo">
<h4><a href="#">Restaurant App</a></h4>
<p>iOs, Android</p>
</div>
</div>
</div>
<div class="col-lg-4 col-sm-4 mt40 single-card-item graphic website">
<div class="isotope_item up-hor">
<div class="item-image">
<a href="#"><img src="<?php echo BASE_URL . '/assets/open/images/'; ?>portfolio/app-img5.jpg" alt="image" class="img-fluid" /> </a>
</div>
<div class="item-info-div shdo">
<h4><a href="#">Restaurant / Hotel App</a></h4>
<p>Graphic, Print</p>
</div>
</div>
</div>
<div class="col-lg-4 col-sm-4 mt40 single-card-item graphic app">
<div class="isotope_item up-hor">
<div class="item-image">
<a href="#"><img src="<?php echo BASE_URL . '/assets/open/images/'; ?>portfolio/app-img6.jpg" alt="image" class="img-fluid" /> </a>
</div>
<div class="item-info-div shdo">
<h4><a href="#">Super Mart App</a></h4>
<p>Graphic, Print</p>
</div>
</div>
</div>
</div>
</div>
</section>
<!--End Portfolio-->
<?php 
        include(ROOT_PATH . '/app/includes/location.php');
        include(ROOT_PATH . '/app/includes/footer_open.php');
        include(ROOT_PATH . '/app/includes/link_open_bottom.php');
    ?>
</body>

</html>