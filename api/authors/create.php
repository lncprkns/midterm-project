<?php

include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();

$author = new Author($db);

// Get raw author data
$data = json_decode(file_get_contents("php://input"));

$author->author = $data->author;


if(isset($author->author)) {
    if($author->create()) {
        echo json_encode(
            array('id' => $db->lastInsertId(), 'author' => $author->author));
    } else {
        echo json_encode(
            array("message" => "Author Not Created"));
    }
} else {
    echo json_encode(
        array("message" => "Missing Required Parameters"));
    }
    
exit();