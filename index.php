

Welcome to PCPartPicker!<br>
<br>
<br>
<table><form>
	<tr>
		<td align="center" colspan="2" style="font-weight: bold;">
			Please log in
		</td>
	</tr>
	<tr>
		<td>
			Username:
		</td>
		<td>
			<input type="test" name="username">
		</td>
	</tr>
	<tr>
		<td>
			Password:
		</td>
		<td>
			<input type="test" name="password">
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2" style="font-weight: bold;">
			<input type="submit" value="Submit">
		</td>
	</tr>
		
</form></table>

<?php
$conn = new mysqli("localhost", "root", "", "pcpartpicker");
$sql = "SELECT username FROM user";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
        echo "username: " . $row["username"]."<br>";
    }
?>