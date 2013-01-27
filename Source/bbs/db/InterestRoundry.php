<?php
echo '<hr/>';
echo 'InterestRoundry';
	$sql = "select * from  InterestRoundry";
	$result = mysql_query($sql);

while($row = mysql_fetch_array($result))
  {
  echo $row[0] . " " . $row[1];
  echo "<br />";
  }
  echo '<hr/>';
 ?>