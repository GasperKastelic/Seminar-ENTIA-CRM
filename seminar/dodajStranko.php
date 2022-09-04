<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Stranke - vpis stranke</title>
		<link rel="stylesheet" type="text/css" href="css/stil.css" />
		<script src="JS/dodajStranko.js"></script>
        <script src="JS/prevPrijavoA.js"></script>
	</head>
    
	<body onload="prevPrijavoA()">
		<div class="center">
            <?php include "adminMeni.html"?>
			
			<form id="obrazec" onsubmit="dodajStranko(); return false;">
				
				<label for="naziv_stranke">Ime in priimek:</label><br>
				<input type="text" name="naziv_stranke" placeholder="Vpiši ime in priimek stranke"  required/> <br>
                
                <label for="tip_stranke">Tip stranke:</label><br/>
                <select id="tip_stranke" name="tip_stranke">
                    <option value="Fizična oseba">Fizična oseba</option>
                    <option value="Pravna oseba">Pravna oseba</option>
                </select><br/>
                
                <label for="naslov_stranke">Naslov:</label><br>
				<input type="text" name="naslov_stranke" placeholder="Vpiši naslov stranke" required/> <br>
				
				<label for="email_stranke">Email:</label><br>
				<input type="text" name="email_stranke" placeholder="Vpiši email stranke"  required/> <br>

				<label for="telefon_stranke">Telefon:</label><br>
				<input type="text" name="telefon_stranke" placeholder="Vpiši telefonsko številko stranke"  required/> <br>
				
				<input type="submit" value="Vpiši" />
			</form>
			<div id="odgovor"></div>
		</div>
	</body>
    
</html>












