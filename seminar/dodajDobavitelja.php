<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Dobavitelji - vpis dobavitelja</title>
		<link rel="stylesheet" type="text/css" href="css/stil.css" />
		<script src="JS/dodajDobavitelja.js"></script>
        <script src="JS/prevPrijavoA.js"></script>
	</head>
	<body onload="prevPrijavoA()">
        
		<div class="center">
            <?php include "adminMeni.html"?>
			<br>
		
			<form id="obrazec" onsubmit="dodajDobavitelja(); return false;">
                <br><br>
				<label for="ime_dobavitelja">Dobavitelj:</label><br>
				<input type="text" name="ime_dobavitelja" placeholder="Vpiši ime dobavitelja" required/> <br>
				
				<label for="naslov_dobavitelja">Naslov:</label><br>
				<input type="text" name="naslov_dobavitelja" placeholder="Vpiši naslov dobavitelja" required/> <br>
				
				<label for="email_dobavitelja">Email:</label><br>
				<input type="text" name="email_dobavitelja" placeholder="Vpiši email dobavitelja" required/> <br>

				<label for="telefon_dobavitelja">Kontakt:</label><br>
				<input type="text" name="telefon_dobavitelja" placeholder="Vpiši telefonsko številko" required/> <br>
				
				<input type="submit" value="Vpiši" />
			</form>
			<div id="odgovor"></div>
		</div>
	</body>
    
</html>












