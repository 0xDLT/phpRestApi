<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../../models/post.php';

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate blog post object
$post = new Post($db);

//Get ID from url
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

//Get post
$post->read_single();

//Create array
$post_arr = array(
    'id'            => $post->id,
    'title'         => $post->title,
    'body'          => $post->body,
    'author'        => $post->author,
    'category_id'   => $post->category_id,
    'category_name' => $post->category_name
);

//Make json file
print_r(json_encode($post_arr));