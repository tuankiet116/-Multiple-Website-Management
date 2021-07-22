<?php 
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once('../../objects/userToken.php');
require_once('../../objects/user.php');
require_once('../../config/database.php');

$database = new ConfigAPI();
$db = $database->getConnection();

$user = new User($db);
$data = json_decode(file_get_contents("php://input"));
$user->user_token = $data->user_token;

$stmt = $user->logout();

if($stmt === true){
    http_response_code(200);
}
else{
    http_response_code(200);
}
?>