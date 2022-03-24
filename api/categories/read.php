<?php

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();

$category = new Category($db);

// Category Query
$result = $category->read();

// Row count
$num = $result->rowCount();

// Check if any categories
if($num > 0) {
    // Category array
    $category_arr = array();
    //$category_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        
        $category_item = array(
            'id' => $id,
            'category' => $category
        );

        // push data
        array_push($category_arr, $category_item);
    }

    // Turn to JSON
    print_r(json_encode($category_arr));
} else {
    echo json_encode(
        array('message' => 'categoryId Not Found'));
}

exit();