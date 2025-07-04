<?php 
abstract class Model{

    protected static string $table;
    protected static string $primary_key = "id";

    public static function find(mysqli $mysqli, int $id){
        $sql = sprintf("Select * from %s WHERE %s = ?", 
                        static::$table, 
                        static::$primary_key);
        
        $query = $mysqli->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();

        $data = $query->get_result()->fetch_assoc();

        return $data ? new static($data) : null;
    }

    public static function all(mysqli $mysqli){
        $sql = sprintf("Select * from %s", static::$table);
        
        $query = $mysqli->prepare($sql);
        $query->execute();

        $data = $query->get_result();

        $objects = [];
        while($row = $data->fetch_assoc()){
            $objects[] = new static($row); //creating an object of type "static" / "parent" and adding the object to the array
        }

        return $objects; //we are returning an array of objects!!!!!!!!
    }
      public static function create(mysqli $mysqli, array $data){
        $columns = array_keys($data); 
        $values= array_values($data); 
        $columnsString = implode(", ", $columns);          
        $placeholders = [];
        for ($i=0;$i<count($values);$i+=1){
            $placeholders[]='?';
        }
        $placeholdersString=implode(", ", $placeholders); 
        $table = static::$table;


        $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)",$table,$columnsString,$placeholdersString);
        $types = '';
        foreach ($values as $value) {
            if (is_int($value)) {
                $types .= 'i';
            } elseif (is_float($value)) {
                $types .= 'd';
            } else {
                $types .= 's'; 
            } 
        }
        $query = $mysqli->prepare($sql);
        $query->bind_param($types,...$values);
        $query->execute();
        return;
    }
    public function getId(): int {
    return $this->{static::$primary_key};
}

    public function update(mysqli $mysqli ,array $data){
        $columns = array_keys($data);
        $values =array_values($data);
        for ($i =0;$i<count($columns);$i++){
            $columns[$i].=' =?';
        }
        $columnsString = implode(", ", $columns);

        $table = static::$table;
        $primary_key = static::$primary_key;

        $values[] = $this->getId();
        $types='';

        foreach ($values as $value) {
            if (is_int($value)) {
                $types .= 'i';
            } elseif (is_float($value)) {
                $types .= 'd';
            } else {
                $types .= 's'; 
            } 
        }
        
        $sql = sprintf("UPDATE %s SET %s WHERE %s = ?",$table,$columnsString,$primary_key);

        $query = $mysqli->prepare($sql);
        $query->bind_param($types, ...$values);
        $query->execute();

        return;
    }

    public static function delete(mysqli $mysqli, int $id){
        $table = static::$table;
        $primary_key = static::$primary_key;

        $sql=sprintf("Delete from %s where %s = ?",$table,$primary_key );
        $query = $mysqli->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();
    }
    public static function deleteAll($mysqli){
        $table = static::$table;
        $sql=sprintf("Delete from %s",$table );
        $query = $mysqli->prepare($sql);
        $query->execute();
    }
    public static function findAllWhere($mysqli, $attr, $value){
        $table = static::$table;
        $sql=sprintf("SELECT * from %s WHERE %s = ?",$table, $attr );
        $query = $mysqli->prepare($sql);
        $query->bind_param("i", $value);
        $query->execute();
        $data=$query->get_result();
        $objects = [];
        while($row = $data->fetch_assoc()){
            $objects[] = new static($row); //creating an object of type "static" / "parent" and adding the object to the array
        }

        return $objects; 
    }
    /*public function findWhere($mysqli, $attr){
        $table = static::$table;
        $primary_key = static::$primary_key;
        $sql=sprintf("SELECT %s from %s WHERE %s = ?",$attr, $table,$primary_key );
        $query = $mysqli->prepare($sql);
        $id = $this->getId();
        $query->bind_param("i", $id);
        $query->execute();
        $result = $query->get_result();
    $row = $result->fetch_assoc();
    return $row[$attr]; 
    }*/

    //you have to continue with the same mindset
    //Find a solution for sending the $mysqli everytime... 
    //Implement the following: 
    //1- update() -> non-static function 
    //2- create() -> static function
    //3- delete() -> static function 
}



