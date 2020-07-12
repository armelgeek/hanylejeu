<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");  
// array holding allowed Origin domains
$allowedOrigins = array(
  '(http(s)://)?(www\.)?hany.\ezyro\.com'
);
 
if (isset($_SERVER['HTTP_ORIGIN']) && $_SERVER['HTTP_ORIGIN'] != '') {
  foreach ($allowedOrigins as $allowedOrigin) {
    if (preg_match('#' . $allowedOrigin . '#', $_SERVER['HTTP_ORIGIN'])) {
      header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
      header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
      header('Access-Control-Max-Age: 1000');
      header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
      break;
    }
  }
}
include_once 'database.php';
include_once 'category.php';
  
$database = new Database();
$db = $database->getConnection();
$category = new Category($db);
$stmt = $category->read();
$num = $stmt->rowCount();
if($num>0){
    $categorys_arr=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $category_item=array(
            "nom" => $nom,
            "total" => $total,
        );
        array_push($categorys_arr, $category_item);
    }
    http_response_code(200);
    echo json_encode($categorys_arr);
}
else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No category found.")
    );
}