<?php 
/* define('', '');*/
ob_start();
session_start();
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){  
    $url = "https://";   
}else{ 
    $url = "http://"; 
}  
// Append the host(domain name, ip) to the URL.   
$url.= $_SERVER['HTTP_HOST'];
$LOCAL = strpos($url, 'localhost:8080') ? 1 : 0;

define('ROOT_PATH', realpath(dirname(__FILE__)));
if($LOCAL){
    define('BASE_URL', 'http://localhost:8080/mazzydap');
    define('HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'mazzy_dap');
    define("DEMO", true);
}else{
    error_reporting(0);
    define('BASE_URL', 'https://mazzydap.com');
    define('HOST', 'localhost');
    define('DB_USER', 'mazzydap_admin');
    define('DB_PASS', 'omo]2R1+4mK6SC');
    define('DB_NAME', 'mazzydap_main');
    define("DEMO", false);
}

include(ROOT_PATH . '/app/helpers/functions.php');

define('LOGO', BASE_URL . '/assets/open/images/logo/main.png');
define('FAVI', BASE_URL . '/assets/open/images/logo/fav.png');
define('TEXT', BASE_URL . '/assets/open/images/logo/text.png');
include('reuseables.php');
?>
