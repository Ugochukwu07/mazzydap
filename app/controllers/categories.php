<?php 
include(ROOT_PATH . '/app/database/db.php');
include(ROOT_PATH . '/app/helpers/file_manger.php');
include(ROOT_PATH . '/app/helpers/validate.php');
include(ROOT_PATH . '/app/helpers/paging.php');
include(ROOT_PATH . '/app/helpers/math.php');

$table = 'category';

#errors
$errors = $error = array();
$errors['name'] = $errors['body'] = $errors['failed'] = $errors['type'] = '';

#values
$name = $body = '';

$categories = selectAll($table);

if(isset($_GET['cat_id'])){
    $category = selectOne($table, ['id' => $_GET['cat_id']]);
    $name = $category['name'];
    $body = $category['body'];
    $id = $category['id'];
    $date = $category['created_at'];
}

if(isset($_GET['cat_del_id'])){
    $_SESSION['link'] = '/dashboard/categories/'
    header('location: ' . BASE_URL . '/dashboard/promt.php?t=' . $table . '&id=' . $_GET['c_del_id'] . '&a=del');
    exit();
}


if(isset($_POST['add-category'])){
    $genErrors = categoryVal($_POST);
    $errors = $genErrors[0]; $error = $genErrors[1];
    $genErrors = upload('/assets/dashboard/images/categories/', XIMAGE, 'image');
    $errors = array_merge($genErrors[1], $errors);
    $error = array_merge($genErrors[0], $error);
    if(count($error) === 0){
        $_POST['user_id'] = $xUser['id'];
        unset($_POST['add-category']);
        $cat_id = create($table, $_POST);
        if($cat_id){
            $_SESSION['message'] = 'Category Created Successfully';
            $_SESSION['type'] = 'success';
            header('location:' . BASE_URL . '/dashboard/categories/');
            exit();
        }
    }else{
        $body = $_POST['body'];
        $name = $_POST['name'];
    }
}


if(isset($_POST['update-category'])){
    $genErrors = categoryVal($_POST);
    $errors = $genErrors[0]; $error = $genErrors[1];
    if(!empty($_FILES['image']['name'])){
        $genErrors = upload('/assets/dashboard/images/categories/', XIMAGE, 'image');
        $errors = array_merge($genErrors[1], $errors);
        $error = array_merge($genErrors[0], $error);
    }else{
        $errors['failed'] = $errors['type'] = $errors['empty'] = '';
    }
    if(count($error) === 0){
        $_POST['user_id'] = $xUser['id'];
        $id = $_POST['id'];
        unset($_POST['update-category'], $_POST['id']);//dd($_POST);
        $cat_id = update($table, $id, $_POST);
            $_SESSION['message'] = 'Category Updated Successfully';
            $_SESSION['type'] = 'success';
            header('location:' . BASE_URL . '/dashboard/categories/');
            exit();
    }else{
        $body = $_POST['body'];
        $name = $_POST['name'];
    }
}

?>