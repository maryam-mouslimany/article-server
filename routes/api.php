<?php

class Api{

    public $apis = [
        '/get_article'     => ['controller' => 'ArticleController', 'method' => 'getArticle'],
        '/get_articles'     => ['controller' => 'ArticleController', 'method' => 'getAllArticles'],
        '/update_article'   => ['controller' => 'ArticleController', 'method' => 'updateArticle'],
        '/create_article'   => ['controller' => 'ArticleController', 'method' => 'createArticle'],
        '/delete_article'   => ['controller' => 'ArticleController', 'method' => 'deleteArticle'],
        '/delete_articles'  => ['controller' => 'ArticleController', 'method' => 'deleteAllArticles'],
        '/get_articles_by_category'=> ['controller' => 'ArticleController', 'method' => 'getArticlesByCategory'],
        '/get_category_of_article'=> ['controller' => 'ArticleController', 'method' => 'getCategoryOfArticle'],

        '/get_category'     => ['controller' => 'CategoryController', 'method' => 'getCategory'],
        '/get_categories'   => ['controller' => 'CategoryController', 'method' => 'getAllCategories'],
        '/update_category'  => ['controller' => 'CategoryController', 'method' => 'updateCategory'],
        '/create_category'  => ['controller' => 'CategoryController', 'method' => 'createCategory'],
        '/delete_category'  => ['controller' => 'CategoryController', 'method' => 'deleteCategory'],
        '/delete_categories'=> ['controller' => 'CategoryController', 'method' => 'deleteAllCategories'],

        //'/login'          => ['controller' => 'AuthController', 'method' => 'login'],
        //'/register'       => ['controller' => 'AuthController', 'method' => 'register'],
    ];

    public function route($request){
        if (isset($this->apis[$request])) {
        $controller_name = $this->apis[$request]['controller']; //if $request == /articles, then the $controller_name will be "ArticleController" 
        $method = $this->apis[$request]['method'];
        require_once "controllers/{$controller_name}.php";

        $controller = new $controller_name();
        if (method_exists($controller, $method)) {
            $controller->$method();
        } else 
            echo "Error: Method {$method} not found in {$controller_name}.";
    } else 
        echo "404 Not Found";
    }
}
?>