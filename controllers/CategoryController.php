<?php 
global $mysqli;

require(__DIR__ . '/../models/Category.php');
require (__DIR__ . '/../connection/connection.php');
require(__DIR__ . '/../services/ArticleService.php');
require(__DIR__ . "/../services/ResponseService.php");

class CategoryController{
    public function getCategory(){
        global $mysqli;
        $responseService = new ResponseService(); 

        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $category =  Category::find($mysqli, $id)->toArray();
            echo $responseService->success_response($category, 200);
            return;
        }
        else
        echo('category not found');
    }
    
    public function getAllCategories(){
        global $mysqli;

        $responseService = new ResponseService(); 
            $categories = Category::all($mysqli);
            $categories_array = ArticleService::articlesToArray($categories);
            echo $responseService->success_response($categories_array, 200);
            return;
    }

    public function updateCategory(){
        global $mysqli;
        if(isset($_GET['id'])){
            $category = Category::find($mysqli, $_GET['id']);
            $categoryArray = $category->toArray();
            $attributes=array_keys($categoryArray);
            $toUpdate=[];

            for($i=0; $i<count($attributes); $i++){
                if (isset($_GET[$attributes[$i]]))
                    $toUpdate[$attributes[$i]] =$_GET[$attributes[$i]];
            }

            $category -> update($mysqli, $toUpdate);
            echo('updated successfully');
        }

        else{
            echo('Category Not Found');
        }

    }
    public function deleteCategory(){
        global $mysqli;
        if(isset($_GET['id'])){
            Category:: delete($mysqli, $_GET['id']);
        }
        else
        echo('Category Not Found');
    }
    public function deleteAllCategories(){ 
        global $mysqli;
        Category:: deleteAll($mysqli);
    }

   
}
