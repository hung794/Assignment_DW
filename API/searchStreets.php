<?php
include 'connectToMySql.php';
$data = json_decode(file_get_contents('php://input'), true);
$cnn = OpenConn();
$name = $data["nameSearch"];
$district = $data["districtSearch"];
if ($district == "All Districts") {
    $sql = "SELECT * FROM streets WHERE name LIKE '%" . $name . "%'";
} else {
    $sql = "SELECT * FROM streets WHERE name LIKE '%" . $name . "%' AND district LIKE '%" . $district . "%'";
}
$result = $cnn->query($sql);
$row = array();
while ($r = $result->fetch_assoc()) {
    $row[] = $r;
}
echo json_encode($row);
CloseConn($cnn);