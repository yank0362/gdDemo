<?php 
	header("content-type:text/html;charset=utf-8");
	var_dump(extension_loaded('gd'));

	var_dump(function_exists('gd_info'));

	var_dump(gd_info());

	echo "<pre>";

	print_r(get_defined_functions());

	echo "</pre>";
 ?>