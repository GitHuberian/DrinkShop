<?php
require_once 'db_functions.php';
$db = new db_functions();

$response = array();
if(ISSET($_POST['menuId'])){
    $menuId = $_POST['menuId'];

        $drinks = $db->getDrinkByCategoryID($menuId);
        echo json_encode($drinks);
}
else{
    $response["error_msg"]="Required parameter (menuId) is missing!";
    echo json_encode($response);
}