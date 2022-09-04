<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Dobavitelji - podatki dobavitelja</title>
		<link rel="stylesheet" type="text/css" href="css/stil.css" />
        <script src="JS/dobavitelj.js"></script>
        <script src="JS/prevPrijavoA.js"></script>
	</head>
    
	<body onload="prevPrijavoA()">
		<div class="center">
            <?php include "adminMeni.html"?>
            <form onsubmit="podatkiDobavitelja(); return false;" id="obrazec">
				<input type="text" name="ime_dobavitelja" placeholder="Vpiši ime dobavitelja" required />
				<input type="submit" value="Prikaži"/>
			</form>
            <br/>
            <form onsubmit="izbrisiDobavitelja(); return false;" id="obrazec">
				<input type="submit" value="Izbriši" style="background-color: #FF6347;" />
			</form>
            <br/>
            <form id="posodobitev" onsubmit="posodobiPodatke(); return false;" style="display: none">
				<label for="naslov_dobavitelja">Naslov:</label>
				<input type="text" name="naslov_dobavitelja" required /><br/>

				<label for="email_dobavitelja">Email:</label>
				<input type="text" name="email_dobavitelja" required /><br/>
				
				<label for="telefon_dobavitelja">Telefon:</label>
				<input type="text" name="telefon_dobavitelja" required /><br/>	

                <input type="submit" value="Posodobi" />
			</form>

			<div id="odgovor"></div>
		</div>
	</body>
    
</html>
