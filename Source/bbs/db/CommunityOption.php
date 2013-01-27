<?php
echo '<hr/>';
echo 'CommunityOption';
	$sql = "select * from  CommunityOption";
	$result = mysql_query($sql);

while($row = mysql_fetch_array($result))
  {
  echo $row[0] . " " . $row[1];
  echo "<br />";
  }
  echo '<hr/>';
 ?>