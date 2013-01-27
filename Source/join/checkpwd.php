<?php
	if(isset($_POST['num1'])){
		$num1 = $_POST['num1'];
	}else if(isset($_GET['num1'])){
		$num1 = $_GET['num1'];
	}else{
		echo "Cannot access";
	}
	if(isset($_POST['num2'])){
		$num2 = $_POST['num2'];
	}else if(isset($_GET['num1'])){
		$num2 = $_GET['num2'];
	}else{
		echo "Cannot access";
	}
	if($num1 != $num2){
		echo('<li class="checkli">Check your password</li>');
	}
?>	