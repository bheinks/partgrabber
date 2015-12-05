<html>
<head>
	<title>PartGrabber [test version]</title>
	<?php require "database.inc.php"; ?>
	
	<?php
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
				$login_msg = "User ".$username." logged in!";
				$_SESSION['valid_login'] = true;
				$_SESSION['username'] = $username;
			}
			else
				$login_msg = "Incorrect password";
		}
		else
			$login_msg = "Username not found!";			
	}
	//unset($_POST);	
	
	// Get session login data if exists
	if((isset($_SESSION['valid_login'])) && ($_SESSION['valid_login'] == true)){
		$username = $_SESSION['username'];
		$login_msg = "User ".$username." logged in!";
	}else{
		$login_msg = "";
		$username = "";
	}
	
	
	?>
</head>
<body>
	
	Welcome to PCPartPicker!<br>
	<br>
	<br>
	<div style="position:absolute; top:0px; right:0px; border:1px solid gray;">
		<form action="index.php" method="POST"><table>
			<tr>
				<td align="center" colspan="2" style="font-weight: bold;">
					Please log in
				</td>
			</tr><tr>
				<td>Username:</td>
				<td><input type="test" name="username"></td>
			</tr><tr>
				<td>Password:</td>
				<td><input type="test" name="password"></td>
			</tr><tr>
				<td align="center" colspan="2">
					<?=$login_msg?>
				</td>
			</tr><tr>
				<td align="center" colspan="2">
					<input type="submit" value="Submit">
				</td>
			</tr>
		</table></form>
	</div>
	
	My Saved Builds!
	
	
</body>
</html>