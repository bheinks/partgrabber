<?php
	session_start();
	require "database.inc.php";
	
	// Get passed GET variables
	$comp_type = $_GET["comp_type"];
	$build_name = $_GET["build_name"];
	$comp_id = $_GET["comp_id"];
	$username = $_SESSION['username'];
	
	// Execute UPDATE query
	$sql = "UPDATE	saved_build
			SET		".$comp_type."_id = '".$comp_id."'
			WHERE 	build_name = '".$build_name."'";
	echo $sql;
	$conn->query($sql);
	
	// Calculate new total cost
	$sql = "SELECT 	SUM(s.price) as sum_price
			FROM 	sold_by s
			WHERE	s.sold_id IN (
				SELECT 	cpu_id
				FROM 	saved_build b
				WHERE	b.build_name = '".$build_name."'
				  AND 	b.username = '".$username."'
				) OR s.sold_id IN (
				SELECT 	gpu_id
				FROM 	saved_build b
				WHERE	b.build_name = '".$build_name."'
				  AND 	b.username = '".$username."'
				) OR s.sold_id IN (
				SELECT 	case_id
				FROM 	saved_build b
				WHERE	b.build_name = '".$build_name."'
				  AND 	b.username = '".$username."'
				) OR s.sold_id IN (
				SELECT 	psu_id
				FROM 	saved_build b
				WHERE	b.build_name = '".$build_name."'
				  AND 	b.username = '".$username."'
				) OR s.sold_id IN (
				SELECT 	ram_id
				FROM 	saved_build b
				WHERE	b.build_name = '".$build_name."'
				  AND 	b.username = '".$username."'
				) OR s.sold_id IN (
				SELECT 	motherboard_id
				FROM 	saved_build b
				WHERE	b.build_name = '".$build_name."'
				  AND 	b.username = '".$username."'
				) OR s.sold_id IN (
				SELECT 	storage_id
				FROM 	saved_build b
				WHERE	b.build_name = '".$build_name."'
				  AND 	b.username = '".$username."'
			);";
	$result = $conn->query($sql);
	$row = $result->fetch_array();
	$sum = $row["sum_price"];
	
	// Set new total cost
	$sql = "UPDATE saved_build
			SET cost = '".$sum."'
			WHERE	build_name = '".$build_name."'
			  AND 	username = '".$username."';";
	$conn->query($sql);	
	
	// Redirect back to index.php
	header('Location: index.php');
	exit();
	
?>