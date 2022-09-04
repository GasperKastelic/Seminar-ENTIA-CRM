<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Izdelki - podatki izdelka</title>
		<link rel="stylesheet" type="text/css" href="css/stil.css" />
        <script src="JS/izdelek.js"></script>
        <script src="JS/prevPrijavoA.js"></script>
	</head>
    
	<body onload="prevPrijavoA()"> 
		<div class="center">
            <?php include "adminMeni.html"?>
			
			<form onsubmit="podatkiIzdelka(); return false;" id="obrazec">
				
				<input type="text" name="ime_izdelka" placeholder="Vpiši ime izdelka" required />
				<input type="submit" value="Prikaži" />
			</form>
            <br/>
            
            <form onsubmit="izbrisiIzdelek(); return false;" id="obrazec">
				<input type="submit" value="Izbriši" style="background-color: #FF6347;"/>
			</form>
            <br/>
            
            <form id="posodobitev" onsubmit="posodobiPodatke(); return false;" style="display: none">
				
                <label for="ime_dobavitelja">Ime dobavitelja:</label>
				<input type="text" name="ime_dobavitelja" required /><br/>
                
                <label for="podrocje_izdelka">Podrocje izdelka:</label>
				<input type="text" name="podrocje_izdelka" required /><br/>

				<label for="nabavna_cena">Nabavna cena (€)</label>
				<input type="text" name="nabavna_cena" required /><br/>
				
				<label for="prodajna_cena">Prodajna cena:</label>
				<input type="text" name="prodajna_cena" required /><br/>	
                
                <label for="zaloga_izdelka">Zaloga izdelka:</label>
				<input type="text" name="zaloga_izdelka" required /><br/>	

                <input type="submit" value="Posodobi" />
			</form>
			
			<div id="odgovor"></div>
		</div>
	</body>
    
</html>