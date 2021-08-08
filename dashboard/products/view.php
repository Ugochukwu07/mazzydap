<?php 
	include('../../path.php');
	include(ROOT_PATH . '/app/controllers/products.php');

	$title = substr($product['title'], 0, 12);
?>
<!DOCTYPE html>
<html lang="en">
<?php include(ROOT_PATH . '/app/includes/link_dash_top.php'); ?>

<body class="">
    <?php include(ROOT_PATH . '/app/includes/header_dash.php'); ?>

<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="page-header-title">
                            <h5 class="m-b-10"><?php echo $title; ?></h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item"><a href="index.html">Products</a></li>
                            <li class="breadcrumb-item"><?php echo $title; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <?php include(ROOT_PATH . '/app/includes/message.php'); ?>
            <!-- support-section start -->
            <div class="col-xl-12 col-md-12">
                <div class="row">
                        <div class="col-md-10 mx-auto col-lg-10 col-12">
                            <div class="card">
                                <div class="card-header text-center">
                                    <img class="img-fluid card-img-top col-6 mx-auto rounded-circle mb-2" src="<?php echo BASE_URL . '/assets/dashboard/images/products/' . $product['thumb_image']; ?>" alt="<?php echo $product['title']; ?>">
                                    <br><br>
                                    <h3 class="card-title text-primary"><?php echo $product['title']; ?></h3>
                                </div> 
                                <div class="card-body">
                                    <?php foreach($product as $key => $value):?>
                                        <?php if($key !== 'id' || $key !== 'thumb_image'):?>
                                            <h4 class="card-text"><?php $key = str_replace('_', ' ', $key); echo ucwords($key); ?></h4>
                                            <p class="card-text bg-light p-1 rounded"><?php echo $value; ?></p>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </div>
                                <div class="card-footer text-center">
                                    <a class="btn btn-success" href="<?php echo BASE_URL . '/design/' . $product['token']; ?>">View As User</a>
                                    <a class="btn btn-primary" href="<?php echo BASE_URL . '/dashboard/products/update.php?p_id=' . $product['id']; ?>">Edit</a>
                                    <a class="btn btn-danger" href="<?php echo BASE_URL . '/dashboard/products/?p_del_id=' . $product['id']; ?>">Delete</a>
                                </div>
                            </div>
                        </div>
                    <?php // include(ROOT_PATH . '/app/includes/paging.php'); ?>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->
</div>
    <!-- Warning Section start -->
    <!-- Older IE warning message -->
    <!--[if lt IE 11]>
        <div class="ie-warning">
            <h1>Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade
               <br/>to any of the following web browsers to access this website.
            </p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="assets/images/browser/chrome.png" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="assets/images/browser/firefox.png" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="assets/images/browser/opera.png" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="assets/images/browser/safari.png" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="assets/images/browser/ie.png" alt="">
                            <div>IE (11 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
    <![endif]-->
    <!-- Warning Section Ends -->
    <?php include(ROOT_PATH . '/app/includes/link_dash_bottom.php'); ?>
</body>

</html>
