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
	<p style="font-weight: bold; font-size: 22px; text-align: center;"><br>Welcome to PartGrabber!<br><br></p>
	
	<!--- Login area (aligned to top right corner) --->
	<!--- Submits form POST data to loginredirect.php which --->
	<!--- processes it, sets appropriate session variables and redirects back --->
	<div style="position:absolute; top:0px; right:0px; border:1px solid gray; background-color: white;">
		<form action="loginredirect.php" method="POST"><table>
			<tr>
				<td align="center" colspan="2"">
					<b>Log In: </b><br>
					<font size="2">(or create account)</font>
				</td>
			</tr><tr>
				<td>Username:</td>
				<td><input type="test" name="username"></td>
			</tr><tr>
				<td>Password:</td>
				<td><input type="password" name="password"></td>
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
	
	<p style="text-align: center;"><b>My Saved Builds!<br></b>
	<a href="createbuild.php">[Create a new build]</a></p>
	
	<?php
	
	
	?>

	<!--- Build up table of resulting saved builds --->
	<table border align="center">
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
				echo "<td>";
					echo "<b>".$row["build_name"]."</b><br>";
					echo "<i>".$row["description"]."</i><br>";
					echo "<a href='deletebuildredirect.php?build_name=".$row["build_name"]."'>Delete</a><br>";
					echo "<a href='compatibleredirect.php?build_name=".$row["build_name"]."'>Check Compatibility</a>";
				echo "</td>";
				for($x = 0; $x < count($component_array); $x++){
						if($row[strtolower($component_array[$x])."_id"] != "0"){
							$temp = strtolower($component_array[$x]);
							if($temp == "case")
								$temp = "comp_case";
							$sql = "SELECT *
									FROM   sold_by a, ".$temp." b
									WHERE  a.sold_id = '".$row[strtolower($component_array[$x])."_id"]."'
									  AND  b.comp_id = a.comp_id";
							$result2 = $conn->query($sql);
							$row2 = $result2->fetch_array();
							
							echo "<td>".$row2["manufacturer"]."&nbsp;".$row2["name"]."<br>
								 $".$row2["price"]."&nbsp;(".$row2["retail_name"].")<br>
								 <a href='".strtolower($component_array[$x]).".php?build_name=".$row["build_name"]."'>Change this!</a></td>";
						}
							
						else
							echo "<td><a href='".strtolower($component_array[$x]).".php?build_name=".$row["build_name"]."'>Add One!</a></td>";
							
					}
					echo "<td>$".$row["cost"]."</td>";
				echo "</tr>";
				
				// if a compatibility message is set, show it below this row
				if((isset($_SESSION["compatibility"])) && ($_SESSION["compatibility"] != "")){
					if($_SESSION["compatibility_build"] == $row["build_name"]){
						echo "<tr style='text-align:center;'>";
							echo "<td colspan='9'>";
								echo $_SESSION["compatibility"];
							echo "</td>";
						echo "</tr>";
					}
				}
		
			}
			
		?>
		
	</table>
	
</body>
</html>