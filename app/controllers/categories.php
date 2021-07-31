<?php 
include(ROOT_PATH . '/app/database/db.php');
include(ROOT_PATH . '/app/helpers/validate.php');

$table = 'category';

#errors
$errors = $error = array();
$errors['name'] = $errors['body'] = '';

#values
$name = $body = '';

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

?>