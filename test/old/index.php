<html>
	<meta name=viewport content="width=device-width, initial-scale=1">
	<head>
		<?php $file ='data.php'; ?>
		<title>YABOOOOO '18</title>
		<script type="text/javascript" src="js/clock.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
		<script>
			var xmlhttp;
		
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			function update() {
				 	xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							document.getElementById("content").innerHTML = xmlhttp.responseText;
						}
					};
					xmlhttp.open("GET",<?php echo " '" . $file . "'"; ?>, true);
					xmlhttp.send();
			}
			
			var dead = new Date("2018-03-29T12:40:00");
			var finalDay = new Date("2018-09-30T23:59:59");
			var now = new Date();

			if (now > dead && now < finalDay) {
				setInterval(update, 750);
			}
			else {
				update();
			}
			
			function showUser(str) {
				if (str == "") {
					document.getElementById("txtHint").innerHTML = "";
					return;
				} else { 
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
						}
					};
					
					xmlhttp.open("GET","passDisplay.php?q="+str,true);
					xmlhttp.send();
				}
			}
		</script>
	</head>
	<body onload="updateClock(); setInterval('updateClock()', 1000 )">
    <?php	
		include_once("connect.php");
			
		$deadline = new DateTime('2018-03-29T12:40:00', new DateTimeZone('America/New_York'));
	?>		
	<style>
		html {
			height: 100%;
			width: 100%;
			font-family: 'Roboto', san-serif;
		}
		table {
			border-radius: 5px;
		}
		password {
			border-radius: 5px;
		}
		h3 {
			padding: 0px;
			margin: 0px;
		}
		body {
			<?php 
				if (new DateTime() > $deadline) {
					$sql = "select color, font from standings order by homeRuns desc, name limit 1";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo "background-color: ".$row['color']. ";";
							/*if ($row['font'] == 1) {
								echo "color: white;";
							}
							 else if ($row['font'] == 2) {
								echo "color: yellow;";
							}*/
						}
					}
				}
				else {
					echo "background-color: white;";
				}
			?>
		}
		#picks {
			border-style: 6px;
			border-color: #ff0000;
		}
		a {
			text-decoration: none;
		}
		a:hover {
			text-decoration: underline;
		}
		* { 
			font-size: 14px;
			text-align: center;
		}
		table {
			vertical-align: center;
		}
		td {
			vertical-align: top;
		}
		#dark {
			color: white;
		}
		#yellow {
			color:yellow;
		}
		#red {
			color: red;
		}
		#total {
			outline: thin solid black; 
		}
		#wrap { 
			width: 1335px;
			margin: 0 auto;
		}
		#wid {
			width: "10";
		}
		#nav {
			border-radius: 5px;
			width: 1335px;
			float: left;
			margin: auto;
			padding: 0;
			background-color: #f2f2f2;
			border-bottom: 1px solid #ccc;  }
		#nav ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
			overflow: hidden;
			background-color: #333;
		}
		#nav li {
			float: left;
		}
		#nav li a {
			display: block;
			color: white;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
		}
		/* Change the link color to #111 (black) on hover */
		#nav li a:hover {
			background-color: #111;
		}
		#nav.active {
			background-color: #4CAF50;
		}
		password {
			border: 1 thin;
			border-radius: 5px;
		}
	</style>

	<div id="wrap">
		<div id="nav">
			<ul>
				<li><a href="/2015">2015</a></li>		
				<li><a href="/2016">2016</a></li>	
				<li><a href="/2017">2017</a></li>
				<?php
					if (new DateTime() > $deadline) {
						echo '<li><a href="/picks">Picks</a></li>';
					}
				?>					
				<li><a href="http://espn.go.com" target="_blank"><img src="img/espn.png" alt="espnLogo" style="width:100px;height:19px;"></a></li>		
				<li><a href="http://mlb.mlb.com" target="_blank"><img src="img/mlb.png" alt="mlbLogo" style="width:100px;height:19px;"></a></li>
				<li style="float:right"><a id="click">
				<?php 
					date_default_timezone_set("America/New_York");
					$date = date("F j, Y");
					echo $date;
				?>
				</a></li>
				<li style= "float:right"><a id="click"><div><span id="clock">&nbsp;</span></div></a></li>
			</ul>
		</div>
		<?php
			if (new DateTime() < $deadline) {
				echo '<h1>TEAMS LOCK MARCH 29, 2018 AT 12:40 PM</h1>';
			}
			else {
				$sql = "select color, font from standings order by homeRuns desc, name limit 1";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							if ($row['font'] == 1) {
								echo '<h1 style="font-size: 45; margin-bottom: 0; padding-bottom: 0; color: white;">2018</h1>';
							}
							 else if ($row['font'] == 2) {
								echo '<h1 style="font-size: 45; margin-bottom: 0; padding-bottom: 0; color: yellow;">2018</h1>';
							} else if ($row['font'] == 3) {
								echo '<h1 style="font-size: 45; margin-bottom: 0; padding-bottom: 0; color: red;">2018</h1>';
							} else {
								echo '<h1 style="font-size: 45; margin-bottom: 0; padding-bottom: 0;">2018</h1>';
							}
						}
					}
			}
		?>
		<div id="content"> Loading... </div>	
	</div>
	
	</body>
</html>