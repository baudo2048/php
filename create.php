<?php
header('Content-Type: application/json; charset=utf-8');

// $entityBody = json_decode(file_get_contents('php://input'));
// $sqlString = $entityBody->meta->data;

$servername = "Localhost";
$username = "root";
$password = "";
$dbname = "testcode";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$query = $_GET['query'];

$conn->query($query);

$conn->close();

$json = array();
echo json_encode($json);

?>