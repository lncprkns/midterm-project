<?php

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();

$category = new Category($db);

// Get raw category data
$data = json_decode(file_get_contents("php://input"));

$category->category = $data->category;


if(isset($category->category)) {
    if($category->create()) {
        echo json_encode(
            array('id' => $db->lastInsertId(), 'category' => $category->category));
    } else {
        echo json_encode(
            array("message" => "Category Not Created"));
    }
} else {
    echo json_encode(
        array("message" => "Missing Required Parameters"));
    }
    
exit();