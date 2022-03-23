<?php

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();

$category = new Category($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$category->id = $data->id;

$category->category = $data->category;

// Update categories
if($category->update()) {
    echo json_encode(
        array("message" => "Category Updated"));
} else {
    echo json_encode(
        array("message" => "Category Not Updated"));
}

exit();