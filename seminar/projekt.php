<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Projekti - podatki projekta</title>
		<link rel="stylesheet" type="text/css" href="css/stil.css" />
        <script src="JS/projekt.js"></script>
        <script src="JS/prevPrijavoU.js"></script>
        <script>
			function start(){
				projektiUporabnika();
				prevPrijavoU();
			}
		</script>
	</head>
    
	<body onload="start()">
		<div class="center">
            <?php include "Meni.html"?>
			
	<table id="tabela1">
        <div id="prikaz"></div>
				<tr>
                    <th>Id projekta</th>
					<th>Projekt</th>
                    <th>Tip projekta</th>
					<th>Stranka</th>
                    <th>Začetek projekta</th>
					<th>Zaključek projekta</th>
				</tr>
			</table>

			<div id="odgovor"></div>
		</div>
	</body>
    
</html>