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
		<title>Select Available Class</title>
	</head>
	<body>
		<h1>Available Classes</h1>
		<div>
			<h3>Add Class To Member</h3>
			<form action="assignmemclass.php" method="post">

				<fieldset>
					<legend>Member Info</legend>

<?php
if(!($stmt = $mysqli->prepare("SELECT memberid, fname FROM member_tbl WHERE memberid=?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if (!($stmt->bind_param("i",$_POST['MemID']))) {
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($mid2, $fname2)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<p>' . $fname2 . ' ID: <input type="text" name="MemID" value="' . $mid2 . '"></p>';
}

$stmt->close();
?>

				</fieldset>

				<fieldset>
					<legend>Class Name</legend>
					<select name="ClassID">

<?php
if (!($stmt = $mysqli->prepare("SELECT class_tbl.classid, class_tbl.name FROM member_tbl INNER JOIN isMember ON isMember.mid=member_tbl.memberid INNER JOIN gym ON gym.gymid=isMember.gid INNER JOIN class_tbl ON class_tbl.gid=gym.gymid WHERE member_tbl.memberid=?"))) {
	echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if (!($stmt->bind_param("i",$_POST['MemID']))) {
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
				<input type="submit" name="Addclass" value="Add Class">
			</form>
		</div>

	<div>
		<p><a href="memberData.php">Back</a></p>
		<p><a href="datahtml.php">Home</a></p>
	</div>
</body>
</html>
