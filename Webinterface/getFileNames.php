<?php

$files = array("Please select a File");
include "CreateDir.php";
$conn = mySQLConnect();
$workspace = $_POST['workspace'];
$subject = $_POST['subject'];
$session = $_POST['session'];

$sqlSelectFiles = "SELECT FileName as FileName FROM NoAngstV2.Measurement WHERE WorkspaceID = '".$workspace."' AND SubjectID ='".$subject."' AND SessionID = '".$session."'";
$resultFiles = mysqli_query($conn, $sqlSelectFiles);
while($rowFiles = mysqli_fetch_assoc($resultFiles)){
	$arrayFileNames = explode("_",$rowFiles['FileName']);
	if(in_array($arrayFileNames[5],$files)){}
	else{
		array_push($files, $arrayFileNames[5]);
	}
	
}
print_r(json_encode($files));
?>