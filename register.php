<?php
require_once 'db_functions.php';
$db = new db_functions();

$response = array();
if(ISSET($_POST['phone'])&&ISSET($_POST['name'])&&ISSET($_POST['birthdate'])&&ISSET($_POST['address'])){
    $phone = $_POST['phone'];
    $name = $_POST['name'];
    $birthdate = $_POST['birthdate'];
    $address = $_POST['address'];

    if($db->checkExistsUser($phone)){
        $response["error_msg"]="User already exists with".$phone."";
        echo json_encode($response);
    }
    else{
        $user = $db->registerNewUser($phone, 
        $name,$birthdate,$address);
        if($user){
            $response["phone"] = $user["Phone"];
            $response["name"] = $user["Name"];
            $response["birthdate"] = $user["Birthdate"];
            $response["address"] = $user["Address"];
            echo json_encode($response);
        }
        else{
            $response["error_msg"]="Unknown error ocurred in registration";
            echo json_encode($response);
        }
    }
}
else{
    $response["error_msg"]="Required parameters (phone, name, birthdate, address) are missing!";
    echo json_encode($response);
}