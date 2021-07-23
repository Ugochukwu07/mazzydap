<?php

//HOW many posts pre page
$results_per_page = 12;

//To check for set page
isset($_GET['page']) ? $page = $_GET['page'] : $page = 0;

//check for page 1
if ($page > 1) {
    $start = ($page * $results_per_page) - $results_per_page;
}else{
    $start = 0;
}



?>