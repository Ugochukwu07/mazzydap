<?php 
include(ROOT_PATH . '/app/database/db.php');
include(ROOT_PATH . '/app/helpers/file_manger.php');
include(ROOT_PATH . '/app/helpers/validate.php');

#tables
$table = 'products';
$table2 = 'category';
$table3 = 'files';

#errors
$titlem = $errors['title'] = $sub_title = $errors['sub_title'] = $client_name = $errors['client_name'] = $client_email = $errors['client_email'] = $client_phone = $errors['client_phone'] = $ex_link = $errors['ex_link'] = $about = $errors['about'] = $errors['publish'] = $publish = $cat_id = $errors['cat_id'] = '';
$errors['failed'] = $errors['type'] = '';

#vars
$products = selectAll($table);

if(isset($_GET['id'])){
    $product = selectOne($table, ['id' => $_GET['id']]);
}

if(isset($_GET['token'])){
    $product = selectOne($table, ['token' => $_GET['token']]);
    $category = selectOne($table2, ['id' => $product['cat_id']]);
}

if(isset($_GET['p_u_id'])){
    $product =selectOne($table, ['id' => $_GET['p_u_id']]);
    $id = $_GET['p_u_id'];
    $titlem = $product['title'];
    $sub_title = $product['sub_title'];
    $client_name = $product['client_name'];
    $client_email = $product['client_email'];
    $client_phone = $product['client_phone'];
    $ex_link = $product['ex_link'];
    $about = $product['about'];
    $publish = isset($product['publish']) ? 1 : 0;
    $cat_id = $product['cat_id'];
}

if(isset($_GET['p_id'])){
    if(isset($_GET['a'])){
        update($table, $_GET['p_id'], ['publish' => 0]);
        setMsg('Product Unpublished Successfuly', 'primary', '/dashboard/products/');
    }else{
        update($table, $_GET['p_id'], ['publish' => 1]);
        setMsg('Product Published Successfuly', 'primary', '/dashboard/products/');
    }
}

/* if(isset($_GET['p_del_id'])){
    header('location:' BASE_URL . '/dashboard/promt.php?t=' . $table . '&id=' . $_GET['p_del_id'] . '&a=del');
    exit();
} */

if(isset($_POST['add-product'])){
    $genErrors = upload('/assets/dashboard/images/products/', XIMAGE, 'thumb_image');
    if(count($genErrors[0]) === 0){
        $_POST['user_id'] = $xUser['id'];
        $_POST['publish'] = isset($_POST['publish']) ? 1 : 0;
        $_POST['token'] = generateRandomString($e_code, 7);
        unset($_POST['add-product']);
        $product_id = create($table, $_POST);
        if($product_id){
            $_SESSION['message'] = 'Category Created Successfully';
            $_SESSION['type'] = 'success';
            header('location:' . BASE_URL . '/dashboard/products/');
            exit();
        }
    }else{
        $titlem = $_POST['title'];
        $sub_title = $_POST['sub_title'];
        $client_name = $_POST['client_name'];
        $client_email = $_POST['client_email'];
        $client_phone = $_POST['client_phone'];
        $ex_link = $_POST['ex_link'];
        $about = $_POST['about'];
        $publish = isset($_POST['publish']) ? 1 : 0;
        $cat_id = $_POST['cat_id'];
    }
}

if(isset($_POST['update-product'])){
    if (!empty($_FILES['thumb_image']['name'])) {
        $genErrors = upload('/assets/dashboard/images/products/', XIMAGE, 'thumb_image');
    }else{
        $genErrors[0] = array();
    }
    if(count($genErrors[0]) === 0){
        $id = $_POST['id'];
        $_POST['user_id'] = $xUser['id'];
        $_POST['publish'] = isset($_POST['publish']) ? 1 : 0;
        unset($_POST['update-product'], $_POST['id']);//dd($_POST);
        $product_id = update($table, $id, $_POST);
            $_SESSION['message'] = 'Category Updated Successfully';
            $_SESSION['type'] = 'success';
            header('location:' . BASE_URL . '/dashboard/products/');
            exit();
    }else{
        $titlem = $_POST['title'];
        $sub_title = $_POST['sub_title'];
        $client_name = $_POST['client_name'];
        $client_email = $_POST['client_email'];
        $client_phone = $_POST['client_phone'];
        $ex_link = $_POST['ex_link'];
        $about = $_POST['about'];
        $publish = isset($_POST['publish']) ? 1 : 0;
        $cat_id = $_POST['cat_id'];
    }
}

?>