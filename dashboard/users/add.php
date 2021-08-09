<?php 
	include('../../path.php');
	include(ROOT_PATH . '/app/controllers/users.php');
    adminOnly();
    
	$title = "Add";
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
            <div class="col-12 col-md-10 col-lg-9 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mt-5">Add Your Product Categories</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="was-validated" enctype="multipart/form-data">
                            <!-- <div class="custom-file form-group mb-2">
                                <input type="file" class="custom-file-input" id="image" required name="image">
                                <label class="custom-file-label" for="image">Choose file...</label>
                            </div>
                            <small class="badge badge-light-danger "><?php echo $errors['failed']; ?></small>
                            <small class="badge badge-light-danger "><?php echo $errors['type']; ?></small>
                            <small class="badge badge-light-danger "><?php echo $errors['empty']; ?></small> -->
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" class="form-control" name="firstname" value="<?php echo $firstname;?>" id="firstname" placeholder="Userame Here..." required>
                                <small class="badge badge-light-danger "><?php echo $errors['ef']; ?></small>
                                <small class="badge badge-light-danger "><?php echo $errors['efi']; ?></small>
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="lastname" class="form-control" name="lastname" value="<?php echo $lastname;?>" id="lastname" placeholder="Email Here..." required>
                                <small class="badge badge-light-danger "><?php echo $errors['el']; ?></small>
                                <small class="badge badge-light-danger "><?php echo $errors['eli']; ?></small>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" value="<?php echo $username;?>" id="username" placeholder="Userame Here..." required>
                                <small class="badge badge-light-danger "><?php echo $errors['unr']; ?></small>
                                <small class="badge badge-light-danger "><?php echo $errors['unr1']; ?></small>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $email;?>" id="email" placeholder="Email Here..." required>
                                <small class="badge badge-light-danger "><?php echo $errors['eme']; ?></small>
                                <small class="badge badge-light-danger "><?php echo $errors['emei']; ?></small>
                                <small class="badge badge-light-danger "><?php echo $errors['exe']; ?></small>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" class="form-control" name="phone" value="<?php echo $phone;?>" id="phone" placeholder="Phone Number Here..." required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" value="<?php echo $password;?>" id="password" placeholder="Password Here..." required>
                                <small class="badge badge-light-danger "><?php echo $errors['pr']; ?></small>
                                <small class="badge badge-light-danger "><?php echo $errors['pri']; ?></small>
                                <small class="badge badge-light-danger "><?php echo $errors['psl']; ?></small>
                            </div>
                            <div class="form-group">
                                <label for="cpassword">Confirm Password</label>
                                <input type="password" class="form-control" name="cpassword" value="<?php echo $cpassword;?>" id="cpassword" placeholder="Password Here..." required>
                                <small class="badge badge-light-danger "><?php echo $errors['cpse']; ?></small>
                                <small class="badge badge-light-danger "><?php echo $errors['cps']; ?></small>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <?php if(empty($status)):?>
                                        <input class="form-check-input" name="status" type="checkbox" id="status">
                                    <?php else:?>
                                        <input class="form-check-input" name="status" checked type="checkbox" id="status">
                                    <?php endif; ?>
                                    <label class="form-check-label" for="status">Admin</label>
                                </div>
                            </div>
                            <button type="submit" name="add-user" class="btn  btn-primary">Add User</button>
                        </form>
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
