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
		<title>Manage Gym Data</title>
	</head>
	<body>
		<h1>Manage Gym Data</h1>
		<div>
			<h3>Delete Gym Location</h3>
			<form action="deleteGym.php" method="post">

				<fieldset>
					<legend>Gym Location</legend>
					<select name="GLocation">
<?php
if(!($stmt = $mysqli->prepare("SELECT gymid, locationName FROM gym"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($gid, $locname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $gid . ' "> ' . $locname . ' - ID: ' . $gid . '</option>\n';
}
$stmt->close();
?>
					</select>
				</fieldset>
				<input type="submit" name="Delete" value="Delete Gym Data">
			</form>
		</div>

		</br>
		<p><a href="datahtml.php">Home</a></p>
	</body>
</html>