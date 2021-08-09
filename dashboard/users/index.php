<?php 
	include('../../path.php');
	include(ROOT_PATH . '/app/controllers/users.php');
    adminOnly();

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
                            <li class="breadcrumb-item"><a href="index.html">Users</a></li>
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
            <div class="col-12 col-md-12 col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mt-5">All Users</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-responsive">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Username</th>
                              <th>Email</th>
                              <th>Phone</th>
                              <th>Status</th>
                              <th>Date</th>
                              <th colspan="1">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                                <?php foreach($users as $user):?>
                                    <tr>
                                        <td><?php echo $user['id'] + 1;?></td>
                                        <td><?php echo $user['username'];?></td>
                                        <td><?php echo $user['email'];?></td>
                                        <td><?php echo $user['phone'];?></td>
                                        <td><?php if($user['status']){echo 'Admin';}else{echo 'User';}?></td>
                                        <td><?php echo date('F j, Y h:i:s', strtotime($user['created_at'])); ?></td>
                                        <td><a href="<?php echo BASE_URL . '/dashboard/users/view.php?id=' . $user['id']; ?>"><i class="icon feather icon-maximize f-16  text-primary"></i></a>
                                        <!-- <td><a class="text-info" href="<?php echo BASE_URL . '/dashboard/users/?u_u_id=' . $user['id']; ?>">Update</a></td> -->
                                        <a class="text-danger" href="<?php echo BASE_URL . '/dashboard/users/?u_del_id=' . $user['id']; ?>"><i class="icon feather icon-trash-2 f-16  text-danger"></i></a></td>
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
