<?php

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();

$category = new Category($db);

// Get ID

$category->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get category
$category->read_single();

// Create Array
$category_arr = array(
    'id' => $category->id,
    'category' => $category->category
);

// Make JSON
print_r(json_encode($category_arr));

exit();