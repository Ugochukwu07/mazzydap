<?php 
	include('../path.php');
	include(ROOT_PATH . '/app/controllers/users.php');
    adminOnly();

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
            <div class="col-xl-6 col-md-12">
                <div class="card flat-card">
                    <div class="row border-bottom">
                        <div class="col-sm-6 col-6 col-md-4 card-body border-right border-bottom">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-shopping-cart text-primary mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5><?php echo count(selectAll('products'));?></h5>
                                    <span>Products</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-6 col-md-4 card-body border-right border-bottom">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-file-text text-primary mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5><?php echo count(selectAll('files'))?></h5>
                                    <span>Files</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-6 col-md-4 card-body border-right border-bottom">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-users text-primary mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5><?php echo count(selectAll('users', ['status' => 0]))?></h5>
                                    <span>Clients</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-6 col-md-4 card-body border-right border-bottom">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-mail text-primary mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5><?php echo count(selectAll('contact'));?></h5>
                                    <span>Messages</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-6 col-md-4 card-body border-right border-bottom">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-align-right text-primary mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5><?php echo count(selectAll('category'))?></h5>
                                    <span>Category</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-6 col-md-4 card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-users text-primary mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5><?php echo count(selectAll('users', ['status' => 0]))?></h5>
                                    <span>Growth</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5>Recent Products</h5>
                        <?php $products = selectAll('products');?>
                        <?php for($i = 0; $i < 5; $i++):?>
                            <div class="card mb-3">
                                <img class="img-fluid card-img-top" src="<?php echo BASE_URL . '/assets/dashboard/images/products/' . $products[$i]['thumb_image']; ?>" alt="<?php echo $products[$i]['title']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $products[$i]['title']; ?></h5>
                                    <p class="card-text"><?php echo html_entity_decode(substr($products[$i]['about'], 0, 150) . '...'); ?></p>
                                    <p class="card-text"><small class="text-muted">Last updated <?php echo timeDiff('now', $products[$i]['created_at']);?> ago</small></p>
                                </div>
                            </div>
                        <?php endfor;?>
                    </div>
                </div>
            </div>
            <!-- support-section end -->
            <!-- customer-section start -->
            <div class="col-xl-6 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>New Categories</h5>
                    </div>
                    <div class="pro-scroll" style="height:255px;position:relative;">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover m-b-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $categories = selectAll('category');?>
                                        <?php foreach($categories as $cat):?>
                                            <tr>
                                                <td><?php echo $cat['name']; ?></td>
                                                <td>
                                                    <a href="<?php echo BASE_URL . '/dashboard/categories/update.php?cat_id=' . $cat['id']; ?>"><i class="icon feather icon-edit f-16  text-success"></i></a>
                                                    <a href="<?php echo BASE_URL . '/dashboard/categories/?cat_del_id=' . $cat['id']; ?>"><i class="feather icon-trash-2 ml-3 f-16 text-danger"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-12">
                <div class="card feed-card">
                    <div class="card-header">
                        <h5>Feeds</h5>
                    </div>
                    <div class="feed-scroll" style="height:385px;position:relative;">
                        <div class="card-body">
                            <div class="row m-b-25 align-items-center">
                                <div class="col-auto p-r-0">
                                    <i data-feather="bell" class="badge-light-primary feed-icon"></i>
                                </div>
                                <div class="col">
                                    <a href="#!">
                                        <h6 class="m-b-5">You have 3 pending tasks. <span class="text-muted float-right f-14">Just Now</span></h6>
                                    </a>
                                </div>
                            </div>
                            <div class="row m-b-25 align-items-center">
                                <div class="col-auto p-r-0">
                                    <i data-feather="shopping-cart" class="badge-light-danger feed-icon"></i>
                                </div>
                                <div class="col">
                                    <a href="#!">
                                        <h6 class="m-b-5">New order received <span class="text-muted float-right f-14">30 min ago</span></h6>
                                    </a>
                                </div>
                            </div>
                            <div class="row m-b-25 align-items-center">
                                <div class="col-auto p-r-0">
                                    <i data-feather="file-text" class="badge-light-success feed-icon"></i>
                                </div>
                                <div class="col">
                                    <a href="#!">
                                        <h6 class="m-b-5">You have 3 pending tasks. <span class="text-muted float-right f-14">Just Now</span></h6>
                                    </a>
                                </div>
                            </div>
                            <div class="row m-b-25 align-items-center">
                                <div class="col-auto p-r-0">
                                    <i data-feather="bell" class="badge-light-primary feed-icon"></i>
                                </div>
                                <div class="col">
                                    <a href="#!">
                                        <h6 class="m-b-5">You have 4 tasks Done. <span class="text-muted float-right f-14">1 hours ago</span></h6>
                                    </a>
                                </div>
                            </div>
                            <div class="row m-b-25 align-items-center">
                                <div class="col-auto p-r-0">
                                    <i data-feather="file-text" class="badge-light-success feed-icon"></i>
                                </div>
                                <div class="col">
                                    <a href="#!">
                                        <h6 class="m-b-5">You have 2 pending tasks. <span class="text-muted float-right f-14">Just Now</span></h6>
                                    </a>
                                </div>
                            </div>
                            <div class="row m-b-25 align-items-center">
                                <div class="col-auto p-r-0">
                                    <i data-feather="shopping-cart" class="badge-light-danger feed-icon"></i>
                                </div>
                                <div class="col">
                                    <a href="#!">
                                        <h6 class="m-b-5">New order received <span class="text-muted float-right f-14">4 hours ago</span></h6>
                                    </a>
                                </div>
                            </div>
                            <div class="row m-b-25 align-items-center">
                                <div class="col-auto p-r-0">
                                    <i data-feather="shopping-cart" class="badge-light-danger feed-icon"></i>
                                </div>
                                <div class="col">
                                    <a href="#!">
                                        <h6 class="m-b-5">New order Done <span class="text-muted float-right f-14">Just Now</span></h6>
                                    </a>
                                </div>
                            </div>
                            <div class="row m-b-25 align-items-center">
                                <div class="col-auto p-r-0">
                                    <i data-feather="file-text" class="badge-light-success feed-icon"></i>
                                </div>
                                <div class="col">
                                    <a href="#!">
                                        <h6 class="m-b-5">You have 5 pending tasks. <span class="text-muted float-right f-14">5 hours ago</span></h6>
                                    </a>
                                </div>
                            </div>
                            <div class="row m-b-0 align-items-center">
                                <div class="col-auto p-r-0">
                                    <i data-feather="bell" class="badge-light-primary feed-icon"></i>
                                </div>
                                <div class="col">
                                    <a href="#!">
                                        <h6 class="m-b-5">You have 4 tasks Done. <span class="text-muted float-right f-14">2 hours ago</span></h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- customer-section end -->
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
