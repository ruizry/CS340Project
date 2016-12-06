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
		<title>Filter Members</title>
	</head>
	<body>
		<form action="filterMembers.php" method="post">
			<legend>Select Date to show members other than selected:</legend>
			<select name="Date">
<?php
if (!($stmt = $mysqli->prepare("SELECT isMember.startdate FROM member_tbl LEFT JOIN isMember ON member_tbl.memberid=isMember.mid LEFT JOIN gym ON isMember.gid=gym.gymid"))) {
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!$stmt->bind_result($sdate)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while($stmt->fetch()){
	echo '<option value=" '. $sdate . ' "> Start Date: ' . $sdate . '</option>\n';
}

$stmt->close();
?>
			</select>
			<input type="submit" name="Filter" value="Filter">
		</form>

		<a href="datahtml.php"><input type="button" name="Home" value="Home"></a>
	</body>
</html>
