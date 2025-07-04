<?php 
require("../connection/connection.php");
require("../models/Category.php");

$categories = [
    ['name'=> 'technology'],
    ['name'=>'Education'],
    ['name'=>'Health'],
    ['name'=>'Science'],
    ['name'=>'Entertainment']
];

for($i=0; $i< count($categories); $i++){
    Category:: create($mysqli, $categories[$i]);
}
