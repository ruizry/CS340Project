<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","sanchjoh-db","pb3bG0PgvCuxtXbK","sanchjoh-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Member Data</title>
	</head>
	<body>
		<h1>Member Data</h1>

		<div>
			<h3>Add Member Info</h3>
			<form action="addMemberInfo.php" method="post">
				<fieldset>
					<legend>Personal Member Info</legend>
					<p>First Name <input type="text" name="FName" placeholder="John"></p>
					<p>Last Name <input type="text" name="LName" placeholder="Smith"></p>
					<p>Phone Number <input type="text" name="PNum" placeholder="123456789"></p>
				</fieldset>
				<input type="submit" name="InfoAdd" value="Add Member Info">
			</form>
		</div>

		<div>
			<h3>Add Gym Info</h3>
			<form action="addMemberGymInfo.php" method="post">
				<fieldset>
					<legend>Member</legend>
					<select name="MemberID">
<?php
if(!($stmt = $mysqli->prepare("SELECT memberid, fname FROM member_tbl"))){
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
					<legend>Gym Location</legend>
					<select name="GLocation">
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
					<legend>Gym Membership Info</legend>
					<p>Start Date <input type="date" name="SDate" placeholder="YYYY-MM-DD"></p>
					<p>Active Member <input type="number" name="MStatus" placeholder="1 = yes 0 = no"></p>
				</fieldset>
				<input type="submit" name="GymInfoAdd" value="Add Gym Membership Info">
			</form>
		</div>

		</br>
		<p><a href="index.html">Home</a></p>
	</body>
</html>
