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
</br>
<div>
		<table>
			<tr>Employee Table</tr>
			<tr>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Position</th>
			</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT employee_tbl.empid, employee_tbl.fname, employee_tbl.lname, isEmployee.position FROM employee_tbl INNER JOIN isEmployee ON employee_tbl.empid=isEmployee.eid"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $fname, $lname, $pos)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $pos . "\n</td>\n</tr>";
}
$stmt->close();
?>
		</table>
		
		</br>
</div>
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
if(!($stmt = $mysqli->prepare("SELECT class_tbl.classid, class_tbl.gid, class_tbl.name, class_tbl.classDay, class_tbl.classTime, class_tbl.durationMin, class_tbl.capacity, employee_tbl.fname, employee_tbl.lname FROM class_tbl INNER JOIN isInstructor ON class_tbl.classid=isInstructor.cid INNER JOIN employee_tbl ON employee_tbl.empid=isInstructor.eid"))){
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
		<table>
			<tr>Member Table</tr>
			<tr>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Start Date</th>
				<th>Membership Status</th>
			</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT member_tbl.memberid, member_tbl.fname, member_tbl.lname, isMember.startdate, isMember.activeMember FROM member_tbl INNER JOIN isMember ON member_tbl.memberid=isMember.mid"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $fname, $lname, $start, $status)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $start . "\n</td>\n<td>\n" . $status . "\n</td>\n</tr>";
}
$stmt->close();
?>
		</table>
		
		</br>
</div>
		<p><a href="index.html">Home</a></p>
	</body>
</html>