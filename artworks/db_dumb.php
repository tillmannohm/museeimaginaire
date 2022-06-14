<?php

// Create connection
$conn = new mysqli('rdbms.strato.de','U3417300','imaginaire789','DB3417300');
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

$max = 10;

foreach (glob("*.csv") as $filename) {
    $fname = str_replace(".csv", "", $filename);
    // Select 1 from table_name will return false if the table does not exist.
    $exist = "select 1 from $fname LIMIT 1";
    $val = mysqli_query($conn,$exist);

    $CREATEquery = "CREATE TABLE $fname (
      id int,
      image varchar(255),
      link varchar(255)
      );";
    if ($conn->query("DROP TABLE $fname") === TRUE) {
      echo "deleted";

    if ($conn->query($CREATEquery) === TRUE) {

        $query = "INSERT INTO $fname VALUES ";
        for ($x = 1; $x <= $max; $x++) {
         $query .= " ('".$x."', 'xx', 'xx'),";
        }

        $query = substr($query, 0, -1);
        if ($conn->query($query) === TRUE) {
          echo "20 empty record created successfully";
        }
        else {
          echo "Error: " . $query . "#####" . $conn->error;
        }

        }

    else {
       echo "Error: " . $CREATEquery . "#####" . $conn->error;
    }
}


    //UPDATE
    $fp = fopen($filename, "r");

    while( !feof($fp) ) {
        $zeile = fgetcsv  ( $fp  , 4096 , ","  );
         if ($zeile[0] > 0) {
         $query = "UPDATE $fname SET link= '$zeile[2]', image= '$zeile[1]' WHERE id= '$zeile[0]'; ";
         }

         if ($conn->query($query) === TRUE) {
            echo "Update successfully";
         }
         else {
            echo "Error: " . $query . "#####" . $conn->error;
         }
     }



    fclose($fp);
}

$conn->close();
?>
