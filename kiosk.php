<?php
include_once('db.php');

$slides='';
$result = mysqli_query($connection, "SHOW TABLES");

while($table = mysqli_fetch_array($result)) { // go through each row that was returned in $result

  $query  = "select * from $table[0] order by id asc limit 10";
  $res    = mysqli_query($connection,$query);
  $count  =   mysqli_num_rows($res);
  $counter=0;
  $interval = mt_rand(3500,5500);

      while($row=mysqli_fetch_array($res))
      {
          $link = $row['link'];
          $image = $row['image'];
          if($counter == 0)
          {
              $slides .= '
              <div class="grid-item">

              <div id="'.$table[0].'" class="carousel slide" data-ride="carousel" data-interval="'.$interval.'" data-pause="false">
              <div class="overlay" id="loading '.$table[0].'" style="display: block;">
              </div>
                   <div class="carousel-inner">
                     <div class="item '.$table[0].' active">
                     <a target="_blank" href="'.$link.'"><img src="'.$image.'" /></a>
                     </div>';
          }
          else
          {
              $slides .= '
              <div class="item '.$table[0].'">
              <a target="_blank" href="'.$link.'"><img src="'.$image.'" /></a>
              </div>';
          }
          $counter++;
      }
      $slides .= '</div></div></div>
      <script>$("#'.$table[0].'").on("slide.bs.carousel", function () {
      document.getElementById("loading '.$table[0].'").style.display="none";
      });</script>';

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Refresh" content=3600" />
    <title>Le #museeimaginaire</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  </head>
<body>
<link rel="stylesheet" href="css/bootstrap.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<style>
body{
  background-color: black;
}
.grid-container {
  position: relative;
  background-color: white;
  width: 1080px;
  height: 1080px;
  padding: 18px;
  margin: auto;
}
.grid-item {
  background-color: white;
  margin: 8px;
	height: 158px;
	width: 158px;
	float: left;
}
.carousel-inner {
	height: 158px;
	width: 158px;
}

</style>
<div class="grid-container">
<?php echo $slides; ?>
</div>
</body>
</html>
