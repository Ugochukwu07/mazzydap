<?php 
include('../../path.php');
include(ROOT_PATH . '/app/controllers/contacts.php');
adminOnly();

$title = 'Add Templates';
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
            <?php include(ROOT_PATH . '/app/includes/message.php'); ?>
                <div class="col-xl-10 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h5>Template</h5><small>Add Template</small>
                        </div>
                        <div class="card-body">
                            <form class="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <div class="row">
                                    <small class="col-sm-12">Subject</small>
                                    <hr>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="subject">Subject</label>
                                            <input type="text" class="form-control" value="<?php echo $subject; ?>" name="subject" placeholder="Withdrawal Request Denailed" autocomplete="on">
                                            <small class="badge-light-danger text-danger"><?php echo $errors['subject']; ?></small>
                                            <small class="badge-light-danger text-danger"><?php echo $errors['subject_match']; ?></small>
                                        </div>
                                    </div>
                                    <small class="col-sm-12">HTML Code</small>
                                    <hr>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea rows="4" id="ckeditor" cols="7" class="form-control" name="body" placeholder="&lt;div class=&quot;..." autocomplete="on"><?php echo $body; ?></textarea>
                                        </div>
                                        <small class="badge-light-danger text-danger"><?php echo $errors['body']; ?></small>
                                    </div>
                                    <div class="col-sm-6 mx-auto">
                                        <button name="addTemp" type="submit" class="btn btn-block btn-success">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Keys</h5><small>Keys for adding Template</small>
                        </div>
                        <div class="card-body">
                            <dl class="dl-horizontal row">
                                <?php $user = selectOne('users', ['id' => $_SESSION['id']]); ?>
                                <?php foreach($user as $key => $value):?>
                                    <dt class="col-sm-3">{<?php echo $key;?>}</dt>
                                    <dd class="col-sm-3"><?php
                                        if($key === 'OTK'){$key = 'One Time Key';}
                                        if($key === 'ref'){$key = 'Reffered ID';}
                                        if($key === 'status'){$key = 'Admin or User';}
                                        if($key === 'balance'){$key = 'User Balance';}
                                        if($key === 'password'){$key = 'Password In SHA-MD5';}
                                        if($key === 'addressI'){$key = 'Address One';}
                                        if($key === 'addressII'){$key = 'Address Two';}
                                        if($key === 'created_at'){$key = 'Date and Time Joined';}
                                    echo $key;?></dd>
                                <?php endforeach; ?>
                            </dl>
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
