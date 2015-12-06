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
	
	Welcome to PartGrabber!<br>
	<br>
	<br>
	<div style="position:absolute; top:0px; right:0px; border:1px solid gray;">
		<form action="loginredirect.php" method="POST"><table>
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
	<?php
		$sql = "SELECT *
				FROM saved_build
				WHERE username='$username'";
		$result = $conn->query($sql);		
	?>
	<table border>
		<tr>
			<td>[part]</td>
			<?php
				while($row = $result->fetch_array())
					echo "<td>".$row["build_name"]."</td>";
			?>
			<td></td>
		</tr><tr>
			<td>CPU</td>
			<?php
				for($x = 0; $x < mysqli_num_rows($result); $x++){
					$row = $result->fetch_array();
					if($row["build_name"] == " ")
						echo "<td>".$row["build_name"]."</td>";
					else
						echo "<td>Add one!</td>";
				}					
			?>
			<td rowspan="6">
				Add a new build!
			</td>
		</tr><tr>
			<td>RAM</td>
			<?php
				for($x = 0; $x < mysqli_num_rows($result); $x++){
					$row = $result->fetch_array();
					if($row["build_name"] == " ")
						echo "<td>".$row["build_name"]."</td>";
					else
						echo "<td>Add one!</td>";
				}					
			?>
		</tr><tr>
			<td>Motherboard</td>
			<?php
				for($x = 0; $x < mysqli_num_rows($result); $x++){
					$row = $result->fetch_array();
					if($row["build_name"] == " ")
						echo "<td>".$row["build_name"]."</td>";
					else
						echo "<td>Add one!</td>";
				}					
			?>
		</tr><tr>
			<td>Storage</td>
			<?php
				for($x = 0; $x < mysqli_num_rows($result); $x++){
					$row = $result->fetch_array();
					if($row["build_name"] == " ")
						echo "<td>".$row["build_name"]."</td>";
					else
						echo "<td>Add one!</td>";
				}					
			?>
		</tr><tr>
			<td>GPU</td>
			<?php
				for($x = 0; $x < mysqli_num_rows($result); $x++){
					$row = $result->fetch_array();
					if($row["build_name"] == " ")
						echo "<td>".$row["build_name"]."</td>";
					else
						echo "<td>Add one!</td>";
				}					
			?>
		</tr><tr>
			<td>Case</td>
			<?php
				for($x = 0; $x < mysqli_num_rows($result); $x++){
					$row = $result->fetch_array();
					if($row["build_name"] == " ")
						echo "<td>".$row["build_name"]."</td>";
					else
						echo "<td>Add one!</td>";
				}					
			?>
		</tr>
	</table>
	
</body>
</html>