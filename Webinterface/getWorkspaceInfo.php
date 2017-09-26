<?php

$subjects = array("Please select a Subject");
include "CreateDir.php";
$conn = mySQLConnect();
$workspace = $_POST['workspace'];

$sqlSelectSubjects = "SELECT SubjectID as SubjectID FROM NoAngstV2.Measurement WHERE WorkspaceID = '".$workspace."'";
$resultSubjectID = mysqli_query($conn, $sqlSelectSubjects);
while($rowSubjects = mysqli_fetch_assoc($resultSubjectID)){
	if(in_array($rowSubjects['SubjectID'],$subjects)){}
	else{
		array_push($subjects, $rowSubjects['SubjectID']);
	}
	
}
print_r(json_encode($subjects));
?>