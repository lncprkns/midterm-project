<?php

include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();

$author = new Author($db);

// Get raw data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$author->id = $data->id;

// Delete author
if($author->delete()) {
    echo json_encode(
        array("id" => "{$data->id} deleted"));
} else {
    echo json_encode(
        array("message" => "{$data->id} not deleted"));
}

exit();