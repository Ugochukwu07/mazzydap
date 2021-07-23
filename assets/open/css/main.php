<?php 
$linker = BASE_URL . '/assets/open/css/';
$fileName = array('bootstrap.min.css', 'plugin.min.css', 'style.css', 'responsive.css');

foreach($fileName as $key => $value){
    echo '@import url("' . $linker . $value . '");
    ';
}

?>
