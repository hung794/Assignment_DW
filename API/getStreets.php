<?php
include 'connectToMySql.php';
$conn = OpenConn();
$sql = 'SELECT * FROM streets';
$result = $conn->query($sql) or die($conn->error);
if ($result->num_rows > 0) {
    $row = array();
    while ($r = $result->fetch_assoc()) {
        $row[] = $r;
    }
}
else {
    $row[] = "No Result Found!";
}
print json_encode($row);
CloseConn($conn);