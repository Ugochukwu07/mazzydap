<?php 
function dd($value) { // to be deleted
    echo "<pre>", print_r($value, true), "</pre>";
    die();
}


#CODE GENERATION VARIABLES
$p_code = '0123456789';
$e_code = 'abcdefghijklmnopqrstuvwzyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$referal_code = '0123456789abcdefghijklmnopqrstuvwzyz';
$token = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$user_key = $p_code . $e_code;

function generateRandomString($x, $lenght){
    return substr(str_shuffle(str_repeat($x, ceil($lenght/strlen($x)))), 1,$lenght);
}


function sessionDeclare($data = []){
    foreach($data as $key => $value){
        $_SESSION[$key] = $data[$key];
    }
}

function setMsg($message, $type, $location){
    $_SESSION['message'] = $message;
    $_SESSION['type'] = $type;
    header('location:' . BASE_URL . $location);
    exit();
}

?>