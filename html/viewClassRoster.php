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

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>View Class Rosters</title>
	</head>
	<body>
		<div>
			<form action="classMembers.php" method="post">
				<fieldset>
					<legend>Select a Class</legend>
					<select name="ClassID">
<?php
if(!($stmt = $mysqli->prepare("SELECT classid, name FROM class_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!$stmt->bind_result($cid, $classname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while($stmt->fetch()){
	echo '<option value=" '. $cid . ' "> ' . $classname . ' - ID: ' . $cid . '</option>\n';
}

$stmt->close();
?>
					</select>
				</fieldset>
				<input type="submit" name="View" value="View Members in Selected Class">
			</form>
		</div>

	</br>
	<p><a href="datahtml.php">Home</a></p>
	</body>
</html>
