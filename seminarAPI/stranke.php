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
		if(!empty($_GET["naziv_stranke"]))
		{
			podatkiStranke($_GET["naziv_stranke"]);		
		}
		else
		{
			vseStranke();					
		}
		break;
		
	case 'POST':
		dodajStranko();
		break;
		
	case 'PUT':
		if(!empty($_GET["naziv_stranke"]))              
		{
			posodobiStranko($_GET["naziv_stranke"]);   
		}
		else
		{
			http_response_code(400);	
		}
		break;
		
	case 'DELETE':
		if(!empty($_GET["naziv_stranke"]))
		{
			izbrisiStranko($_GET["naziv_stranke"]);
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






function vseStranke()
{
	global $zbirka;
	$odgovor=array(); 
	
	$poizvedba="SELECT id_stranke, naziv_stranke, tip_stranke, naslov_stranke, email_stranke, telefon_stranke FROM stranke ORDER BY naziv_stranke";	
	
	$rezultat=mysqli_query($zbirka, $poizvedba);
	
	while($vrstica=mysqli_fetch_assoc($rezultat))
	{
		$odgovor[]=$vrstica;          
	}
	
	http_response_code(200);		
	echo json_encode($odgovor);     
}



function podatkiStranke($naziv_stranke)
{
	global $zbirka;    
	$naziv_stranke=mysqli_escape_string($zbirka, $naziv_stranke); 
	
	$poizvedba="SELECT tip_stranke, naslov_stranke, email_stranke, telefon_stranke FROM stranke WHERE naziv_stranke='$naziv_stranke'";
	
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



function dodajStranko()
{
	global $zbirka, $DEBUG;   
	
	$podatki = json_decode(file_get_contents('php://input'), true); 
	
	if(isset($podatki["naziv_stranke"], $podatki["tip_stranke"], $podatki["naslov_stranke"], $podatki["email_stranke"], $podatki["telefon_stranke"]))  
	{
		$naziv_stranke = mysqli_escape_string($zbirka, $podatki["naziv_stranke"]);  
		$tip_stranke = mysqli_escape_string($zbirka, $podatki["tip_stranke"]);
		$naslov_stranke = mysqli_escape_string($zbirka, $podatki["naslov_stranke"]);
		$email_stranke = mysqli_escape_string($zbirka, $podatki["email_stranke"]);
        $telefon_stranke = mysqli_escape_string($zbirka, $podatki["telefon_stranke"]);
			
		if(!stranka_obstaja($naziv_stranke)) 
		{	
			$poizvedba="INSERT INTO stranke (naziv_stranke, tip_stranke, naslov_stranke, email_stranke, telefon_stranke) VALUES ('$naziv_stranke', '$tip_stranke', '$naslov_stranke', '$email_stranke', '$telefon_stranke')";
			
			if(mysqli_query($zbirka, $poizvedba))
			{
				http_response_code(201);	
				$odgovor=URL_vira($naziv_stranke); 
				echo json_encode($odgovor); 
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
			pripravi_odgovor_napaka("Stranka že obstaja!");
		}
	}
	else
	{
		http_response_code(400);	
	}
}



function posodobiStranko($naziv_stranke)
{
	global $zbirka, $DEBUG;
	
	$naziv_stranke = mysqli_escape_string($zbirka, $naziv_stranke);
	
	$podatki = json_decode(file_get_contents("php://input"),true);
		
	if(stranka_obstaja($naziv_stranke))
	{
		if(isset($podatki["tip_stranke"], $podatki["naslov_stranke"], $podatki["email_stranke"], $podatki["telefon_stranke"]))
		{
			
			$tip_stranke = mysqli_escape_string($zbirka, $podatki["tip_stranke"]);
			$naslov_stranke = mysqli_escape_string($zbirka, $podatki["naslov_stranke"]);
			$email_stranke = mysqli_escape_string($zbirka, $podatki["email_stranke"]);
            $telefon_stranke = mysqli_escape_string($zbirka, $podatki["telefon_stranke"]);
			
			$poizvedba = "UPDATE stranke SET tip_stranke='$tip_stranke', naslov_stranke='$naslov_stranke', email_stranke='$email_stranke', telefon_stranke='$telefon_stranke' WHERE naziv_stranke='$naziv_stranke'"; 
			
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


	
function izbrisiStranko($naziv_stranke)
{	
	global $zbirka, $DEBUG;
	$vzdevek=mysqli_escape_string($zbirka, $naziv_stranke);

	if(stranka_obstaja($naziv_stranke))
	{
		$poizvedba="DELETE FROM stranke WHERE naziv_stranke='$naziv_stranke'";
		
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