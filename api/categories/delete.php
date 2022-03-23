<?php

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();

$category = new Category($db);

// Get raw data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$category->id = $data->id;

// Delete category
if($category->delete()) {
    echo json_encode(
        array("id" => "{$data->id} deleted"));
} else {
    echo json_encode(
        array("message" => "{$data->id} not deleted"));
}

exit();