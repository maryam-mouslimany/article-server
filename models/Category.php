<?php
require_once("Model.php");

class Category extends Model{

    private int $id; 
    private string $name; 
    
    protected static string $table = "categories";

    public function __construct(array $data){
        $this->id = $data["id"];
        $this->name = $data["name"];
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function toArray(){
        return ['id'=> $this->id, 
                'name' => $this->name];
    }
     public static function findByName($mysqli, $name){
         $sql = "SELECT id FROM categories WHERE name = ?";
        $query = $mysqli->prepare($sql);
        $query->bind_param('s', $name);
        $query->execute();
        $result = $query->get_result();
        $row = $result->fetch_assoc();
        return $row['id'] ; 
    }
    
}
