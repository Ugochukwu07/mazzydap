<?php 
include(ROOT_PATH . '/app/database/db.php');
include(ROOT_PATH . '/app/helpers/validate.php');

#tables
$table = 'products';
$table2 = 'category';

#errors
$titlem = $errors['title'] = $sub_title = $errors['sub_title'] = $client_name = $errors['client_name'] = $client_email = $errors['client_email'] = $client_phone = $errors['client_phone'] = $ex_link = $errors['ex_link'] = $about = $errors['about'] = $errors['publish'] = $publish = $cat_id = $errors['cat_id'] = '';
$errors['failed'] = $errors['type'] = '';


if(isset($_POST['add-product'])){
    $genErrors = upload(BASE_URL . '/assets/dashboard/images/products/', XIMAGE, 'thumb_image');
    if(count($genErrors[0]) === 0){
        $_POST['user_id'] = $xUser['id'];
        $_POST['publish'] = isset($_POST['publish']) ? 1 : 0;
        
    }else{
        $titlem = $_POST['title'];
        $sub_title = $_POST['sub_title'];
        $client_name = $_POST['client_name'];
        $client_email = $_POST['client_email'];
        $client_phone = $_POST['client_phone'];
        $ex_link = $_POST['ex_link'];
        $about = $_POST['about'];
        if(isset($_POST['publish'])){$publish = 'set';}
        $cat_id = $_POST['cat_id'];
    }
}

?>