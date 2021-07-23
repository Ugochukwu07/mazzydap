<?php
include('path.php');
session_start();

foreach ($_SESSION as $key) {
    unset($_SESSION[$key]);
}

session_destroy();
if (isset($_GET['reason'])) {
    $what = $_GET['reason'];
    if ($what = 1) {
        session_start();
        $_SESSION['message'] = 'Profile updated';
        $_SESSION['type'] = 'success';
    header('location:' . BASE_URL . '/signin');
    }
}else{
    header('location:' . BASE_URL . '/');
}

?>