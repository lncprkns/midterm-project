<?php

include_once '../../config/Database.php';
include_once '../../models/Author.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();

$author = new Author($db);

// Author Query
$result = $author->read();

// Row count
$num = $result->rowCount();

// Check if any authors
if($num > 0 && isset($id)) {
    // Author array
    $author_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        
        $author_item = array(
            'id' => $id,
            'author' => $author
        );

        // push data
        array_push($author_arr, $author_item);
    }

    // Turn to JSON
    print_r(json_encode($author_arr));
} else {
    echo json_encode(
        array('message' => 'authorId Not Found'));
}

exit();