<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","ruizry-db","WeUJO0bUJKhJstCn","ruizry-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Gym Data</title>
	</head>
	<body>
		<h1>Gym Data</h1>

		<div>
			<h3>Add Gym Location</h3>
			<form action="addGym.php" method="post">
				<fieldset>
					<legend>Location Info</legend>
					<p>City <input type="text" name="GCity" placeholder="Orange, CA" required></p>
					<p>Zip Code <input type="number" name="GZip" placeholder="12345" required></p>
				</fieldset>
				<input type="submit" name="Add" value="Add Gym Data">
			</form>
		</div>

		</br>
		<p><a href="datahtml.php">Home</a></p>
	</body>
</html>