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
		<title>Member Class/Gym Removal</title>
	</head>
	<body>
		<h1>Manage Member Classes/Gyms</h1>
		<div>
			<h3>Remove Class From Member</h3>
			<form action="deleteMemClass.php" method="post">

				<fieldset>
					<legend>Member Info</legend>

<?php
if(!($stmt = $mysqli->prepare("SELECT memberid, fname FROM member_tbl WHERE memberid=?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if (!($stmt->bind_param("i",$_POST['Memid2']))) {
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($mid2, $fname2)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<p>' . $fname2 . ' ID: <input type="text" name="memid1" value="' . $mid2 . '"></p>';
}

$stmt->close();
?>

				</fieldset>

				<fieldset>
					<legend>Class Name</legend>
					<select name="Classid">

<?php
if (!($stmt = $mysqli->prepare("SELECT cid, name FROM isStudent INNER JOIN class_tbl ON class_tbl.classid=isStudent.cid WHERE mid=?"))) {
	echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if (!($stmt->bind_param("i",$_POST['Memid2']))) {
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
			<h3>Remove Gym from Member</h3>
			<form action="deleteMemGym.php" method="post">

				<fieldset>
					<legend>Member Info</legend>

<?php
if(!($stmt = $mysqli->prepare("SELECT memberid, fname FROM member_tbl WHERE memberid=?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if (!($stmt->bind_param("i",$_POST['Memid2']))) {
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($mid, $fname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<p>' . $fname . ' ID: <input type="text" name="memid2" value="' . $mid . '"></p>';
}
$stmt->close();
?>

				</fieldset>

				<fieldset>
					<legend>Gym Name</legend>
					<select name="Gymid">

<?php
if (!($stmt = $mysqli->prepare("SELECT gid, locationName FROM isMember INNER JOIN gym ON gym.gymid=isMember.gid WHERE mid=?"))) {
	echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if (!($stmt->bind_param("i",$_POST['Memid2']))) {
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
		<p><a href="memberManage.php">Back</a></p>
		<p><a href="datahtml.php">Home</a></p>
	</div>
</body>
</html>