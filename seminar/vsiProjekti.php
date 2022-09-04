<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Projekti - vsi projekti</title>
		<link rel="stylesheet" type="text/css" href="css/stil.css" />
        <script src="JS/vsiProjekti.js"></script>
        <script src="JS/prevPrijavoA.js"></script>
        <script>
			function start(){
				vsiProjekti();
				prevPrijavoA();
			}
		</script>
	</head>
    
	<body onload="start();">
		<div class="center">
            <?php include "adminMeni.html"?>
			
			<table id="tabela1">
				<tr>
                    <th>Id projekta</th>
					<th>Projekt</th>
                    <th>Tip projekta</th>
					<th>Stranka</th>
					<th>Vodja</th>
                    <th>Začetek projekta</th>
					<th>Zaključek projekta</th>
				</tr>
			</table>
			<div id="odgovor"></div>
		</div>
	</body>
    
</html>