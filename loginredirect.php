<?php
	session_start();
	require "database.inc.php";
	
	// Query user table if login form data sent
	if(isset($_POST['username'])){
		$_SESSION['valid_login'] = false;
		$username_given = $_POST['username'];
		$password_given = $_POST['password'];
		$sql = "SELECT username, password
				FROM user
				WHERE username='$username_given'";
		$result = $conn->query($sql);
		if(mysqli_num_rows($result)>0){
			while($row = $result->fetch_assoc()) {
				$username = $row["username"];
				$password = $row["password"];
			}
			if($password == $password_given){
				$_SESSION['login_msg'] = "User ".$username." logged in!";
				$_SESSION['valid_login'] = true;
				$_SESSION['username'] = $username;
			}
			else
				$_SESSION['login_msg'] = "Incorrect password";
		}
		else
			$_SESSION['login_msg'] = "Username not found!";			
	}	

	$_SESSION["test2"] = "test123";
	header('Location: index.php');
	exit();
?>