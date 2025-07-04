<?php 
require("../connection/connection.php");
require("../models/Article.php");

$articles = [
    [
        "name" => "The Future of AI",
        "author" => "Jane Smith",
        "description" => "An overview of how artificial intelligence is shaping our world.",
        "category_id" => 1
    ],
    [
        "name" => "Healthy Living Tips",
        "author" => "John Doe",
        "description" => "Simple and effective tips to maintain a healthy lifestyle.",
        "category_id" => 2
    ],
    [
        "name" => "Exploring the Universe",
        "author" => "Alice Johnson",
        "description" => "A journey through the latest discoveries in astronomy.",
        "category_id" => 3
    ],
    [
        "name" => "Cooking Made Easy",
        "author" => "Robert Brown",
        "description" => "Quick and delicious recipes for busy weeknights.",
        "category_id" => 4
    ],
    [
        "name" => "The Art of Meditation",
        "author" => "Emily White",
        "description" => "How meditation can improve your mental well-being.",
        "category_id" => 5
    ],
    [
        "name" => "Travel on a Budget",
        "author" => "Michael Green",
        "description" => "Tips and tricks for affordable world travel.",
        "category_id" => 1
    ],
    [
        "name" => "Mastering Photography",
        "author" => "Laura Black",
        "description" => "Techniques to improve your photography skills.",
        "category_id" => 2
    ],
    [
        "name" => "The History of Jazz",
        "author" => "David Blue",
        "description" => "A deep dive into the origins and evolution of jazz music.",
        "category_id" => 2
    ],
    [
        "name" => "Personal Finance Basics",
        "author" => "Sophia Orange",
        "description" => "How to manage your money wisely and plan for the future.",
        "category_id" => 3
    ],
    [
        "name" => "Gardening for Beginners",
        "author" => "Mark Yellow",
        "description" => "Simple gardening tips for those just starting out.",
        "category_id" => 3
    ]
];


for($i=0; $i< count($articles); $i++){
    Article:: create($mysqli, $articles[$i]);
}
