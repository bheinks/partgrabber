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
		
		$build_name = $_GET["build_name"];	
	?>
	
</head>
<body>
	
	<a href="index.php">Back</a><br><br>	
	
	Motherboards<br><br>	
	
	<table border>
		
		<?php
			// Display all available CPUs
			$sql = "SELECT *
					FROM motherboard";
			$result = $conn->query($sql);
			while($row = $result->fetch_array()){
				echo "<tr>";
					echo "<td>".$row["manufacturer"]."</td>";
					echo "<td>".$row["name"]."</td>";
					echo "<td>".$row["form_factor"]."</td>";
					echo "<td>".$row["socket"]."</td>";
					echo "<td>";
					
						// Display all Retailers its available from
						echo "<table border>";
							$sql = "SELECT *
									FROM sold_by
									WHERE comp_id = ".$row["comp_id"];
							$result2 = $conn->query($sql);
							while($row2 = $result2->fetch_array()){
								echo "<tr>";
									echo "<td>".$row2["retail_name"]."</td>";
									echo "<td>$".$row2["price"]."</td>";
									echo "<td><a href='addpartredirect.php?
											build_name=".$build_name."&
											comp_id=".$row2["sold_id"]."&
											comp_type=motherboard
											'>Add to build</a></td>";
								echo "</tr>";
							}
						echo "</table>";
					echo "</td>";
				echo "</tr>";
			}
		?>
		
		
	
	</table>
</body>
</html>