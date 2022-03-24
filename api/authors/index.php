<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
}

// Should probably use a isset GET id in here instead, but this mashed together from w3schools seems to work
// update to the above if time

$id = filter_input(INPUT_GET,"id");


if ($method == "GET" && isset($id) && !empty($id)) {
  require_once("./read_single.php");
} else if ($method === "GET") {
  require_once("./read.php");
} else if ($method === "POST") {
  require_once("./create.php");
} else if ($method === "PUT") {
  require_once("./update.php");
} else if ($method === "DELETE") {
  require_once("./delete.php");
}