<?php 
	include('../../path.php');
	include(ROOT_PATH . '/app/controllers/products.php');

	$title = "All";
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
            <div class="col-12 col-md-12 col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mt-5">All Your Products</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-responsive">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Token</th>
                              <th>Title</th>
                              <th>Category</th>
                              <th>Date</th>
                              <th colspan="4">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                                <?php foreach($products as $product):?>
                                    <tr>
                                        <td><?php echo $product['id'] + 1;?></td>
                                        <td><?php echo $product['token'];?></td>
                                        <td><?php echo $product['title'];?></td>
                                        <td><?php $cat = selectOne($table2, ['id' => $product['cat_id']]);?><a href="<?php echo BASE_URL . '/dashboard/categories/?id=' . $cat['id'];?>" class='text-primary' ><?php echo $cat['name'];?></a></td>
                                        <td><?php echo date('F j, Y h:i:s', strtotime($product['created_at'])); ?></td>
                                        <td><a href="<?php echo BASE_URL . '/dashboard/products/view.php?id=' . $product['id']; ?>">View</a></td>
                                        <td><a class="text-info" href="<?php echo BASE_URL . '/dashboard/products/update.php?p_u_id=' . $product['id']; ?>">Update</a></td>
                                        <?php if($product['publish']):?>
                                            <td><a class="text-warning" href="<?php echo BASE_URL . '/dashboard/products/?p_id=' . $product['id'] . '&a=unpublish'; ?>">Unpublish</a></td>
                                        <?php else:?>
                                            <td><a class="text-success" href="<?php echo BASE_URL . '/dashboard/products/?p_id=' . $product['id']; ?>">Publish</a></td>
                                        <?php endif;?>
                                        <td><a class="text-danger" href="<?php echo BASE_URL . '/dashboard/products/?p_del_id=' . $product['id']; ?>">Delete</a></td>
                                    </tr>
                                <?php endforeach;?>
                          </tbody>
                        </table>
                    </div>
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
