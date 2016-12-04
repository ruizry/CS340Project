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
		<title>Manage Class Data</title>
	</head>
	<body>
		<h1>Manage Class Data</h1>
		<div>
			<h3>Delete Class</h3>
			<form action="deleteClass.php" method="post">

				<fieldset>
					<legend>Class Name</legend>
					<select name="clid">
<?php
if(!($stmt = $mysqli->prepare("SELECT classid, name FROM class_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($cid, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $cid . ' "> ' . $name . '</option>\n';
}
$stmt->close();
?>
					</select>
				</fieldset>
				<input type="submit" name="Delete" value="Delete Class">
			</form>
		</div>

		</br>
		<p><a href="datahtml.php">Home</a></p>
	</body>
</html>