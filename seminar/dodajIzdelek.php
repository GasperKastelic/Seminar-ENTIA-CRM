<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Izdelki - vpis izdelka</title>
		<link rel="stylesheet" type="text/css" href="css/stil.css" />
		<script src="JS/dodajIzdelek.js"></script>
        <script src="JS/prevPrijavoA.js"></script>
	</head>
    
    
	<body onload="prevPrijavoA()">
		<div class="center">
            <?php include "adminMeni.html"?>
            <br/><br/>
			<form id="obrazec" onsubmit="dodajIzdelek(); return false;">
                
                <label for="ime_izdelka">Ime izdelka:</label>
				<input type="text" name="ime_izdelka" placeholder="Vpiši ime izdelka" required /><br/>
                
                <label for="ime_dobavitelja">Ime dobavitelja:</label>
				<input type="text" name="ime_dobavitelja" placeholder="Vpiši ime dobavitelja" required /><br/>
                
                <label for="podrocje_izdelka">Podrocje izdelka:</label><br/>
                    <select id="podrocje_izdelka" name="podrocje_izdelka">
                        <option value="Pametni dom">Pametni dom</option>
                        <option value="Alarmni sistem">Alarmni sistem</option>
                        <option value="Videonadzor">Videonadzor</option>
                        <option value="Domofonski sistemr">Domofonski sistem</option>
                    </select><br/>

				<label for="nabavna_cena">Nabavna cena:</label>
				<input type="text" name="nabavna_cena"  placeholder="Vpiši nabavno ceno izdelka" required /><br/>
				
				<label for="prodajna_cena">Prodajna cena:</label>
				<input type="text" name="prodajna_cena"  placeholder="Vpiši prodajno ceno izdelka" required /><br/>	
                
                <label for="zaloga_izdelka">Zaloga izdelka:</label>
				<input type="text" name="zaloga_izdelka" placeholder="Vpiši zalogo izdelka" required /><br/>	
				
				<input type="submit" value="Vpiši" />
			</form>
            
			<div id="odgovor"></div>
		</div>
	</body>
    
</html>












