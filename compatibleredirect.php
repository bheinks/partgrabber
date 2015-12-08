<?php
	session_start();
	require "database.inc.php";
	
	// Get passed GET variables
	$build_name = $_GET["build_name"];
	$username = $_SESSION['username'];
	
	$compatibility = "";
	
	// Check for socket compatibility
	$sql = "SELECT 	socket
			FROM 	motherboard
			WHERE	comp_id = (
				SELECT 	comp_id
				FROM	sold_by 
				WHERE	sold_id = (
					SELECT 	motherboard_id
					FROM 	saved_build
					WHERE 	build_name = '".$build_name."'
					AND 	username = '".$username."'
				)
			)
	;";
	$result = $conn->query($sql);
	$row = $result->fetch_array();
	$motherboard = $row["socket"];
	
	$sql = "SELECT 	socket
			FROM 	cpu
			WHERE	comp_id = (
				SELECT 	comp_id
				FROM	sold_by 
				WHERE	sold_id = (
					SELECT 	cpu_id
					FROM 	saved_build
					WHERE 	build_name = '".$build_name."'
					AND 	username = '".$username."'
				)
			)
	;";
	$result = $conn->query($sql);
	$row = $result->fetch_array();
	$cpu = $row["socket"];
	
	// Set message if incompatible
	if(($motherboard != $cpu) && ($motherboard != "") && ($cpu != ""))
		$compatibility = $compatibility."Socket Mismatch!&nbsp;";
		
		
	// Check for form factor compatibility
	$sql = "SELECT 	form_factor
			FROM 	motherboard
			WHERE	comp_id = (
				SELECT 	comp_id
				FROM	sold_by 
				WHERE	sold_id = (
					SELECT 	motherboard_id
					FROM 	saved_build
					WHERE 	build_name = '".$build_name."'
					AND 	username = '".$username."'
				)
			)
	;";
	$result = $conn->query($sql);
	$row = $result->fetch_array();
	$motherboard = $row["form_factor"];
	
	$sql = "SELECT 	form_factor
			FROM 	comp_case
			WHERE	comp_id = (
				SELECT 	comp_id
				FROM	sold_by 
				WHERE	sold_id = (
					SELECT 	case_id
					FROM 	saved_build
					WHERE 	build_name = '".$build_name."'
					AND 	username = '".$username."'
				)
			)
	;";
	$result = $conn->query($sql);
	$row = $result->fetch_array();
	$case = $row["form_factor"];
	
	// Set message if incompatible
	if(($motherboard != $case) && ($motherboard != "") && ($case != ""))
		$compatibility = $compatibility."Form Factor Mismatch!&nbsp;";

	// Set SESSION variables
	$_SESSION["compatibility"] = $compatibility;
	$_SESSION["compatibility_build"] = $build_name;
	
	// Redirect back to index.php
	header('Location: index.php');
	exit();
	
?>