<?php
<<<<<<< HEAD
$servername = "sql207.epizy.com";
$username = "epiz_33098256";
$password = "F2IGmEB2DNees";
$dbname = "epiz_33098256_hellodb";
=======
$servername = "Localhost";
$username = "root";
$password = "";
$dbname = "testcode";
>>>>>>> 8524d49 (new json)

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT id, firstname, lastname FROM MyGuests";
$result = $conn->query($sql);


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