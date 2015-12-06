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
	<a href="createbuild.php">[Create a new build]</a>

	<!--- Build up table of resulting saved builds --->
	<table border>
		<?php
		
			// Query database for saved build and store in $result
			$sql = "SELECT *
					FROM saved_build
					WHERE username='$username'";
			$result = $conn->query($sql);
			
			// Output header row of items in component_array[]
			echo "<tr>";
				echo "<td></td>";
				for($y = 0; $y < count($component_array); $y++)
					echo "<td>".$component_array[$y]."</td>";
				echo "<td>Total Cost</td>";
			echo "</tr>";
			
			
			// Output each row of saved builds
			for($y = 0; $y < mysqli_num_rows($result); $y++){
				echo "<tr>";
				$row = $result->fetch_array();
				echo "<td>".$row["build_name"]."</td>";
				for($x = 0; $x < count($component_array); $x++){
						if($row[strtolower($component_array[$x])."_id"] != 0){
							$sql = "SELECT *
									FROM ".strtolower($component_array[$x])."
									WHERE comp_id=".$row[strtolower($component_array[$x])."_id"];
							$result2 = $conn->query($sql);
							$row2 = $result2->fetch_array();
							
							echo "<td>".$row2["manufacturer"]."&nbsp;".$row2["name"]."</td>";
							
						}
							
						else
							echo "<td>Add One!</td>";
					}
					echo "<td>$".$row["cost"]."</td>";
				echo "</tr>";
			}
		?>
		
	</table>
	
</body>
</html>