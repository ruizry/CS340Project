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
		<title>Employee Class/Gym Removal</title>
	</head>
	<body>
		<h1>Manage Employee Classes/Gyms</h1>
		<div>
			<h3>Remove Class From Employee</h3>
			<form action="deleteEmpClass.php" method="post">

				<fieldset>
					<legend>Employee Info</legend>

<?php
if(!($stmt = $mysqli->prepare("SELECT empid, fname FROM employee_tbl WHERE empid=?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if (!($stmt->bind_param("i",$_POST['Empid2']))) {
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($eid2, $fname2)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<p>' . $fname2 . ' ID: <input type="text" name="empid1" value="' . $eid2 . '"></p>';
}

$stmt->close();
?>

				</fieldset>

				<fieldset>
					<legend>Class Name</legend>
					<select name="Classid">

<?php
if (!($stmt = $mysqli->prepare("SELECT cid, name FROM isInstructor INNER JOIN class_tbl ON class_tbl.classid=isInstructor.cid WHERE eid=?"))) {
	echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if (!($stmt->bind_param("i",$_POST['Empid2']))) {
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->bind_result($cid, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $cid . ' "> ' . $name . ' - ID: ' . $cid . '</option>\n';
}
?>

					</select>
				</fieldset>
				<input type="submit" name="Removeclass" value="Remove Class">
			</form>
		</div>

		<div>
			<h3>Remove Gym from Employee</h3>
			<form action="deleteEmpGym.php" method="post">

				<fieldset>
					<legend>Employee Info</legend>

<?php
if(!($stmt = $mysqli->prepare("SELECT empid, fname FROM employee_tbl WHERE empid=?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if (!($stmt->bind_param("i",$_POST['Empid2']))) {
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($eid, $fname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<p>' . $fname . ' ID: <input type="text" name="empid2" value="' . $eid . '"></p>';
}
$stmt->close();
?>

				</fieldset>

				<fieldset>
					<legend>Gym Name</legend>
					<select name="Gymid">

<?php
if (!($stmt = $mysqli->prepare("SELECT gid, locationName FROM isEmployee INNER JOIN gym ON gym.gymid=isEmployee.gid WHERE eid=?"))) {
	echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if (!($stmt->bind_param("i",$_POST['Empid2']))) {
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->bind_result($gid, $locname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $gid . ' "> ' . $locname . ' - ID: ' . $gid . '</option>\n';
}
?>

					</select>
				</fieldset>
				<input type="submit" name="Removegym" value="Remove Gym">
			</form>
		</div>

	<div>
		<p><a href="employeeManage.php">Back</a></p>
		<p><a href="datahtml.php">Home</a></p>
	</div>
</body>
</html>
