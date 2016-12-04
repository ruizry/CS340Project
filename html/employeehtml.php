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
		<title>Employee Data</title>
	</head>
<body>
	<h1>Employee Data</h1>
	<div>
		<h3>Add Employee</h3>
		
		<form method="post" action="addemployee.php">
			
			<fieldset>
				<legend>Employee Name</legend>
				<p>First Name: <input type="text" name="FName" placeholder="John" required></p>
				<p>Last Name: <input type="text" name="LName" placeholder="Smith" required></p>
			</fieldset>

			<input type="submit" name="Add" value="Add Employee Data">
		</form>
	</div>

	<div>
		<h3>Assign Employee</h3>
		
		<form method="post" action="assignemployee.php">
			
			<fieldset>
				<legend>Employee ID</legend>
				<select name="EmployeeID">

<?php
if(!($stmt = $mysqli->prepare("SELECT empid, fname FROM employee_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>

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
	echo '<option value=" '. $gid . ' "> ' . $locname . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>

			<fieldset>
				<legend>Employee Name</legend>
				<p>Position: <input type="text" name="position" placeholder="Trainer"></p>
			</fieldset>
			
			<input type="submit" name="Add" value="Add Employee Data">
		</form>
	</div>
		
		</br>
		<p><a href="index.html">Home</a></p>
	</body>
</html>
