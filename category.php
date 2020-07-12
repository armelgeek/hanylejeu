<?php
class Category{

    private $conn;
    private $table_name = "category";
    public $id;
    public $nom;
    public $created_at;
    public $updated_at;
    public function __construct($db){
        $this->conn = $db;
    }
    function read(){
    $query = "SELECT category.nom,question.category_id,count(question.id) as total FROM question,category WHERE question.category_id=category.id  GROUP BY question.category_id";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
}
}
?>