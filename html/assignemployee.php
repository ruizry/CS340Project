<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
//$mysqli = new mysqli("oniddb.cws.oregonstate.edu","ruizry-db","WeUJO0bUJKhJstCn","ruizry-db");
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","sanchjoh-db","pb3bG0PgvCuxtXbK","sanchjoh-db");
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

if(!($stmt = $mysqli->prepare("INSERT INTO isEmployee(eid, gid, startdate, position) VALUES (?,?,NOW(),?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("iis",$_POST['EmployeeID'],$_POST['GymID'],$_POST['position']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Employee Assigned";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<meta charset="utf-8">
		<title>Employee Assignment Status</title>
	</head>
<body>
	<div>
		<p><a href="employeeData.php">Back</a></p>
		<p><a href="datahtml.php">Home</a></p>
	</div>
</body>
</html>
