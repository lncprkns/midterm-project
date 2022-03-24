<?php

include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();

$author = new Author($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$author->id = $data->id;

$author->author = $data->author;

// Update authors
if($author->update()) {
    echo json_encode(
        array("id" => $author->id, "author" => $author->author));
} else {
    echo json_encode(
        array("message" => "Author Not Updated"));
}

exit();