<?php
	session_start();
	require "database.inc.php";
	
	$build_name = $_GET["build_name"];
	$username = $_SESSION['username'];
	
	$sql = "DELETE 	FROM saved_build
			WHERE 	username = '".$username."'
			  AND	build_name = '".$build_name."'
			;";
			echo $sql;
	$conn->query($sql);
	
	// Redirect back to index.php
	header('Location: index.php');
	exit();
?>