<?php
	function getCsvFiles(){
		$dir = 'csvFiles';
		$files = array_values(array_diff(scandir($dir), array('.','..')));
		return $files;
	}

	function getWorkspace(){
		$files = getCsvFiles();
		if(sizeof($files) !== 0){
			$dir = "csvFiles/";
			for($x = 0; $x < sizeof($files); $x++){
	
				$oldPath = $dir.$files[$x];
				$arraySplit = explode("_",$files[$x]);
				$newPath = 'Archiv/'.$arraySplit[0].'/VP_'.$arraySplit[2].'/SN_'.$arraySplit[4];
				checkForWorkspace($arraySplit[0]);
				if(sizeof($arraySplit) === 6){
					$arrayMeasureType = explode(".",$arraySplit[5]);
					linkDataWithWorkspace($arraySplit[0], $arraySplit[2], $arraySplit[4], $arrayMeasureType[0], $newPath, $files[$x]);
				}
				if(sizeof($arraySplit) === 7){
					$arrayMeasureType = explode(".",$arraySplit[6]);
					linkDataWithWorkspace($arraySplit[0], $arraySplit[2], $arraySplit[4], $arrayMeasureType[0], $newPath, $files[$x]);
				}
	
				mkdir($newPath, 0777, true);
				copy($oldPath,$newPath.'/'.$files[$x]);
				unlink($oldPath);
			}
		}
		else {
			echo "There are no new files.";
		}

	}
	function mySQLConnect(){
		$servername = "localhost";
		$username = "NoAngst";
		$password = "vVUTprUXD3KW4Van";

		// Create connection
		$conn = mysqli_connect($servername, $username, $password);
		return $conn;
	}
	
	function checkForWorkspace($workspace){
		$conn = mySQLConnect();
		$sqlSelect = "SELECT * FROM NoAngstV2.Workspace WHERE Name ='".$workspace."'";
		$sqlCount = "SELECT COUNT(*) as Sum FROM NoAngstV2.Workspace";

		$resultSelect = mysqli_query($conn, $sqlSelect);
		$resultCount = mysqli_query($conn, $sqlCount);
		$count = mysqli_fetch_assoc($resultCount);

		$sqlInsert = "INSERT INTO NoAngstV2.Workspace (ID, Name) VALUES (".strval(intval($count['Sum'])+1).",'".$workspace."')";
		
		if (mysqli_num_rows($resultSelect) > 0) {
			echo "Allready in there";	
		} 	
		else {
    			mysqli_query($conn, $sqlInsert);		
		}
		mysqli_close($conn);	
	}

	function linkDataWithWorkspace($workspace, $subject, $session, $measureType, $path, $fileName){
		$conn = mySQLConnect();
		
		$sqlSelectWorkspaceID = "SELECT ID as WorkspaceID From NoAngstV2.Workspace WHERE Name ='".$workspace."'";
		$sqlSelectMeasureTypeID = "SELECT ID as MeasureTypeID From NoAngstV2.MeasureType WHERE Name ='".$measureType."'";
		$sqlCountFileName = "SELECT COUNT(*) as Sum FROM NoAngstV2.Measurement WHERE FileName = '".$fileName."'";

		$resultSelect = mysqli_query($conn, $sqlSelectWorkspaceID);
		$resultWorkspace = mysqli_fetch_assoc($resultSelect);

		$resultSelect = mysqli_query($conn, $sqlSelectMeasureTypeID);
		$resultMeasureType = mysqli_fetch_assoc($resultSelect);

		$sqlInsertIntoLinkTable = "INSERT INTO NoAngstV2.Measurement (WorkspaceID, SubjectID, SessionID, MeasureTypeID, Path, FileName) VALUES (".$resultWorkspace['WorkspaceID'].", '".$subject."', '".$session."', ".$resultMeasureType['MeasureTypeID'].", '".$path."', '".$fileName."')";
		
		$resultCountFileName = mysqli_query($conn, $sqlCountFileName);
		$countFileName = mysqli_fetch_assoc($resultCountFileName);
		if(intval($countFileName['Sum']) === 0){
			mysqli_query($conn, $sqlInsertIntoLinkTable);
		}
	}

?>
