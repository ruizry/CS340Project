<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","sanchjoh-db","pb3bG0PgvCuxtXbK","sanchjoh-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
	<body>
		<h1>Gym Data</h1>

		<div>
			<h3>Add Gym Location</h3>
			<form action="addGym.php" method="post">
				<fieldset>
					<legend>Location Info</legend>
					<p>City <input type="text" name="GCity"></p>
					<p>Zip Code <input type="number" name="GZip"></p>
				</fieldset>
				<input type="input" name="Add" value="Add Gym Data">
			</form>
		</div>

	</br>
	<p><a href="index.html">Home</a></p>
	</body>
</html>
