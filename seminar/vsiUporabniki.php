<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Vodje - vse vodje</title>
		<link rel="stylesheet" type="text/css" href="css/stil.css" />
		<script src="JS/uporabnik.js"></script>
		<script src="JS/prevPrijavoA.js"></script>
		<script>
			function start(){
				vsiUporabniki();
				prevPrijavoA();
			}
		</script>
	</head>
    
	<body onload="start();">
		<div class="center">
			<?php include "adminMeni.html"?>
			<div id="prikaz"></div>
			
			<table id="tabela1">
				<tr>
					<th>ID</th>
					<th>Ime</th>
					<th>Priimek</th>
                    <th>Podružnica</th>
					<th>Datum rojstva</th>
					<th>Telefonska številka</th>
					<th>Email</th>
					<th>Nivo</th>
				</tr>
			</table>
			<div id="odgovor"></div>
		</div>
	</body>
    
</html>