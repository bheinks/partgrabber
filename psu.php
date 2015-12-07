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
	
	<a href="index.php">Back</a>
	
	<table border>
		
		<!--- Display all available CPUs --->
		<tr>
			<td colspan="6">CPUs</td>
		</tr>
		<?php
			$sql = "SELECT *
					FROM psu";
			$result = $conn->query($sql);
			while($row = $result->fetch_array()){
				echo "<tr>";
					echo "<td>".$row["manufacturer"]."</td>";
					echo "<td>".$row["name"]."</td>";
					echo "<td>".$row["wattage"]."</td>";
					echo "<td>".$row["form_factor"]."</td>";
					echo "<td>";
						echo "<table border>";
							$sql = "SELECT *
									FROM sold_by
									WHERE comp_id = ".$row["comp_id"];
							$result2 = $conn->query($sql);
							while($row2 = $result2->fetch_array()){
								echo "<tr>";
									echo "<td>".$row2["retail_name"]."</td>";
									echo "<td>$".$row2["price"]."</td>";
									echo "<td><a href='index.php'>Add to build</a></td>";
								echo "</tr>";
							}
						echo "</table>";
					echo "</td>";
				echo "</tr>";
			}
		?>
		
		<!--- Display all available GPUs --->
		<tr>
			<td colspan="6">GPUs</td>
		</tr>
		<?php
			$sql = "SELECT *
					FROM gpu";
			$result = $conn->query($sql);
			while($row = $result->fetch_array()){
				echo "<tr>";
					echo "<td>".$row["manufacturer"]."</td>";
					echo "<td>".$row["name"]."</td>";
					echo "<td>".$row["clock_speed"]."</td>";
					echo "<td>".$row["vram"]."</td>";
					echo "<td><a href='index.php'>Add to build</a></td>";
				echo "</tr>";
			}
		?>
		
		<!--- Display all available RAM --->
		<tr>
			<td colspan="6">RAM</td>
		</tr>
		<?php
			$sql = "SELECT *
					FROM ram";
			$result = $conn->query($sql);
			while($row = $result->fetch_array()){
				echo "<tr>";
					echo "<td>".$row["manufacturer"]."</td>";
					echo "<td>".$row["name"]."</td>";
					echo "<td>".$row["capacity"]."</td>";
					echo "<td>".$row["speed"]."</td>";
					echo "<td><a href='index.php'>Add to build</a></td>";
				echo "</tr>";
			}
		?>
		
		<!--- Display all available Motherboards --->
		<tr>
			<td colspan="6">Motherboards</td>
		</tr>
		<?php
			$sql = "SELECT *
					FROM motherboard";
			$result = $conn->query($sql);
			while($row = $result->fetch_array()){
				echo "<tr>";
					echo "<td>".$row["manufacturer"]."</td>";
					echo "<td>".$row["name"]."</td>";
					echo "<td>".$row["form_factor"]."</td>";
					echo "<td>".$row["socket"]."</td>";
					echo "<td><a href='index.php'>Add to build</a></td>";
				echo "</tr>";
			}
		?>
		
		<!--- Display all available Storage --->
		<tr>
			<td colspan="6">Storage Drives</td>
		</tr>
		<?php
			$sql = "SELECT *
					FROM storage";
			$result = $conn->query($sql);
			while($row = $result->fetch_array()){
				echo "<tr>";
					echo "<td>".$row["manufacturer"]."</td>";
					echo "<td>".$row["name"]."</td>";
					echo "<td>".$row["capacity"]."</td>";
					echo "<td>".$row["type"]."</td>";
					echo "<td><a href='index.php'>Add to build</a></td>";
				echo "</tr>";
			}
		?>
		
		<!--- Display all available PSUs --->
		<tr>
			<td colspan="6">PSUs</td>
		</tr>
		<?php
			$sql = "SELECT *
					FROM psu";
			$result = $conn->query($sql);
			while($row = $result->fetch_array()){
				echo "<tr>";
					echo "<td>".$row["manufacturer"]."</td>";
					echo "<td>".$row["name"]."</td>";
					echo "<td>".$row["wattage"]."</td>";
					echo "<td>".$row["form_factor"]."</td>";
					echo "<td><a href='index.php'>Add to build</a></td>";
				echo "</tr>";
			}
		?>
		
		<!--- Display all available Cases --->
		<tr>
			<td colspan="6">Cases</td>
		</tr>
		<?php
			$sql = "SELECT *
					FROM comp_case";
			$result = $conn->query($sql);
			while($row = $result->fetch_array()){
				echo "<tr>";
					echo "<td>".$row["manufacturer"]."</td>";
					echo "<td>".$row["name"]."</td>";
					echo "<td>".$row["form_factor"]."</td>";
					echo "<td><a href='index.php'>Add to build</a></td>";
				echo "</tr>";
			}
		?>
	
	</table>
</body>
</html>