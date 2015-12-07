<?php session_start(); ?>

<html>
<head>
	<title>PartGrabber [test version]</title>
	<?php require "database.inc.php"; ?>
	
	<?php	
		// Get session login data if exists
		if((isset($_SESSION['valid_login'])) && ($_SESSION['valid_login'] == true)){
			$username = $_SESSION['username'];
			$login_msg = "User ".$username." logged in!";
			$valid_login = true;
		}else{
			$username = "";
			$login_msg = $_SESSION['login_msg'];
			$valid_login = false;
		}
	?>
	
</head>
<body>
	
	<a href="index.php">Back</a><br><br>
	
	<form action="createbuildredirect.php" method="GET"><table>
			<tr>
				<td align="center" colspan="2" style="font-weight: bold;">
					Create a new build
				</td>
			</tr><tr>
				<td>Build Name:</td>
				<td><input type="test" name="build_name"></td>
			</tr><tr>
				<td>Build Description:</td>
				<td><input type="test" name="build_description"></td>
			</tr><tr>
				<td align="center" colspan="2">
					<input type="submit" value="Submit">
				</td>
			</tr>
		</table></form>
	
</body>
</html>