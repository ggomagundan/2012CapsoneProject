<?php
	$db_hostname = 'localhost';
	$db_database = 'capstone';
	$db_username = 'root';
	$db_password = 'kjs738';
	
	$db_con = mysql_connect($db_hostname, $db_username, $db_password);
	
	if(!$db_con) die("Unable to connect to MySQL : " . mysql_error());
	
	mysql_select_db($db_database, $db_con) or die("Unable to select database : " . mysql_error());
	mysql_query("SET NAMES 'utf8'");
	
	function escape_str($str) { return mysql_real_escape_string($str); }
?>