
<?php
class Question{

    private $conn;
    public $category_id;
    public $choix1;
    public $choix2;
    public $vote1;
    public $vote2;
    public function __construct($db){
        $this->conn = $db;
    }
    function search($keyword){
    $query = "SELECT question.id,question.choix1,question.choix2,question.vote1,question.vote2,category.nom as category FROM question,category  WHERE question.category_id=category.id AND 
                question.category_id = ? ORDER BY RAND() LIMIT 30";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $keyword);
    $stmt->execute();
    return $stmt;
   }
   function getAll(){
    $query = "SELECT question.id,question.choix1,question.choix2,question.vote1,question.vote2,category.nom as category FROM question,category  WHERE question.category_id=category.id ORDER BY RAND() LIMIT 30";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $keyword);
    $stmt->execute();
    return $stmt;
   }
   function vote1($id){
    $query = "UPDATE
                question            
              SET
                vote1 = :vote1,
            WHERE
                id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $id);
    $this->vote1=htmlspecialchars(strip_tags($this->vote1));
    $stmt->bindParam(':vote1', $this->vote1);
    if($stmt->execute()){
        return true;
    }
    return false;
   }
 }
 function vote2($id){
    $query = "UPDATE
                question            
              SET
                vote2 = :vote2,
            WHERE
                id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $id);
    $this->vote2=htmlspecialchars(strip_tags($this->vote2));
    $stmt->bindParam(':vote2', $this->vote2);
    if($stmt->execute()){
        return true;
    }
    return false;
   }
 }
?>