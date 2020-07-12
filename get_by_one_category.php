<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");  
include_once 'database.php';
include_once 'questions.php';
  
$database = new Database();
$db = $database->getConnection();
$questions = new Question($db);
$keywords=isset($_GET["q"]) ? $_GET["q"] : "";
$stmt = $questions->search($keywords);
$num = $stmt->rowCount();
if($num>0){
    $s=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $a=array(
            "id" => $id,
            "choix1" => $choix1,
            "choix2" => $choix2,
            "vote1" => $vote1,
            "vote2" => $vote2,
            "category" => $category,
        );
        array_push($s, $a);
    }
    http_response_code(200);
    echo json_encode($s);
}
else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>