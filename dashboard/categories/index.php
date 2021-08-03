<?php 
	include('../../path.php');
	include(ROOT_PATH . '/app/controllers/categories.php');

	$title = $xUser['username'] . "'s Dashboard";
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
                    <div class="col-12">
                        <h5>Recent Categories</h5>
                    </div>
                    <hr>
                    <?php $categories = selectAllLimits('category', [], $start, $results_per_page);?>
                    <?php foreach($categories as $category):?>
                        <div class="col-md-12 col-lg-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <img class="img-fluid card-img-top rounded mb-2" src="<?php echo BASE_URL . '/assets/dashboard/images/categories/' . $category['image']; ?>" alt="<?php echo $category['name']; ?>">
                                    <br><br>
                                    <h3 class="card-title text-primary"><?php echo $category['name']; ?></h3>
                                </div> 
                                <div class="card-body">
                                    <p class="card-text"><?php echo html_entity_decode(substr($category['body'], 0, 350) . '...'); ?></p>
                                    <p class="card-text"><small class="text-muted">Last updated <?php echo timeDiff('now', $category['created_at']);?> ago</small></p>
                                </div>
                                <div class="card-footer text-center">
                                    <a class="btn btn-primary" href="<?php echo BASE_URL . '/dashboard/categories/update.php?cat_id=' . $category['id']; ?>">Edit</a>
                                    <a class="btn btn-danger" href="<?php echo BASE_URL . '/dashboard/categories/?cat_del_id=' . $category['id']; ?>">Delete</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
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
