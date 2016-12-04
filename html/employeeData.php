<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
//$mysqli = new mysqli("oniddb.cws.oregonstate.edu","ruizry-db","WeUJO0bUJKhJstCn","ruizry-db");
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","sanchjoh-db","pb3bG0PgvCuxtXbK","sanchjoh-db");
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
		<h3>Assign Position to An Employee</h3>

		<form method="post" action="assignemployee.php">

			<fieldset>
				<legend>Select Employee</legend>
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
	echo '<option value=" '. $id . ' "> ' . $name . ' - ID: ' . $id . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>

			<fieldset>
				<legend>Select Gym</legend>
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
				<p>Position: <input type="text" name="position" placeholder="Trainer"></p>
			</fieldset>

			<input type="submit" name="Add" value="Add Employee Data">
		</form>
	</div>

	<div>
		<h3>Assign A Class to An Employee</h3>

		<form method="post" action="assignempclass.php">

			<fieldset>
				<legend>Select Employee</legend>
				<select name="EmpID">

<?php
if(!($stmt = $mysqli->prepare("SELECT empid, fname FROM employee_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id2, $name2)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id2 . ' "> ' . $name2 . ' - ID: ' . $id2 . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>

			<fieldset>
				<legend>Select Class</legend>
				<select name="ClassID">

<?php
if(!($stmt = $mysqli->prepare("SELECT classid, name FROM class_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($cid, $cname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $cid . ' "> ' . $cname . ' - ID: ' . $cid . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>

			<input type="submit" name="AddC" value="Add This Instructor to the Class">
		</form>
	</div>

		</br>
		<p><a href="datahtml.php">Home</a></p>
	</body>
</html>
