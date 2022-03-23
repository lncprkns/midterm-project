<?php

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();

$quote = new Quote($db);

// Get raw data
$data = json_decode(file_get_contents("php://input"));

$quote->quote = $data->quote;
$quote->authorId = $data->authorId;
$quote->categoryId = $data->categoryId;


// create quote
if($quote->create()) {
    echo json_encode(
        array(
            'id' => $db->lastInsertId(),
            'quote' => $quote->quote,
            'authorId' => $quote->authorId,
            'categoryId' => $quote->categoryId)
        );
} else {
    echo json_encode(
        array("message" => "Quote Not Created"));
}

exit();