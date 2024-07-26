<?php
header('Content-Type: application/json; charset=utf-8');



$entityBody = json_decode(file_get_contents('php://input'));
$sqlString = $entityBody->meta->data;

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

$result = $conn->query($sqlString);


$json = array();
if ($result->num_rows > 0) {
  // output data of each row
  $i=0;
  while($row = $result->fetch_assoc()) {
    $record = array();
    foreach($row as $_column) {
        array_push($record,$_column);
    }
    array_push($json,$record);
    $i++;
  }
}

echo json_encode($json);

$conn->close();

?>