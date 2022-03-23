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

// Need lastInsertId() in here in order to get the id created in order to get the correct echo return
// create category

if($category->create()) {
    echo json_encode(
        array("message" => "category: {$data->category}"));
} else {
    echo json_encode(
        array("message" => "Category Not Created"));
}

exit();