<?php

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();

$quote = new Quote($db);

// Quote Query
$result = $quote->read();

// Row count
$num = $result->rowCount();

// Check if any quotes

// NEED TO UPDATE TO ADD ADDITIONAL ITEMS TO ARRAY
if($num > 0) {
    // Quote array
    $quote_arr = array();


    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        
        $quote_item = array(
            'id' => $id,
            'quote' => $quote,
            'author' => $author_name,
            'category' => $category_name
        );

        // push data
        array_push($quote_arr, $quote_item);
    }

    // Turn to JSON
    print_r(json_encode($quote_arr));
} else {
    echo json_encode(
        array('message' => 'No Quotes Found'));
}

exit();