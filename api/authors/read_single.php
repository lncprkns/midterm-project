<?php

include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();

$author = new Author($db);

// Get ID

$author->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get author
$author->read_single();

// Create Array
$author_arr = array(
    'id' => $author->id,
    'author' => $author->author
);

// Make JSON

if(isset($author->id)) {
print_r(json_encode($author_arr));
} else {
    echo json_encode(
        array("message" => "authorId Not Found"));
    }

exit();