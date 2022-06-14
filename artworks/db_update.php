<?php

// Create connection
$conn = new mysqli('rdbms.strato.de','U3417300','imaginaire789','DB3417300');
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

  $query = "DELETE FROM '".$_GET['tbl']."' WHERE id = '".$_GET['id']."'";
  if ($conn->query($query) === TRUE) {
    echo "Update successfully";
  }
  else {
    echo "Error: " . $query . "#####" . $conn->error;
  }



$conn->close();
?>
