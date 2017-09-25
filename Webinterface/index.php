<html>
    <head>
	<meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="test.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    </head>

    <body>

	<form id="sepp" method="post">
		
        <div class="container">

            <div class="header">
            </div>

            <div class="mainbody">
                <div class="left">
			<label><b>Existing Workspaces:</b></label>
                    </br>
                    <select id="Workspace" onchange="getSubjects()">
			<option selected>Please select a Workspace</option>
			<?php
				include 'CreateDir.php';
				$conn = mySQLConnect();
				$sqlSelectWorkspace = "SELECT * FROM NoAngstV2.Workspace";
				$resultSelect = mysqli_query($conn, $sqlSelectWorkspace);
				while($row = mysqli_fetch_assoc($resultSelect)){
					echo "<option>".$row['Name']."</option>";
				}
			?>
			</select>
			</br></br>
			<label><b>Subjects:</b></label></br>
			<select id="Subjects"></select>
			</br></br>
			<label><b>Session:</b></label></br>
			<select id="Session"></select>
			</br></br>
			<label><b>Files:</b></label></br>
			<select id="Files"></select>
			</br>
			</br>
		 <button onclick="window.open('http://pcps00018.uni-regensburg.de/upload.html', 'File Upload', '_blank', 'width=500,heigth=300')"> Daten Hochladen</button>


                </div>

                <div class="right">
                    Diagramme und Stuff
                </div>

            </div>

          </div>
		
	</form>
    </body>

<script type='text/javascript'>
    function getSubjects() {
          $.ajax({
            url:"getWorkspaceInfo.php",
type: "POST",
dataType: 'json',
data: {workspace: $("#Workspace").val()},
success: function(data){hallo(data);},

});
}

function hallo(data){
	var sel = document.getElementById("Subjects");
	$("#Subjects").empty();
	for(var i = 0; i < data.length; i++) {
    	var opt = document.createElement('option');
    	opt.innerHTML = data[i];
    	opt.value = data[i];
    	sel.appendChild(opt);
	}
}
</script>
 

</html>

