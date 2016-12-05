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
		<title>Class Members</title>
	</head>
	<body>
		<h3>Class Members</h3>
		<table>
			<tr>
				<th>Class Name</th>
				<th>Student First Name</th>
				<th>Student Last Name</th>
			</tr>
<?php
if (!($stmt = $mysqli->prepare("SELECT class_tbl.name, member_tbl.fname, member_tbl.lname FROM isStudent INNER JOIN member_tbl ON isStudent.mid = member_tbl.memberid INNER JOIN class_tbl ON isStudent.cid = class_tbl.classid WHERE isStudent.cid =?"))) {
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if (!($stmt->bind_param("i",$_POST['ClassID']))) {
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!$stmt->bind_result($cname, $sfname, $slname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while ($stmt->fetch()) {
	echo "<tr>\n<td>" . $cname . "</td>\n<td>" . $sfname . "</td>\n<td>" . $slname . "</td>\n</tr>";
}
?>
		</table>

		<br/>
		<a href="viewClassRoster.php"><input type="button" name="Back" value="Back"></a>
		<a href="datahtml.php"><input type="button" name="Home" value="Home"></a>
	</body>
</html>
