<?php

class category {
    //DB stuff
    private $conn;
    private $table = 'categories';

    //properties
    public $id;
    public $name;
    public $created_at;

    //constructor with DB
    public function __construct($db){
        $this->conn = $db;

    }

    //get categories
    public function read(){
        //create query
        $query = 'SELECT 
        id,
        name,
        created_at
        FROM
        ' . $this->table . '
        ORDER BY
        created_at DESC';

    //prepaer stmt
    $stmt = $this->conn->prepare($query);

    //execute query 
    $stmt->execute();
    
    return $stmt;   
    }
}