<?php 
include('path.php');
include(ROOT_PATH . '/app/controllers/users.php');

if(isset($_GET['key']) && isset($_GET['auth'])){
    $code = selectOne('codes', ['email' => $_GET['key'], 'phone' => $_GET['auth']]);
    if($code){
        $user_id = update('users', $code['user_id'], ['emailVerified' => 1]);
        $v_user = selectOne('users', ['id' => $code['user_id'], 'emailVerified' => 1]);
        loginUser($v_user);
        $_SESSION['message'] = 'User account verified successfully';
        $_SESSION['type'] = 'success';
        header('location:' . BASE_URL . '/dashboard/user/');
        exit();
    }else{
        $_SESSION['message'] = 'Wrong verification code';
        $_SESSION['type'] = 'danger';
        header('location:' . BASE_URL . '/signin');
        exit();
    }
}

$title = 'ZiloTrade';

?>
<!DOCTYPE html>
<html lang="en">
<?php include(ROOT_PATH . '/app/includes/link_dash_top.php');?>
<body>
    <div class="container">
        <div class="row" style="height: 100vh;">
            <div class="col-md-7 col-12 my-auto mx-auto text-center">
                <?php include(ROOT_PATH . '/app/includes/message.php'); ?>
            </div>
        </div>
    </div>
<?php include(ROOT_PATH . '/app/includes/link_dash_bottom.php'); ?>
</body>
</html>