<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Stranke - podatki stranke</title>
		<link rel="stylesheet" type="text/css" href="css/stil.css" />
        <script src="JS/stranka.js"></script>
        <script src="JS/prevPrijavoA.js"></script>

	</head>
    
	<body onload="prevPrijavoA()">
		<div class="center">
            <?php include "adminMeni.html"?>
			
			<form onsubmit="podatkiStranke(); return false;" id="obrazec">
				<input type="text" name="naziv_stranke" placeholder="Vpiši naziv stranke" required />
				<input type="submit" value="Prikaži" />
			</form>
            <br/>
            <form onsubmit="izbrisiStranko(); return false;" id="obrazec">
				<input type="submit" value="Izbriši"  style="background-color: #FF6347;"/>
			</form>
            <br/>
            <form id="posodobitev" onsubmit="posodobiPodatke(); return false;" style="display: none">
				<label for="tip_stranke">Tip stranke:</label><br/>
                <select id="tip_stranke" name="tip_stranke">
                    <option value="Fizična oseba">Fizična oseba</option>
                    <option value="Pravna oseba">Pravna oseba</option>
                </select><br/>
                
                <label for="naslov_stranke">Naslov:</label>
				<input type="text" name="naslov_stranke" required /><br/>

				<label for="email_stranke">Email:</label>
				<input type="text" name="email_stranke" required /><br/>
				
				<label for="telefon_stranke">Telefon:</label>
				<input type="text" name="telefon_stranke" required /><br/>	

                <input type="submit" value="Posodobi" />
			</form>
			<div id="odgovor"></div>
		</div>
	</body>
    
</html>