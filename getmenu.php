<?php
require_once 'db_functions.php';
$db = new db_functions();


    $menu = $db->getMenuCategories();
    echo json_encode($menu);
