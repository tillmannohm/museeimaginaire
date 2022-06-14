<?php
// Create connection
$conn = new mysqli('rdbms.strato.de','U3417300','imaginaire789','DB3417300');
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

if ($_GET['action'] == 'delete'){

  $query = "DELETE FROM ".$_GET['tbl']." WHERE id = ".$_GET['id']."";
  if ($conn->query($query) === FALSE) {
    echo "Error: " . $query . "#####" . $conn->error;
  }

$conn->close();

$my_file = 'blacklist.txt';
$handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
$data = "\n".$_GET['img'];
fwrite($handle, $data);
}

include_once('db.php');
$images='';
$result = mysqli_query($connection, "SHOW TABLES");

while($table = mysqli_fetch_array($result)) { // go through each row that was returned in $result

  $query  = "select * from $table[0] order by id asc limit 10";
  $res    = mysqli_query($connection,$query);
  $count  =   mysqli_num_rows($res);

      while($row=mysqli_fetch_array($res))
      {
          $image = $row['image'];
          $id = $row['id'];
          $images .= '
                     <a href="?action=delete&id='.$id.'&tbl='.$table[0].'&img='.$image.'"><img src="'.$image.'" width="100px"/></a>
                     ';
      }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>control imaginaire</title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  </head>

<body>
<?php echo $images; ?>
</body>
</html>
