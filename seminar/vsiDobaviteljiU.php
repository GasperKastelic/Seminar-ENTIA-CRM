<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Dobavitelji - vsi dobavitelji</title>
		<link rel="stylesheet" type="text/css" href="css/stil.css" />
        <script src="JS/vsiDobavitelji.js"></script>
        <script src="JS/prevPrijavoU.js"></script>
	</head>
    
    
	<body onload="vsiDobavitelji(); prevPrijavoU();">
		<div class="center">
            <?php include "Meni.html"?>
			<table id="tabela1">
				<tr>
					<th>Dobavitelj</th>
                    <th>Naslov</th>
					<th>Email</th>
					<th>Telefon</th>
				</tr>
			</table>
			<div id="odgovor"></div>
		</div>
	</body>
    
</html>