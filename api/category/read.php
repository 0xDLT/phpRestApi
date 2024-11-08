<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/database.php';
include_once '../../models/category.php';

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate category object
$category = new Category($db);

//category read query
$result = $category->read();
//Get row count
$num = $result->rowCount();

//check if any categories
if($num > 0){
    //posts array
    $cate_arr = array();
    $cate_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        
        $cate_item = array(
            'id'           => $id,
            'name'         => $name,  
        );

        // Corrected typo here (changed $posts_item to $post_item)
        array_push($cate_arr['data'], $cate_item);
    }

    //convert to JSON
    echo json_encode($cate_arr);
} else {
    //no categories
    echo json_encode(
        array('message' => 'No categories found')
    );
}
