<?php

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();

$quote = new Quote($db);

// Get raw data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$quote->id = $data->id;

// Delete quote MIGHT NEED TO UPDATE TO SHOW WHAT WAS DELETED. CHECK ON THAT

if(isset($quote->id)) {
    if($quote->delete()) {
        echo json_encode(
            array("id" => "{$data->id} deleted"));
    } else {
        echo json_encode(
            array("message" => "{$data->id} not deleted"));
    }
} else {
    echo json_encode(
        array("message" => "No Quotes Found"));
    }
exit();