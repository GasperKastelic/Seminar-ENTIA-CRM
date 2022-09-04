<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Izdelki - vsi izdelki</title>
		<link rel="stylesheet" type="text/css" href="css/stil.css" />
        <script src="JS/vsiIzdelki.js"></script>
        <script src="JS/prevPrijavoA.js"></script>
	</head>
    
	<body onload="vsiIzdelki(); prevPrijavoA(); ">
		<div class="center">
            <?php include "adminMeni.html"?>
			<table id="tabela1">
				<tr>
                    <th>Ime izdelka</th>
                    <th>Ime dobavitelja</th>
                    <th>Področje izdelka</th>
					<th>Nabavna cena (€)</th>
					<th>Prodajna cena (€)</th>
                    <th>Zaloga izdelka</th>
				</tr>
            </table>
			<div id="odgovor"></div>
		</div>
	</body>
    
</html>