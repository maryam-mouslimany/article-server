<?php
global $mysqli;

require(__DIR__ . '/../models/Article.php');
require(__DIR__ . 'BaseController.php');
require(__DIR__ . '/../models/Category.php');
require(__DIR__ . '/../connection/connection.php');
require(__DIR__ . '/../services/ArticleService.php');
require(__DIR__ . "/../services/ResponseService.php");

class ArticleController extends BaseController
{
    public function getArticle()
    {
        global $mysqli;
        $responseService = new ResponseService();

        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $article = Article::find($mysqli, $id)->toArray();
            echo $responseService->success_response($article, 200);
            return;
        } else
            echo ('Article not found');
    }

    public function getAllArticles()
    {
        global $mysqli;

        $responseService = new ResponseService();
        $articles = Article::all($mysqli);
        $articles_array = ArticleService::articlesToArray($articles);
        echo $responseService->success_response($articles_array, 200);
        return;
    }

    /*public function getArticlesByCategory(){
        global $mysqli;
        $responseService = new ResponseService(); 

        if(isset($_GET['category_id'])){
            $articles=Article:: findAllWhere($mysqli, 'category_id', $_GET['category_id']);
             $articles_array = ArticleService::articlesToArray($articles);
            echo $responseService->success_response($articles_array, 200);
            return;
        }
        else
        echo('undifined category');
    }*/
    public function getArticlesByCategory()
    {
        global $mysqli;
        $responseService = new ResponseService();

        if (isset($_GET['category'])) {
            $category_id = Category::findByName($mysqli, $_GET['category']);
            $articles = Article::findAllWhere($mysqli, 'category_id', $category_id);
            $articles_array = ArticleService::articlesToArray($articles);
            echo $responseService->success_response($articles_array, 200);
            return;
        } else
            echo ('undifined category');
    }
    public function updateArticle()
    {
        global $mysqli;
        if (isset($_GET['id'])) {
            $article = Article::find($mysqli, $_GET['id']);
            $articleArray = $article->toArray();
            $attributes = array_keys($articleArray);
            -$toUpdate = [];

            for ($i = 0; $i < count($attributes); $i++) {
                if (isset($_GET[$attributes[$i]]))
                    $toUpdate[$attributes[$i]] = $_GET[$attributes[$i]];
            }

            $article->update($mysqli, $toUpdate);
            echo ('updated successfully');
        } else {
            echo ('Article Not Found');
        }
    }
    public function deleteArticle()
    {
        global $mysqli;
        if (isset($_GET['id'])) {
            Article::delete($mysqli, $_GET['id']);
        } else
            echo ('Article Not Found');
    }
    public function deleteAllArticles()
    {
        global $mysqli;
        Article::deleteAll($mysqli);
    }


    public function getCategoryOfArticle()
    {
        global $mysqli;
        if (isset($_GET['id'])) {
            $article = Article::find($mysqli, $_GET['id']);
            if ($article) {
                $category_id = $article->getCategoryId();
                $category = Category::find($mysqli, $category_id);
                echo ($category->getName());
            } else {
                echo ('undefined article');
            }
        } else
            echo ('id required');
    }
    public function createArticle()
    {
        global $mysqli;
        if (isset($_GET['name']) && isset($_GET['description']) && isset($_GET['author']) && isset($_GET['category_id'])) {
            $data = [
                'name' => $_GET['name'],
                'description' => $_GET['description'],
                'author' => $_GET['author'],
                'category_id' => $_GET['category_id'],
            ];
            //die($data['name']);
            Article::create($mysqli, $data);
        } else
            echo ('missing fields');
    }
    //To-Do:
}


//1- Try/Catch in controllers ONLY!!! 
//2- Find a way to remove the hard coded response code (from ResponseService.php)
//3- Include the routes file (api.php) in the (index.php) -- In other words, seperate the routing from the index (which is the engine)
//4- Create a BaseController and clean some imports 