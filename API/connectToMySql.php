<?php
function OpenConn()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "assignment";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function CloseConn($conn)
{
    $conn->close();
}