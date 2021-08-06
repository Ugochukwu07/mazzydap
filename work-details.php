<?php 
include('path.php');
include(ROOT_PATH . '/app/controllers/products.php');

$title = $product['title'];
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<?php include(ROOT_PATH . '/app/includes/link_open_top.php'); ?>

<body class="active-dark">
    <?php include(ROOT_PATH . '/app/includes/header_open.php'); ?>
  <!--Breadcrumb Area-->
  <style>
    .banner-3{
      background: url(<?php echo BASE_URL . '/assets/dashboard/images/products/' . $product['thumb_image']; ?>);
      background-position: center;
      background-attachment: fixed;
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>
  <section class="breadcrumb-area banner-3">
    <div class="text-block">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 v-center">
            <div class="bread-inner">
              <div class="bread-menu">
                <ul>
                  <li><a href="<?php echo BASE_URL . '/'?>">Home</a></li>
                  <li><a href="<?php echo BASE_URL . '/works'?>">Products</a></li>
                  <li><a href="#"><?php echo $product['title']; ?></a></li>
                </ul>
              </div>
              <div class="bread-title">
                <h2><?php echo $product['title']; ?></h2>
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
            <span><?php echo $category['name']; ?></span>
            <h1><?php echo $product['title']; ?></h1>
            <?php echo $product['about']; ?>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="portfolio-details">
            <div class="portfolio-meta link-hover">
              <ul>
                <li>
                  <i class="fas fa-user"></i>
                  <p>Client Name: <span><?php echo $product['client_name']; ?></span></p>
                </li>
                <li>
                  <i class="fas fa-phone"></i>
                  <p>Client Phone: <span><?php echo $product['client_phone']; ?></span></p>
                </li>
                <li>
                  <i class="fas fa-envelope"></i>
                  <p>Client Email: <span><?php echo $product['client_email']; ?></span></p>
                </li>
                <li>
                  <i class="fas fa-tags"></i>
                  <p>Project Category: <span><?php echo $category['name']; ?></span></p>
                </li>
                <li>
                  <i class="fas fa-calendar-alt"></i>
                  <p>Project Date: <span><?php echo date('F j, Y', strtotime($product['created_at'])); ?></span></p>
                </li>
                <li><a href="<?php echo $product['ex_link']; ?>" target="_blank">Open External Link</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <?php $files = selectAll($table3, ['product_id' => $product['id']]); $fx = 0;?>
        <?php foreach($files as $file):?>
          <div class="col-lg-4 col-md-6 col-12 single-card-item">
            <div class="isotope_item pv- <?php if($fx === 0){echo '';}else{echo "mt30";}?>">
              <div class="item-image">
                <img src="<?php echo BASE_URL . '/assets/dashboard/images/files/' . $file['name']; ?>" alt="<?php echo $product['name'] . '_' . $file['id']; ?>" class="img-fluid"/>
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