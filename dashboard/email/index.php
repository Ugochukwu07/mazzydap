<?php 
include('../../path.php');
include(ROOT_PATH . '/app/controllers/contacts.php');
adminOnly();

$title = 'Mails Templates';
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
                            <li class="breadcrumb-item"><a href="/">Mails</a></li>
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
                                <h5>User Mail Template</h5>
                                <span class="d-block m-t-5">All users <code>mail templates</code> are here</span>
                            </div>
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Subject</th>
                                                <th colspan="5">Actions</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($mails as $key => $mail): ?>
                                                <tr>
                                                    <td><?php echo $key + 1; ?></td>
                                                    <td><?php echo $mail['subject']; ?></td>
                                                    <td class="badge-light-success"><a href="<?php echo BASE_URL . '/dashboard/email/view.php?id=' . $mail['id']; ?>" class="text-success">View</a></td>
                                                    <td class="badge-light-primary"><a href="<?php echo BASE_URL . '/dashboard/email/update.php?id=' . $mail['id']; ?>" class="text-primary">Update</a></td>
                                                    <td class="badge-light-info"><a href="<?php echo BASE_URL . '/dashboard/email/private.php?id=' . $mail['id']; ?>" class="text-info">Send Private</a></td>
                                                    <td class="badge-light-warning"><a href="<?php echo BASE_URL . '/dashboard/email/?all_id=' . $mail['id']; ?>" class="text-warning">Send All</a></td>
                                                    <td class="badge-light-danger"><a href="<?php echo BASE_URL . '/dashboard/email/del.php?id=' . $mail['id']; ?>" class="text-danger">Delete</a></td>
                                                    <td><?php echo date('F j, Y h:s:i a', strtotime($mail['created_at'])); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
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
