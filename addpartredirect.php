<?php
	session_start();
	require "database.inc.php";
	
	// Get passed GET variables
	$comp_type = $_GET["comp_type"];
	$build_name = $_GET["build_name"];
	$comp_id = $_GET["comp_id"];
	
	// Execute UPDATE query
	$sql = "UPDATE	saved_build
			SET		".$comp_type."_id = '".$comp_id."'
			WHERE 	build_name = '".$build_name."'";
	$conn->query($sql);
	
	// Redirect back to index.php
	header('Location: index.php');
	exit();
	
?>