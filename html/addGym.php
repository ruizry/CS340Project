<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
//$mysqli = new mysqli("oniddb.cws.oregonstate.edu","ruizry-db","WeUJO0bUJKhJstCn","ruizry-db");
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","sanchjoh-db","pb3bG0PgvCuxtXbK","sanchjoh-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if (!($stmt = $mysqli->prepare("INSERT INTO gym(locationName, zipCode) VALUES (?,?)"))) {
	echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if (!($stmt->bind_param("si",$_POST['GCity'],$_POST['GZip']))) {
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added gym";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<meta charset="utf-8">
		<title>Gym Status</title>
	</head>
<body>
	<div>
		<p><a href="gymData.php">Back</a></p>
		<p><a href="datahtml.php">Home</a></p>
	</div>
</body>
</html>
