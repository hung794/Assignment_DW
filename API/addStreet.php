<?php
include 'connectToMySql.php';
$data = json_decode(file_get_contents('php://input'), true);
$name = $data["name"];
$district = $data["district"];
$founding = $data["founding"];
$description = $data["description"];
$status = $data["status"];
$cnn = OpenConn();

$sql = "INSERT INTO streets (name, district, founding, description, status) VALUES ('$name','$district','$founding', '$description', '$status')";
header('Content-Type: application/json; charset =utf-8');
if ($cnn->query($sql) === TRUE) {
    $data = new stdClass();
    $data->message = "Add success. Press 'Street List' to view information of all recorded streets!";
    http_response_code(201);
    echo json_encode($data);
} else {
    $data = new stdClass();
    $data->message = "Add failed. Please try again!";
    http_response_code(500);
    echo json_encode($data);
}
CloseConn($cnn);