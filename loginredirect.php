<?php
	session_start();
	require "database.inc.php";
	
	// Query user table if login form data sent
	if(isset($_POST['username'])){
		$_SESSION['valid_login'] = false;
		
		// Get passed username/password
		$username_given = $_POST['username'];
		$password_given = $_POST['password'];
		
		// Get username/password from database
		$sql = "SELECT username, password
				FROM user
				WHERE username='$username_given'";
		$result = $conn->query($sql);
		if(mysqli_num_rows($result)>0){
			while($row = $result->fetch_assoc()) {
				$username = $row["username"];
				$password = $row["password"];
			}
			
			// If match, log user in
			if($password == $password_given){
				$_SESSION['login_msg'] = "User ".$username." logged in!";
				$_SESSION['valid_login'] = true;
				$_SESSION['username'] = $username;
			}
			
			// If no match, invalid password
			else
				$_SESSION['login_msg'] = "Incorrect password. Not logged in.";
		}
		
		// If no results found, create username
		else{
			if($username_given != ""){
				$sql = "INSERT INTO user VALUES
							('".$username_given."','".$password_given."');";
					echo $sql;
				$conn->query($sql);	
				$_SESSION['login_msg'] = "Created new user ".$username_given.".";
				$_SESSION['valid_login'] = true;
				$_SESSION['username'] = $username_given;
			}
			else{
				$_SESSION['login_msg'] = "";
			}		
		}			
	}	
	
	// Redirect back to index.php
	header('Location: index.php');
	exit();
?>