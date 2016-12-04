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
		<title>Manage Member Data</title>
	</head>
	<body>
		<h1>Manage Member Data</h1>
		<div>
			<h3>Delete Member</h3>
			<form action="deleteMem.php" method="post">

				<fieldset>
					<legend>Member Name</legend>
					<select name="Memid">
<?php
if(!($stmt = $mysqli->prepare("SELECT memberid, fname FROM member_tbl"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($mid, $name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $mid . ' "> ' . $name . ' - ID: ' . $mid . '</option>\n';
}
$stmt->close();
?>
					</select>
				</fieldset>
				<input type="submit" name="Delete" value="Delete Member">
			</form>
		</div>

		</br>
		<p><a href="datahtml.php">Home</a></p>
	</body>
</html>
