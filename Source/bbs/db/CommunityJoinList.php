<?php
echo '<hr/>';
echo 'CommunityJoinList';
	$sql = "select * from  CommunityJoinList";
	$result = mysql_query($sql);

while($row = mysql_fetch_array($result))
  {
  echo $row[0] . " " . $row[1];
  echo "<br />";
  }
  echo '<hr/>';
 ?>