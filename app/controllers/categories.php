<?php 
include(ROOT_PATH . '/app/database/db.php');
include(ROOT_PATH . '/app/helpers/validate.php');

$table = 'category';

#errors
$errors = $error = array();
$errors['name'] = $errors['body'] = '';

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

if(isset($_POST['add-category'])){
    $genErrors = categoryVal($_POST);
    $errors = $genErrors[0]; $error = $genErrors[1];
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
    if(count($error) === 0){
        $_POST['user_id'] = $xUser['id'];
        $id = $_POST['id'];
        unset($_POST['update-category'], $_POST['id']);
        $cat_id = update($table, $id, $_POST);
        if($cat_id){
            $_SESSION['message'] = 'Category Updated Successfully';
            $_SESSION['type'] = 'success';
            header('location:' . BASE_URL . '/dashboard/categories/');
            exit();
        }
    }else{
        $body = $_POST['body'];
        $name = $_POST['name'];
    }
}

?>