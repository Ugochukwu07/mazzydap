<?php 

function setMsg($message, $type, $location){
    $_SESSION['message'] = $message;
    $_SESSION['type'] = $type;
    header('location:' . BASE_URL . $location);
    exit();
}

?>