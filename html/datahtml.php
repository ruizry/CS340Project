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
		<title>All Gym Data</title>
	</head>
<body>
<h1>Data Tables</h1>
<div>
	<table>
		<tr>
			<td>Gym Table</td>
		</tr>
		<tr>
			<td>ID</td>
			<td>Location</td>
			<td>Zip Code</td>
		</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT gym.gymid, gym.locationName, gym.zipCode FROM gym"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $location, $zip)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $location . "\n</td>\n<td>\n" . $zip . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>
<div>
	<form action="gymData.php">
    	<input type="submit" value="Add a Gym" />
	</form>
	</br>
	<form action="gymManage.php">
    	<input type="submit" value="Delete a Gym" />
	</form>
</div>
</br>
<div>
		<table>
			<tr>Employee Table</tr>
			<tr>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Position</th>
				<th>Location</th>
				<th>Start Date</th>
			</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT employee_tbl.empid, employee_tbl.fname, employee_tbl.lname, isEmployee.position, gym.locationName, isEmployee.startdate FROM employee_tbl LEFT JOIN isEmployee ON employee_tbl.empid=isEmployee.eid LEFT JOIN gym ON gym.gymid=isEmployee.gid"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $fname, $lname, $pos, $loc, $start)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $pos . "\n</td>\n<td>\n" . $loc . "\n</td>\n<td>\n" . $start . "\n</td>\n</tr>";
}
$stmt->close();
?>
		</table>

		</br>
</div>

<div>
	<form action="employeeData.php">
    	<input type="submit" value="Add Employee/Employee Status" />
	</form>
	</br>
	<form action="employeeManage.php">
    	<input type="submit" value="Remove Employee/Employee Status" />
	</form>
</div>

</br>

<div>
		<table>
			<tr>Class Table</tr>
			<tr>
				<th>ID</th>
				<th>Gym ID</th>
				<th>Name</th>
				<th>Day Offered</th>
				<th>Time</th>
				<th>Duration</th>
				<th>Capacity</th>
				<th>Instructor First Name</th>
				<th>Instructor Last Name</th>
			</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT class_tbl.classid, class_tbl.gid, class_tbl.name, class_tbl.classDay, class_tbl.classTime, class_tbl.durationMin, class_tbl.capacity, employee_tbl.fname, employee_tbl.lname FROM class_tbl LEFT JOIN isInstructor ON class_tbl.classid=isInstructor.cid LEFT JOIN employee_tbl ON employee_tbl.empid=isInstructor.eid"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $gid, $name, $days, $time, $dur, $cap, $fname, $lname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $gid . "\n</td>\n<td>\n" . $name . "\n</td>\n<td>\n" . $days . "\n</td>\n<td>\n" . $time . "\n</td>\n<td>\n" . $dur . "\n</td>\n<td>\n" . $cap . "\n</td>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n</tr>";
}
$stmt->close();
?>
		</table>

		</br>
</div>

<div>
	<form action="classData.php">
    	<input type="submit" value="Add a Class" />
	</form>
	</br>
	<form action="classManage.php">
    	<input type="submit" value="Delete a Class" />
	</form>
</div>

</br>

<div>
		<table>
			<tr>Member Table</tr>
			<tr>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Location</th>
				<th>Start Date</th>
				<th>Membership Status</th>
			</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT member_tbl.memberid, member_tbl.fname, member_tbl.lname, gym.locationName, isMember.startdate, isMember.activeMember FROM member_tbl LEFT JOIN isMember ON member_tbl.memberid=isMember.mid LEFT JOIN gym ON isMember.gid=gym.gymid"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $fname, $lname, $loc, $start, $status)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $loc . "\n</td>\n<td>\n" . $start . "\n</td>\n<td>\n" . $status . "\n</td>\n</tr>";
}
$stmt->close();
?>
		</table>

		</br>
</div>

<div>
	<form action="memberData.php">
    	<input type="submit" value="Add Member/Member Status" />
	</form>
	</br>
	<form action="memberManage.php">
    	<input type="submit" value="Remove Member/Member Status" />
	</form>
</div>

</br>
	</body>
</html>
