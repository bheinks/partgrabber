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
	
	<!--- Header --->
	Welcome to PartGrabber!<br>
	<br>
	<br>
	
	<!--- Login area (aligned to top right corner) --->
	<!--- Submits form POST data to loginredirect.php which --->
	<!--- processes it, sets appropriate session variables and redirects back --->
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
		// Query database for saved build and store in $result
		$sql = "SELECT *
				FROM saved_build
				WHERE username='$username'";
		$result = $conn->query($sql);		
	?>
	
	<!--- Build up table of resulting saved builds --->
	<table border>
		
		<!--- Output top header row of table (build names) --->
		<tr>
			<td></td>
			<?php
				while($row = $result->fetch_array())
					echo "<td>".$row["build_name"]."</td>";
			?>
			<td></td>
		</tr>
		
		<!--- Iteratively output a line of components --->
		<!--- (one row for each component. one cell for each build) --->
		<?php
			for($y = 0; $y < count($component_array); $y++){
				echo "<tr>";
					echo "<td>".$component_array[$y]."</td>";
						for($x = 0; $x < mysqli_num_rows($result); $x++){
							$row = $result->fetch_array();
							if($row["build_name"] == " ")
								echo "<td>".$row["build_name"]."</td>";
							else
								echo "<td>"."Add one!"."</td>";
						}
						
				// One the last column, output an option to add a new build			
				if($y == 0){
					echo "<td rowspan='7'>";
						echo "Add a new build!";
					echo "</td>";
				}
				echo "</tr>";
			}
		?>
		
	</table>
	
</body>
</html>