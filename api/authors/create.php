<?php

include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();

$author = new Author($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$author->author = $data->author;

// Need lastInsertId() in here in order to get the id to get the correct output

// create post
if($author->create()) {
    echo json_encode(
        array('id' => $db->lastInsertId(), 'author' => $author));
} else {
    echo json_encode(
        array("message" => "Author Not Created"));
}

exit();