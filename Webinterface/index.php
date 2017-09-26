<html>

    <head>

	<meta charset="utf-8"/>


  <style> /* set the CSS */

  body { font: 12px Arial;}

  path {
      stroke: steelblue;
      stroke-width: 2;
      fill: none;
  }

  .axis path,
  .axis line {
      fill: none;
      stroke: grey;
      stroke-width: 1;
      shape-rendering: crispEdges;
  }

  </style>



        <script type="text/javascript" src="scripts.js"></script>
        <link rel="stylesheet" type="text/css" href="styles.css">

        <script src="http://d3js.org/d3.v3.min.js"></script>

</head>

    <body>


        <div class="container">

            <div class="header">

            Header

            </div>

            <div class="mainbody">

                <div class="left">

                    <button onclick="window.open('http://pcps00018.uni-regensburg.de/upload.html', 'File Upload', '_blank', 'width=500,heigth=300')"> Daten Hochladen</button>
                    <br>
                    <button onclick="setWorkspaceDropdown()">Workspace Auswählen</button>
                    <br>
                    <select name="workspace" id="D1"></select>
		<br>
                    <button onclick="drawChart()">Diagram zeichenen</button>

                </div>

                <div class="right" id="chart">


                </div>

            </div>

          </div>

    </body>


<script>

function drawChart() {

 // Set the dimensions of the canvas / graph
var margin = {top: 30, right: 20, bottom: 30, left: 50},
    width = 1100 - margin.left - margin.right,
    height = 600 - margin.top - margin.bottom;

// Parse the date / time
var parseDate = d3.time.format("%Y-%m-%d %H:%M:%S:%L").parse;

// Set the ranges
var x = d3.time.scale().range([0, width]);
var y = d3.scale.linear().range([height, 0]);

// Define the axes
var xAxis = d3.svg.axis().scale(x)
    .orient("bottom").ticks(5);

var yAxis = d3.svg.axis().scale(y)
    .orient("left").ticks(5);

// Define the line
var valueline = d3.svg.line()
    .x(function(d) { return x(d.Timestamp); })
    .y(function(d) { return y(d["Heart Rate"]); });

// Adds the svg canvas
var svg = d3.select("#chart")
    .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
    .append("g")
        .attr("transform",
              "translate(" + margin.left + "," + margin.top + ")");

// Get the data
d3.csv("Test.csv", function(error, data) {
    data.forEach(function(d) {
        d.Timestamp = parseDate(d.Timestamp);
        d["Heart Rate"] = +d["Heart Rate"];
    });

    // Scale the range of the data
    x.domain(d3.extent(data, function(d) { return d.Timestamp; }));
    y.domain([0, d3.max(data, function(d) { return d["Heart Rate"]; })]);

    // Add the valueline path.
    svg.append("path")
        .attr("class", "line")
        .attr("d", valueline(data));

    // Add the X Axis
    svg.append("g")
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis);

    // Add the Y Axis
    svg.append("g")
        .attr("class", "y axis")
        .call(yAxis);

});

}

</script>


</html>
