<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
include_once 'database.php';
include_once 'questions.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
$question = new Question($db);
$keywords=isset($_GET["q"]) ? $_GET["q"] : "";
$id = json_decode(file_get_contents("php://input"));
  
// set product property values
$question->vote1 = $data->vote1;
if($question->vote1($id)){
    http_response_code(200);
    echo json_encode(array("message" => "question was updated."));
}
else{
    http_response_code(503);
    echo json_encode(array("message" => "Unable to update product."));
}
?>