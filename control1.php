<?php
include_once('db.php');
$images='';
$result = mysqli_query($connection, "SHOW TABLES");

while($table = mysqli_fetch_array($result)) { // go through each row that was returned in $result

  $query  = "select * from $table[0] order by id desc limit 10";
  $res    = mysqli_query($connection,$query);
  $count  =   mysqli_num_rows($res);

      while($row=mysqli_fetch_array($res))
      {
          $image = $row['image'];
          $images .= '
                     <img src="'.$image.'" width="100px" onclick="WriteToFile(this)">
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
<script type="text/javascript">
  function WriteToFile(img) {
    var link = img.getAttribute('src');
    <?php
    $img
    $my_file = 'blacklist.txt';
$handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
$data = $img;
fwrite($handle, $data);
?>
}
</script>
</body>
</html>
