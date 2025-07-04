<?php 
require("../connection/connection.php");

$query = "ALTER TABLE articles
            ADD category_id INT(11),
            ADD CONSTRAINT fk FOREIGN KEY (category_id) REFERENCES categories(id);
            ";

$execute = $mysqli->prepare($query);
$execute->execute();
