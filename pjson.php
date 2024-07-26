<?php

header('Content-Type: application/json; charset=utf-8');

$entityBody = json_decode(file_get_contents('php://input'));
$serviceName = $entityBody->meta->serviceName;
$msg = $entityBody->meta->data;

//$serviceName = $_GET['serviceName'];
$serviceLang = "php";


$servername = "sql207.epizy.com";
$username = "epiz_33098256";
$password = "F2IGmEB2DNees";
$dbname = "epiz_33098256_hellodb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT code FROM Service WHERE lang= '$serviceLang' AND name= '$serviceName' ");

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        eval($row["code"]);
    }
}

//echo json_encode($json);

$conn->close();

    
?>