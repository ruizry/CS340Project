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
		<title>Manage Employee Data</title>
	</head>
	<body>
		<h1>Manage Employee Data</h1>
		<div>
			<h3>Delete Employee</h3>
			<form action="deleteEmp.php" method="post">

				<fieldset>
					<legend>Employee Name</legend>
					<select name="Empid">
<?php
if(!($stmt = $mysqli->prepare("SELECT empid, fname FROM employee_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($eid, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $eid . ' "> ' . $name . '</option>\n';
}
$stmt->close();
?>
					</select>
				</fieldset>
				<input type="submit" name="Delete" value="Delete Employee">
			</form>
		</div>

		</br>
		<p><a href="datahtml.php">Home</a></p>
	</body>
</html>