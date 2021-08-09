<?php 
include('../../path.php');
include(ROOT_PATH . '/app/controllers/contacts.php');
adminOnly();
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $mail = selectOne($table2, ['id' => $id]);
    $subject = $mail['subject'];
    $XMAIL['top'] = str_replace("' . LOGO . '", LOGO, XMAIL['top']);
    $body = html_entity_decode($mail['body']);
    $body = str_replace($XMAIL['top'], '', $body);
    $body = str_replace(XMAIL['bottom'], '', $body);
}

$title = 'Update';
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
                            <li class="breadcrumb-item"><a href="./">Mails</a></li>
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
                            <h5>Template</h5><small>Update Template</small>
                        </div>
                        <div class="card-body">
                            <form class="form-v2" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <div class="row">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
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
                                            <label class="floating-label" for="body">HTML Code</label>
                                            <textarea rows="4" cols="7" class="form-control" id="ckeditor" name="body" placeholder="&lt;div class=&quot;..." autocomplete="on"><?php echo $body; ?></textarea>
                                        </div>
                                        <small class="badge-light-danger text-danger"><?php echo $errors['body']; ?></small>
                                    </div>
                                    <div class="col-sm-6 mx-auto">
                                        <button name="updateTemp" type="submit" class="btn btn-block btn-success">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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