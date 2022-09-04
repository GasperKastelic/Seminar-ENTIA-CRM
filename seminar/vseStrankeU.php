<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Stranke - vse stranke</title>
		<link rel="stylesheet" type="text/css" href="css/stil.css" />
        <script src="JS/vseStranke.js"></script>
        <script src="JS/prevPrijavoU.js"></script>
        
	</head>
    
	<body onload="vseStranke(); prevPrijavoU();">
		<div class="center">
            <?php include "Meni.html"?>
			
			<table id="tabela1">
				<tr>
                    <th>ID stranke</th>
					<th>Stranka</th>
                    <th>Tip</th>
                    <th>Naslov</th>
					<th>Email</th>
					<th>Telefon</th>
				</tr>
			</table>
			<div id="odgovor"></div>
		</div>
	</body>
</html>