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
	$motherboard_socket = $row["socket"];
	
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
	$cpu_socket = $row["socket"];
	
	echo $cpu_socket."<br>".$motherboard_socket;
	
	if(($motherboard_socket != $cpu_socket) && ($motherboard_socket != "") && ($cpu_socket != ""))
		$compatibility = $compatibility."Socket Mismatch!";

	
	$_SESSION["compatibility"] = $compatibility;
	$_SESSION["compatibility_build"] = $build_name;
	
	// Redirect back to index.php
	header('Location: index.php');
	exit();
	
?>