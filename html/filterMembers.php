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
		<title>Members Added Outside Chosen Date</title>
	</head>
	<body>
		<table>
			<tr>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Location</th>
				<th>Start Date</th>
				<th>Membership Status</th>
			</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT member_tbl.memberid, member_tbl.fname, member_tbl.lname, gym.locationName,isMember.startdate, isMember.activeMember FROM member_tbl LEFT JOIN isMember ON member_tbl.memberid=isMember.mid LEFT JOIN gym ON isMember.gid=gym.gymid WHERE isMember.startdate NOT IN (?) "))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if (!($stmt->bind_param("s",$_POST['Date']))) {
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!$stmt->bind_result($memid, $fname, $lname, $glocation, $sdate, $activem)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while ($stmt->fetch()) {
	echo "<tr>\n<td>" . $memid . "</td>\n<td>" . $fname . "</td>\n<td>" . $lname . "</td>\n<td>" . $glocation . "</td>\n<td>" . $sdate . "</td>\n<td>" . $activem . "</td>\n</tr>";
}

?>
		</table>
		<br/>
		<a href="filterMembersLanding.php"><input type="button" name="Back" value="Back"></a>
		<a href="datahtml.php"><input type="button" name="Home" value="Home"></a>
	</body>
</html>
