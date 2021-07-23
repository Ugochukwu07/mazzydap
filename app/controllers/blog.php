<?php 
include(ROOT_PATH . '/app/database/db.php');
include(ROOT_PATH . '/app/helpers/paging.php');
include(ROOT_PATH . '/app/helpers/middleware.php');
include(ROOT_PATH . '/app/helpers/validate.php');

#tables
$table = 'posts';
$table2 = 'category';

#errors var
$errors['title'] = $errors['about'] = $errors['image'] = $errors['cat_id'] = '';
$errors['extitle'] = $errors['body'] = '';
$errors['image'] = $errors['fimage'] = '';

#post value
$titlee = $about = $body = '';

$posts = selectAll($table);
$categories = selectAll($table2);

if(isset($_GET['id'])){
    $post = selectOne($table, ['id' => $_GET['id']]);
}

if (isset($_GET['cat_id'])) {
    $id = $_GET['cat_id'];
    $category = selectOne($table2, ['id' => $id]);

    $id = $category['id'];
    $titlee = $category['title'];
    $about = $category['about'];
}

if(isset($_GET['del_c_id'])){
    delete($table, $_GET['del_c_id']);
    $_SESSION['message'] = 'Category deleted successfully';
    $_SESSION['type'] = 'danger';
    header('location:' . BASE_URL . '/dashboard/admin/blog/category/');
    exit();
}

if(isset($_GET['p_id'])){
    $id = $_GET['p_id'];
    $post = selectOne($table, ['id' => $id]);
    $titlee = $post['title'];
    $body = $post['body'];
    $cat_id = $post['cat_id'];
}

if(isset($_GET['del_p_id'])){
    adminOnly();
    delete($table, $_GET['del_p_id']);
    $_SESSION['message'] = 'Post deleted successfully';
    $_SESSION['type'] = 'danger';
    header('location:' . BASE_URL . '/dashboard/admin/blog/post/');
    exit();
}

if(isset($_POST['addCategory'])){
    adminOnly();
    $genErrors = categoryVal($_POST);
    $errors = $genErrors[0];
    $subMainError = $genErrors[1];
    if(count($subMainError) === 0){
        unset($_POST['addCategory']);
        $category = create($table2, $_POST);
        $_SESSION['message'] = 'Category created successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/dashboard/admin/blog/category/');
        exit();
    }else{
        $title = $_POST['title'];
        $about = $_POST['about'];
    }
    
}


if (isset($_POST['updateCategory'])) {
    adminOnly();
    $genErrors = categoryVal($_POST);
    $errors = $genErrors[0];
    $subMainError = $genErrors[1];
    if (count($subMainError) === 0) {
        $id = $_POST['id'];
        unset($_POST['updateCategory'], $_POST['id']);
        $category_id = update($table2, $id, $_POST);
        $_SESSION['message'] = 'Category updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/dashboard/admin/blog/category/');
        exit();  
    } else {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $about = $_POST['about'];
    }
    
}

if (isset($_POST['addPost'])) {
    adminOnly();
    $genErrors = postVal($_POST);
    $errors = $genErrors[0];
    $subMainError = $genErrors[1];
    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/assets/dashboard/images/posts/" . $image_name;

        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        if ($result) {
            $_POST['image'] = $image_name;
            $errors['fimage'] = '';
        } else {
            array_push($subMainError, 'Failed To Upload Image');
            $errors['fimage'] = 'Failed To Upload Image';
        }
        $errors['image'] = '';   
    } else {
        array_push($subMainError, 'Post Image Required');
        $errors['image'] = 'Post Image Required';
    }

    if (count($subMainError) === 0) {
            unset($_POST['addPost']);
            $_POST['user_id'] = $_SESSION['id'];
            $_POST['body'] = htmlentities($_POST['body']);
            $post_id = create($table, $_POST);
            $_SESSION['message'] = 'Post created Successfully';
            $_SESSION['type'] = 'success';
            header('location: ' . BASE_URL . "/dashboard/admin/blog/post/");
            exit();
    }else{
        $titlee = $_POST['title'];
        $body = $_POST['body'];
        $category_id = $_POST['cat_id'];
    }  
}

if (isset($_POST['updatePost'])) {
    adminOnly();
    $genErrors = postVal($_POST);
    $errors = $genErrors[0];
    $subMainError = $genErrors[1];
    if (empty($_FILES['image']['name'])) {
        $errors['image'] = '';
        $errors['fimage'] = '';
    }else{
        if (!empty($_FILES['image']['name'])) {
            $image = selectOne($table, ['id' => $_POST['id']]);
            $filename = BASE_URL . '/assets/dashboard/images/posts/' . $image['image'];
            unlink($filename);
            $image_name = time() . '_' . $_FILES['image']['name'];
            $destination = ROOT_PATH . "/assets/dashboard/images/posts/" . $image_name;

            $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
            $errors['image'] = '';
            if ($result) {
                $_POST['image'] = $image_name;
                $errors['fimage'] = '';
            } else {
                array_push($subMainError, 'Failed To Upload Image');
                $errors['fimage'] = 'Failed To Upload Image';
            }
        } else {
            array_push($subMainError, 'Post Image Required');
            $errors['image'] = 'Post Image Required';
        }
    }

  if (count($subMainError) === 0) {
        $id = $_POST['id'];
        unset($_POST['updatePost'], $_POST['id']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['body'] = htmlentities($_POST['body']);
        $post_id = update($table, $id, $_POST);
        $_SESSION['message'] = 'Post Updated Successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . "/dashboard/admin/blog/post/");
        exit();
    }else{
        $id = $_POST['id'];
        $titlee = $_POST['title'];
        $body = $_POST['body'];
        $category_id = $_POST['cat_id'];
    }
     
}

?>