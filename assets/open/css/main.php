<?php 
$linker = BASE_URL . '/assets/open/css/';
$fileName = array('bootstrap.min.css', 'plugin.min.css', 'style.css', 'responsive.css');

foreach($fileName as $key => $value){
    echo '@import url("' . $linker . $value . '");
    ';
}
?>

    .logo-pre {
        background: #000000;
    }

    .active-dark .nav-bg-b.main-header .mega-white-logo {
        width: 130px;
    }