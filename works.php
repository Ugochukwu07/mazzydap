<?php 
include('path.php');
include(ROOT_PATH . '/app/controllers/products.php');

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
                  <li><a href="/">Home</a></li>
                  <li><a href="#">Projects</a></li>
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
            <h2>Projects</h2>
          </div>
        </div>
        <div class="col-lg-6 v-center">
          <div class="filters">
            <ul class="filter-menu">
              <li data-filter="*" class="is-checked">All</li>
              <?php foreach($categories as $cat):?>
                <li data-filter=".<?php echo str_replace(' ', '', $cat['name']); ?>"><?php echo $cat['name']; ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="row card-list">
        <div class="col-lg-4 col-md-6 grid-sizer"></div>
        <?php foreach($products as $product): ?>
          <?php $cat = selectOne($table2, ['id' => $product['cat_id']]); ?>
          <div class="col-lg-4 col-sm-4 mt40 single-card-item <?php echo str_replace(' ', '', $cat['name']); ?>">
            <div class="isotope_item up-hor">
              <div class="item-image">
                <a href="<?php echo BASE_URL . '/design/' . $product['token']; ?>"><img src="<?php echo BASE_URL . '/assets/dashboard/images/products/' . $product['thumb_image']; ?>" alt="image" class="img-fluid" /> </a>
              </div>
              <div class="item-info-div shdo">
                <h4><a href="<?php echo BASE_URL . '/design/' . $product['token']; ?>" style="color: black;"><?php echo $product['title']; ?></a></h4>
                <p><?php echo $cat['name']; ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
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