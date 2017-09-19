<html>

    <head>

	<meta charset="utf-8"/>
        <script type="text/javascript" src="scripts.js"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">

    </head>

    <body>

       	 <?php

		$servername = "localhost";
		$username = "NoAngst";
		$password = "vVUTprUXD3KW4Van";

		// Create connection
		$conn = mysqli_connect($servername, $username, $password);

		// Check connection
		if (!$conn) {
    			die("Connection failed: " . mysqli_connect_error());
		}
		echo "Connected successfully";

        ?>

        <div class="container">

            <div class="header">

            Header

            </div>

            <div class="mainbody">

                <div class="left">

                    <button onclick="uploadCSVs"()>Daten eintragen</button>
                    <br>
                    <button onclick="setWorkspaceDropdown()">Workspace Auswählen</button>
                    <br>
                    <select name="workspace" id="D1"></select>


                </div>

                <div class="right">

                    Diagramme und Stuff

                </div>

            </div>

          </div>

    </body>

</html>
