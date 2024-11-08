<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: Post');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/database.php';
include_once '../../models/post.php';

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate blog post object
$post = new Post($db);

// Get raw posted data 
$data = json_decode(file_get_contents("php://input"));

$post->title        = $data->title;
$post->author       = $data->author;
$post->body         = $data->body;
$post->category_id  = $data->category_id;

//create post
if($post->create()){
    echo json_encode(
        array('message' => 'Post Created')
    );
} else {
    echo json_encode(
        array('message' => 'Post NOT Created')
    );
}