<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Vodje - izbris vodje</title>
		<link rel="stylesheet" type="text/css" href="css/stil.css" />
		<script src="JS/uporabnik.js"></script>
		<script src="JS/prevPrijavoA.js"></script>
	</head>
    
	<body onload="prevPrijavoA();">
		<div class="center">
			<?php include "adminMeni.html"?>
			
			<form onsubmit="podatkiUporabnika(); return false;" id="obrazec">
				
				<input type="text" name="id_uporabnika" placeholder="Vpiši ID uporabnika oz. vodje" required />
				<input type="submit" value="Prikaži" />
			</form>
			<br/>
			<form id="posodobitev" onsubmit="posodobiPodatke(); return false;" style="display: none">
				<label for="geslo_uporabnika">Geslo:
				<input type="password" name="geslo_uporabnika" required /></label><br/>

				<label for="ime_uporabnika">Ime:
				<input type="text" name="ime_uporabnika" required /></label><br/>
				
				<label for="priimek_uporabnika">Priimek:
				<input type="text" name="priimek_uporabnika" required /></label><br/>	

				<label for="datum_rojstva">Datum rojstva:
				<input type="date" name="datum_rojstva" required /></label><br/>
                
                <label for="podruznica_uporabnika">Podružnica:
				<input type="text" name="podruznica_uporabnika" required /></label><br/>				
				
				<label for="telefon_uporabnika">Telefonska stevilka:
				<input type="text" name="telefon_uporabnika" required /></label><br/>

				<label for="email_uporabnika">E-mail:
				<input type="text" name="email_uporabnika" required /></label><br/>	

				<label for="nivo_uporabnika">Nivo uporabnika:
				<input type="number" name="nivo_uporabnika" min="0" max="1" required /></label><br/>		
				
				<input type="submit" value="Posodobi" />
			</form>
			<br/>
			<div id="odgovor"></div>
			<br/>
			<form onsubmit="izbrisiUporabnika(); return false;">
				<input type="submit" value="Izbriši" style="background-color: #FF6347;" />
			</form>
			
		</div>
	</body>
    
</html>