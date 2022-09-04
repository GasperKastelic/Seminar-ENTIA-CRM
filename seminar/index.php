<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Entia - Prijava</title>
		<link rel="stylesheet" type="text/css" href="css/stilprijava.css">
		<script src="JS/regUporabnika.js"></script>
		<script src="JS/prijava.js"></script>
		<script src="JS/oPrijavi.js"></script>
	</head>
    
	<body onload="oPrijavi()">
		<div class="hero">
			<div class="form-box">
				<div class="button-box">
					<div id="btn"></div>
						<button type="button" class="toggle-btn" onclick="login()">Prijava</button>
						<button type="button" class="toggle-btn" onclick="register()">Registracija</button>		
				</div>
				<form id="login" class="input-group" onsubmit="prijava(); return false">
					<input type="text" class="input-field" name="email_uporabnika" id="email_uporabnika" placeholder="Email" required>
					<input type="password" class="input-field" name="geslo_uporabnika" id="geslo_uporabnika" placeholder="Geslo" required>
					<button type="submit" class="submit-btn">Prijava</button>
				</form>
				
				<form id="register" class="input-group" onsubmit="regUporabnika(); return false">
					<input type="text" class="input-field" name="ime_uporabnika" placeholder="Ime" oninvalid="this.setCustomValidity('Vnesite vaše ime')" required/> <br>
					
					<input type="text" class="input-field" name="priimek_uporabnika" placeholder="Priimek" oninvalid="this.setCustomValidity('Vnesite vaš priimek')" required/> <br>
					
					<input type="password" class="input-field" name="geslo_uporabnika" placeholder="Geslo"  oninvalid="this.setCustomValidity('Vnesite vaše geslo')" required/> <br>
                    
					<select id="podruznica_uporabnika" class="input-field" name="podruznica_uporabnika" placeholder="Podružnica">
						<option value="Ljubljana">Ljubljana</option>
						<option value="Maribor">Maribor</option>
                        <option value="Koper">Koper</option>
						<option value="Kranj">Kranj</option>
					<select/><br>

					<input type="date" class="input-field" name="datum_rojstva" placeholder="Datum rojstva llll-mm-dd" oninvalid="this.setCustomValidity('Vnesite vaš datum rojstva')" required/> <br>
					
					<input type="text" class="input-field" name="telefon_uporabnika" placeholder="Telefonska številka 000-000-000" oninvalid="this.setCustomValidity('Vnesite vašo telefonsko številko')" required/> 
				
					<input type="email_uporabnika" class="input-field" name="email_uporabnika" placeholder="Email" oninvalid="this.setCustomValidity('Vnesite vaš elektronski naslov')" required/> <br>
									
					<button type="submit" class="submit-btn">Registracija</button>
				    <div id="odgovor"></div>
				</form>
                    <script>
		var x = document.getElementById("login");
		var y = document.getElementById("register");
		var z = document.getElementById("btn");
		function register(){
			x.style.left="-400px";
			y.style.left="50px";
			z.style.left="110px";
		}
		function login(){
			x.style.left="50px";
			y.style.left="450px";
			z.style.left="0px";
		}		
		</script>
			</div>
		</div>
	</body>
        
</html>