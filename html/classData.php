<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","ruizry-db","WeUJO0bUJKhJstCn","ruizry-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<meta charset="utf-8">
		<title>Class Data</title>
	</head>
<body>
	<h1>Class Data</h1>
	<div>
		<h3>Add Employee</h3>
		
		<form method="post" action="addclass.php">

			<fieldset>
				<legend>Gym ID</legend>
				<select name="GymID">

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
			
			<fieldset>
				<p>Name: <input type="text" name="name" placeholder="REQUIRED" required></p>
			</fieldset>

			<fieldset>
				<p>Day of the Week: <input type="text" name="day" placeholder="Monday"></p>
				<p>Start Time: <input type="text" name="time" placeholder="1:00pm"></p>
				<p>Duration (in minutes): <input type="text" name="duration" placeholder=30></p>
				<p>Class Capacity: <input type="text" name="capacity" placeholder=15></p>
			</fieldset>

			<input type="submit" name="Add" value="Add Class">
		</form>
	</div>
		</br>
		<p><a href="datahtml.php">Home</a></p>
	</body>
</html>