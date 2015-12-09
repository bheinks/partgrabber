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
		
		if(isset($_POST["search_field"]))
			$search_field = $_POST["search_field"];
		else
			$search_field = "";	
	?>
	
</head>
<body>
	
	<a href="index.php">Back</a>
	
	<p style="font-weight: bold; font-size: 22px; text-align: center;">Cases</p>
	
	<div style="text-align: center;">
		<form action="case.php?build_name=<?=$build_name?>" method="POST">
			<b>Narrow Search Results:</b><br>
			Search:
			<input type="test" name="search_field" placeholder="<?=$search_field?>"><br>
			<input type="submit" value="Submit">
		</form>
	</div>		
	
	<table border align="center" style="text-align: center;">
		
		<?php
			// Display all available CPUs
			$sql = "SELECT *
					FROM comp_case
					WHERE 1=1";
			if($search_field != ""){
				$sql = $sql." AND (
					   manufacturer LIKE('%".$search_field."%')
					OR name LIKE('%".$search_field."%')
					OR form_factor LIKE('%".$search_field."%')						
				);";				
			}
			$result = $conn->query($sql);
			while($row = $result->fetch_array()){
				echo "<tr>";
					echo "<td>".$row["manufacturer"]."</td>";
					echo "<td>".$row["name"]."</td>";
					echo "<td>".$row["form_factor"]."</td>";
					echo "<td>";
					
						// Display all Retailers its available from
						echo "<table border>";
							$sql = "SELECT *
									FROM sold_by
									WHERE comp_id = '".$row["comp_id"]."';";
							$result2 = $conn->query($sql);
							while($row2 = $result2->fetch_array()){
								echo "<tr>";
									echo "<td style='width:160px;'>".$row2["retail_name"]."</td>";
									echo "<td style='width:80px;'>$".$row2["price"]."</td>";
									echo "<td style='width:90px;'><a href='addpartredirect.php?
											build_name=".$build_name."&
											comp_id=".$row2["sold_id"]."&
											comp_type=case
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