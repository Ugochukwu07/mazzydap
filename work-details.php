<?php 
include('path.php');

$title = 'Details';
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
                  <li><a href="portfolio.html">Portfolio</a></li>
                  <li><a href="#">Portfolio Details</a></li>
                </ul>
              </div>
              <div class="bread-title">
                <h2>Our Portfolio</h2>
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
        <div class="col-lg-7">
          <div class="common-heading pp p-details">
            <span>Branding Creative</span>
            <h1>Justo Erat Tempor Eros Adipiscing</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse faucibus, risus sit amet auctor sodales, justo erat tempor eros.</p>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="portfolio-details">
            <div class="portfolio-meta link-hover">
              <ul>
                <li>
                  <i class="fas fa-user"></i>
                  <p>Client Name: <span>Creative Tom</span></p>
                </li>
                <li>
                  <i class="fas fa-tags"></i>
                  <p>Project Category: <span>Web design, Developments</span></p>
                </li>
                <li>
                  <i class="fas fa-calendar-alt"></i>
                  <p>Project Date: <span>20 May 2020</span></p>
                </li>
                <li><a href="#" target="_blank">Open External Link</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 single-card-item">
          <div class="isotope_item pv-">
            <div class="item-image">
              <img src="images/portfolio/project-view-1.jpg" alt="project name" class="img-fluid"/>
             </div>
            </div>
    <div class="isotope_item pv- mt30">
            <div class="item-image">
        <img src="images/portfolio/project-view-2.jpg" alt="project name" class="img-fluid"/>
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