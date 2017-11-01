<?php 
	session_start();

	$_SESSION['name'] = 'damon';
	$_SESSION['age'] = 32;

	$sname = session_name();
	$sid = session_id();

	echo "<a href = 'dump.php?".$sname."=".$sid."'>info</a>"

 ?>