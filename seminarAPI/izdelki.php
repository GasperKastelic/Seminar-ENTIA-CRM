<?php
$DEBUG = true;							

include("orodja.php"); 					

$zbirka = dbConnect();					

header('Content-Type: application/json');	
header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Allow-Headers: Content-type, application/x-www-form-urlencoded, Accept, application/json");
header ("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header ("Access-Control-Allow-Headers: *");
$headers = apache_request_headers();	


if(isset($headers['Authorization'])) 
{
	$headers = trim($headers["Authorization"]);
	
	
	if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) 
	{
		 
		$sql = "SELECT * from uporabniki where token = '$matches[1]'";
		$result=mysqli_query($zbirka,$sql);
		$row=mysqli_fetch_array($result);
		if(mysqli_num_rows($result)>0)
		{
			foreach($result as $data){
				$id_uporabnika = $data['id_uporabnika'];
				$ime_uporabnika = $data['ime_uporabnika'];
				$priimek_uporabnika = $data['priimek_uporabnika'];
				$email_uporabnika = $data['email_uporabnika'];
				$datum_rojstva = $data['datum_rojstva'];
				$telefon_uporabnika = $data['telefon_uporabnika'];
				$podruznica_uporabnika = $data['podruznica_uporabnika'];
				$nivo_uporabnika = $data['nivo_uporabnika'];
				$geslo_uporabnika = $data['geslo_uporabnika'];
                $hashedPwd = password_hash($geslo_uporabnika, PASSWORD_DEFAULT);
			}
		}
		else
		{
			echo "Ni pravega žetona, ni pravih podatkov!";
			http_response_code(401);
		}
	}
	else{
		echo "Ni žetona, ni podatkov!";
		http_response_code(401);
	}
}
else{
	echo "Ni žetona, ni podatkov!";
	http_response_code(401);
}


switch($_SERVER["REQUEST_METHOD"])		
{
	case 'GET':
		if(!empty($_GET["ime_izdelka"]))
		{	
            podatkiIzdelka($_GET["ime_izdelka"]);	
		}
		else
		{
			vsiIzdelki();	
		}
		break;
       				
	case 'POST':
		dodajIzdelek();
		break;
		
	case 'PUT':
		if(!empty($_GET["ime_izdelka"]))              
		{
			posodobiIzdelek($_GET["ime_izdelka"]);   
		}
		else
		{
			http_response_code(400);	
		}
		break;
		
	case 'DELETE':
		if(!empty($_GET["ime_izdelka"]))
		{
			izbrisiIzdelek($_GET["ime_izdelka"]);
		}
		else
		{
			http_response_code(400);	
		}
		break;
		
	case 'OPTIONS':						
		http_response_code(204);
		break;                          
		
	default:
		http_response_code(405);		
		break;
}

mysqli_close($zbirka);					






function vsiIzdelki()
{
	global $zbirka;
	$odgovor=array(); 
	
	$poizvedba="SELECT ime_izdelka, ime_dobavitelja, podrocje_izdelka, nabavna_cena, prodajna_cena, zaloga_izdelka FROM izdelki ORDER BY zaloga_izdelka ASC";	
	
	$rezultat=mysqli_query($zbirka, $poizvedba);
	
	while($vrstica=mysqli_fetch_assoc($rezultat))
	{
		$odgovor[]=$vrstica;          
	}
	
	http_response_code(200);		
	echo json_encode($odgovor);     
}




function podatkiIzdelka($ime_izdelka)
{
	global $zbirka;    
	$ime_izdelka=mysqli_escape_string($zbirka, $ime_izdelka); 
	
	$poizvedba="SELECT id_izdelka, ime_izdelka, ime_dobavitelja, podrocje_izdelka, nabavna_cena, prodajna_cena, zaloga_izdelka FROM izdelki WHERE ime_izdelka='$ime_izdelka'";
	
	$rezultat=mysqli_query($zbirka, $poizvedba);

	if(mysqli_num_rows($rezultat)>0)	
	{
		$odgovor=mysqli_fetch_assoc($rezultat);
		
		http_response_code(200);		
		echo json_encode($odgovor);
	}
	else							
	{
		http_response_code(404);		
	}
}



function izdelkiDobavitelja($ime_dobavitelja)
{
	global $zbirka;    
    $odgovor=array();
	$ime_dobavitelja=mysqli_escape_string($zbirka, $ime_dobavitelja); 
	
	$poizvedba="SELECT id_izdelka, ime_izdelka, ime_dobavitelja, podrocje_izdelka, nabavna_cena, prodajna_cena, zaloga_izdelka FROM izdelki WHERE ime_dobavitelja='$ime_dobavitelja'";
	
	$rezultat=mysqli_query($zbirka, $poizvedba);

	while($vrstica=mysqli_fetch_assoc($rezultat))
	{
		$odgovor[]=$vrstica;          
	}
	
	http_response_code(200);		
	echo json_encode($odgovor);     
}



