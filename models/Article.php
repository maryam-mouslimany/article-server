<?php
require_once("Model.php");

class Article extends Model{

    private int $id; 
    private string $name; 
    private string $author; 
    private string $description;
    private int $category_id; 
 
    
    protected static string $table = "articles";

    public function __construct(array $data){
        $this->id = $data["id"];
        $this->name = $data["name"];
        $this->author = $data["author"];
        $this->description = $data["description"];
         $this->category_id = $data["category_id"];

    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getAuthor(): string {
        return $this->author;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function setAuthor(string $author){
        $this->author = $author;
    }

    public function setDescription(string $description){
        $this->description = $description;
    }

    public function toArray(){
        return ['name' => $this->name,
        'author' => $this->author,
        'description' => $this->description,
        'category_id' => $this->category_id];
    }
    
}
