<?php
	session_start();
	require "database.inc.php";
	
	$build_name = $_GET["build_name"];
	$build_description = $_GET["build_description"];
	$username = $_SESSION['username'];
	
	$sql = "INSERT INTO saved_build
			VALUES('".$username."',
				   '".$build_name."',
				   '".$build_description."',
				   0, 0, 0, 0, 0, 0, 0, 0);";
	$conn->query($sql);
	
	// Redirect back to index.php
	header('Location: index.php');
	exit();
?>