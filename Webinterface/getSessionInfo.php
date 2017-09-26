<?php

$sessions = array("Please select a Session");
include "CreateDir.php";
$conn = mySQLConnect();
$workspace = $_POST['workspace'];
$subject = $_POST['subject'];

$sqlSelectSessions = "SELECT SessionID as SessionID FROM NoAngstV2.Measurement WHERE WorkspaceID = '".$workspace."' AND SubjectID ='".$subject."'";
$resultSessionID = mysqli_query($conn, $sqlSelectSessions);
while($rowSessions = mysqli_fetch_assoc($resultSessionID)){
	if(in_array($rowSessions['SessionID'],$sessions)){}
	else{
		array_push($sessions, $rowSessions['SessionID']);
	}
	
}
print_r(json_encode($sessions));
?>