function dodajIzdelek()
{
	global $zbirka, $DEBUG;
	
	$podatki = json_decode(file_get_contents('php://input'), true);
	
	if(isset($podatki["ime_izdelka"], $podatki["ime_dobavitelja"], $podatki["podrocje_izdelka"], $podatki["nabavna_cena"], $podatki["prodajna_cena"], $podatki["zaloga_izdelka"]))
	{
		if(!izdelek_obstaja($podatki["ime_izdelka"]))	
		{
			$ime_izdelka = mysqli_escape_string($zbirka, $podatki["ime_izdelka"]);
            $ime_dobavitelja = mysqli_escape_string($zbirka, $podatki["ime_dobavitelja"]);
			$podrocje_izdelka = mysqli_escape_string($zbirka, $podatki["podrocje_izdelka"]);
            $nabavna_cena = mysqli_escape_string($zbirka, $podatki["nabavna_cena"]);
            $prodajna_cena = mysqli_escape_string($zbirka, $podatki["prodajna_cena"]);
            $zaloga_izdelka = mysqli_escape_string($zbirka, $podatki["zaloga_izdelka"]);
			
				
			$poizvedba="INSERT INTO izdelki (ime_izdelka, ime_dobavitelja, podrocje_izdelka, nabavna_cena, prodajna_cena, zaloga_izdelka) VALUES ('$ime_izdelka', '$ime_dobavitelja', '$podrocje_izdelka', '$nabavna_cena', '$prodajna_cena', '$zaloga_izdelka')";
			
			if(mysqli_query($zbirka, $poizvedba))
			{
				http_response_code(201);	
			}
			else
			{
				http_response_code(500);	

				if($DEBUG)	
				{
					pripravi_odgovor_napaka(mysqli_error($zbirka));
				}
			}
		}
		
		else
		{
			http_response_code(409);	
			pripravi_odgovor_napaka("Izdelek že obstaja!");
		}
	}
	else
	{
		http_response_code(400);	
	}
}



function posodobiIzdelek($ime_izdelka)
{
	global $zbirka, $DEBUG;
	
	$ime_izdelka = mysqli_escape_string($zbirka, $ime_izdelka);
	
	$podatki = json_decode(file_get_contents("php://input"),true);
		
	if(izdelek_obstaja($ime_izdelka))
	{
		if(isset($podatki["ime_dobavitelja"], $podatki["podrocje_izdelka"], $podatki["nabavna_cena"], $podatki["prodajna_cena"], $podatki["zaloga_izdelka"]))
		{
			
            $ime_dobavitelja = mysqli_escape_string($zbirka, $podatki["ime_dobavitelja"]);
            $podrocje_izdelka = mysqli_escape_string($zbirka, $podatki["podrocje_izdelka"]);
			$nabavna_cena = mysqli_escape_string($zbirka, $podatki["nabavna_cena"]);
            $prodajna_cena = mysqli_escape_string($zbirka, $podatki["prodajna_cena"]);
			$zaloga_izdelka = mysqli_escape_string($zbirka, $podatki["zaloga_izdelka"]);
			
			$poizvedba = "UPDATE izdelki SET ime_dobavitelja='$ime_dobavitelja', podrocje_izdelka='$podrocje_izdelka', nabavna_cena='$nabavna_cena', prodajna_cena='$prodajna_cena', zaloga_izdelka='$zaloga_izdelka' WHERE ime_izdelka='$ime_izdelka'"; 
			
			if(mysqli_query($zbirka, $poizvedba))
			{
				http_response_code(204);	
			}
			else
			{
				http_response_code(500);	
				
				if($DEBUG)	
				{
					pripravi_odgovor_napaka(mysqli_error($zbirka));
				}
			}
		}
		else
		{
			http_response_code(400);	
		}
	}
	else
	{
		http_response_code(404);	
	}
}



function izbrisiIzdelek($ime_izdelka)
{	
	global $zbirka, $DEBUG;
	$vzdevek=mysqli_escape_string($zbirka, $ime_izdelka);

	if(izdelek_obstaja($ime_izdelka))
	{
		$poizvedba="DELETE FROM izdelki WHERE ime_izdelka='$ime_izdelka'";
		
		if(mysqli_query($zbirka, $poizvedba))
		{
			http_response_code(204);	
		}
		else
		{
			http_response_code(500);	
			
			if($DEBUG)	
			{
				pripravi_odgovor_napaka(mysqli_error($zbirka));
			}
		}
	}
	else
	{
		http_response_code(404);	
	}
}
?>



