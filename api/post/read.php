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

//blog post query
$result = $post->read();
//Get row count
$num = $result->rowCount();

//check if any posts
if($num > 0){
    //posts array
    $posts_arr = array();
    $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        
        $post_item = array(
            'id'            => $id,
            'title'         => $title,
            'body'          => html_entity_decode($body),
            'author'        => $author,
            'category_id'   => $category_id,
            'category_name' => $category_name   
        );

        // Corrected typo here (changed $posts_item to $post_item)
        array_push($posts_arr['data'], $post_item);
    }

    //convert to JSON
    echo json_encode($posts_arr);
} else {
    //no posts
    echo json_encode(
        array('message' => 'No posts found')
    );
}
