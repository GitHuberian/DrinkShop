<?php
require_once 'db_functions.php';
$db = new db_functions();

$response = array();
if(ISSET($_POST['phone'])){
    $phone = $_POST['phone'];

        $user = $db->getUserInformation($phone);
        if($user){
            $response["phone"] = $user["Phone"];
            $response["name"] = $user["Name"];
            $response["birthdate"] = $user["Birthdate"];
            $response["address"] = $user["Address"];
            $response["avatarUrl"] = $user["avatarUrl"];
            echo json_encode($response);
        }
        else{
            $response["error_msg"]="User does not exists";
            echo json_encode($response);
        }
}
else{
    $response["error_msg"]="Required parameter (phone) is missing!";
    echo json_encode($response);
}