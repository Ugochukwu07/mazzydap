<?php 
	include('../../path.php');
	include(ROOT_PATH . '/app/controllers/products.php');

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
            <div class="col-12 col-md-10 col-lg-9 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mt-5">Add Your Products</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="was-validated" enctype="multipart/form-data">
                            
                            <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $id; ?>">
                            
                            <div class="custom-file form-group mb-2">
                                <input type="file" class="custom-file-input" id="thumb_image" name="thumb_image">
                                <label class="custom-file-label" for="thumb_image">Choose file...</label>
                            </div>
                            <small class="text-success ">Leave Blank if you don't want to update.</small>
                            <small class="badge badge-light-danger "><?php echo $errors['failed']; ?></small>
                            <small class="badge badge-light-danger "><?php echo $errors['type']; ?></small>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" value="<?php echo $titlem;?>" name="title" id="title" placeholder="Title Here..." required>
                            </div>
                            <div class="form-group">
                                <label for="sub_title">Sub Title</label>
                                <input type="text" class="form-control" value="<?php echo $sub_title;?>" name="sub_title" id="sub_title" placeholder="Sub Title Here" required>
                            </div>
                            <div class="form-group">
                                <label for="client_name">Client Name</label>
                                <input type="text" class="form-control" value="<?php echo $client_name;?>" name="client_name" id="client_name" placeholder="Client Name" required>
                            </div>
                            <div class="form-group">
                                <label for="client_email">Client Email</label>
                                <input type="email" class="form-control" value="<?php echo $client_email;?>" name="client_email" id="client_email" placeholder="Client Email" required>
                            </div>
                            <div class="form-group">
                                <label for="client_phone">Client Phone</label>
                                <input type="tel" class="form-control" value="<?php echo $client_phone;?>" name="client_phone" id="client_phone" placeholder="Client Phone" required>
                            </div>
                            <div class="form-group">
                                <label for="cat_id">Product Category</label>
                                <select class="custom-select" name="cat_id" required>
                                    <?php $cats = selectAll('category');?>
                                    <option value=""></option>
                                    <?php foreach($cats as $cat):?>
                                        <?php if(!empty($cat_id) && $cat_id === $cat['id']):?>
                                            <option selected value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                                        <?php endif;?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ex_link">External Link(Optional)</label>
                                <input type="text" class="form-control" value="<?php echo $ex_link;?>" name="ex_link" id="ex_link" placeholder="https://bit.ly/RQse2ht...">
                            </div>
                            <div class="form-group">
                                <label for="about">About Product</label>
                                <textarea class="form-control" name="about" id="about" rows="3" required><?php echo $about;?></textarea>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <?php if(empty($publish)):?>
                                        <input class="form-check-input" type="checkbox" id="publish">
                                    <?php else:?>
                                        <input class="form-check-input" checked type="checkbox" id="publish">
                                    <?php endif; ?>
                                    <label class="form-check-label" for="publish">Mark as Activie</label>
                                </div>
                            </div>
                            <button type="submit" name="update-product" class="btn  btn-primary">update Product</button>
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
