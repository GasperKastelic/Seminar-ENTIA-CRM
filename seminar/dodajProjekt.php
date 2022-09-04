<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Projekti - vpis projekta</title>
		<link rel="stylesheet" type="text/css" href="css/stil.css" />
		<script src="JS/dodajProjekt.js"></script>
        <script src="JS/prevPrijavoA.js"></script>
	</head>
	<body onload="prevPrijavoA()">
		<div class="center">
            <?php include "adminMeni.html"?>
			<br/><br/>
		
			<form id="obrazec" onsubmit="dodajProjekt(); return false;">
				<label for="ime_projekta">Projekt:</label><br>
				<input type="text" name="ime_projekta" placeholder="Vpiši naziv projekta" required/> <br>
				
				<label for="tip_projekta">Tip projekta:</label>
                <select id="tip_projekta" name="tip_projekta">
                    <option value="Stanovanje">Stanovanjska enota</option>
                    <option value="Hiša">Stanovanjska hiša</option>
                    <option value="Večstanovanjski objekt">Večstanovanjski objekt</option>
                    <option value="Poslovni objekt">Poslovni objekt</option>
                </select><br/>
				<label for="id_stranke">Stranka:</label>
				<input type="text" name="id_stranke" placeholder="Vpiši ID stranke" required /><br/>
				
				<label for="id_uporabnika">Vodja:</label>
				<input type="text" name="id_uporabnika" placeholder="Vpiši ID vodje" required /><br/>	
                
                <label for="zacetek_projekta">Začetek projekta:</label>
				<input type="text" name="zacetek_projekta" placeholder="Vpiši predvideni datum začetka projekta, npr. 2022/10/01" required /><br/>	
                
                <label for="zakljucek_projekta">Zaključek projekta:</label>
				<input type="text" name="zakljucek_projekta" placeholder="Vpiši predvideni datum zaključka projekta, npr. 2022/10/01" required /><br/>	

				<input type="submit" value="Vpiši" />
			</form>
			<div id="odgovor"></div>
		</div>
	</body>
    
</html>












