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
		if(!empty($_GET["ime_dobavitelja"]))
		{
			podatkiDobavitelja($_GET["ime_dobavitelja"]);		
		}
		else
		{
			vsiDobavitelji();					
		}
		break;
		
	case 'POST':
		dodajDobavitelja();
		break;
		
	case 'PUT':
		if(!empty($_GET["ime_dobavitelja"]))              
		{
			posodobiPodatke($_GET["ime_dobavitelja"]);   
		}
		else
		{
			http_response_code(400);	
		}
		break;
		
	case 'DELETE':
		if(!empty($_GET["ime_dobavitelja"]))
		{
			izbrisiDobavitelja($_GET["ime_dobavitelja"]);
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





function vsiDobavitelji()
{
	global $zbirka;
	$odgovor=array();  
	
	$poizvedba="SELECT ime_dobavitelja, naslov_dobavitelja, email_dobavitelja, telefon_dobavitelja FROM dobavitelji";	
	
	$rezultat=mysqli_query($zbirka, $poizvedba);
	
	while($vrstica=mysqli_fetch_assoc($rezultat))
	{
		$odgovor[]=$vrstica;          
	}
	
	http_response_code(200);		
	echo json_encode($odgovor);     
}



function podatkiDobavitelja($ime_dobavitelja)
{
	global $zbirka;    
	$ime_dobavitelja=mysqli_escape_string($zbirka, $ime_dobavitelja); 
	
	$poizvedba="SELECT ime_dobavitelja, naslov_dobavitelja, email_dobavitelja, telefon_dobavitelja FROM dobavitelji WHERE ime_dobavitelja='$ime_dobavitelja'";
	
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



function dodajDobavitelja()
{
	global $zbirka, $DEBUG;   
	
	$podatki = json_decode(file_get_contents('php://input'), true); 
	
	if(isset($podatki["ime_dobavitelja"], $podatki["naslov_dobavitelja"], $podatki["email_dobavitelja"], $podatki["telefon_dobavitelja"]))  
	{
		$ime_dobavitelja = mysqli_escape_string($zbirka, $podatki["ime_dobavitelja"]);  
		$naslov_dobavitelja = mysqli_escape_string($zbirka, $podatki["naslov_dobavitelja"]);
		$email_dobavitelja = mysqli_escape_string($zbirka, $podatki["email_dobavitelja"]);
		$telefon_dobavitelja = mysqli_escape_string($zbirka, $podatki["telefon_dobavitelja"]);
			
		if(!dobavitelj_obstaja($ime_dobavitelja)) 
		{	
			$poizvedba="INSERT INTO dobavitelji (ime_dobavitelja, naslov_dobavitelja, email_dobavitelja, telefon_dobavitelja) VALUES ('$ime_dobavitelja', '$naslov_dobavitelja', '$email_dobavitelja', '$telefon_dobavitelja')";
			
			if(mysqli_query($zbirka, $poizvedba))
			{
				http_response_code(201);	
				$odgovor=URL_vira($ime_dobavitelja); 
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
			pripravi_odgovor_napaka("Dobavitelj že obstaja!");
		}
	}
	else
	{
		http_response_code(400);	
	}
}



function posodobiPodatke($ime_dobavitelja)
{
	global $zbirka, $DEBUG;
	
	$ime_dobavitelja = mysqli_escape_string($zbirka, $ime_dobavitelja);
	
	$podatki = json_decode(file_get_contents("php://input"),true);
		
	if(dobavitelj_obstaja($ime_dobavitelja))
	{
		if(isset($podatki["naslov_dobavitelja"], $podatki["email_dobavitelja"], $podatki["telefon_dobavitelja"]))
		{
			
			$naslov_dobavitelja = mysqli_escape_string($zbirka, $podatki["naslov_dobavitelja"]);
			$email_dobavitelja = mysqli_escape_string($zbirka, $podatki["email_dobavitelja"]);
			$telefon_dobavitelja = mysqli_escape_string($zbirka, $podatki["telefon_dobavitelja"]);
			
			$poizvedba = "UPDATE dobavitelji SET naslov_dobavitelja='$naslov_dobavitelja', email_dobavitelja='$email_dobavitelja', telefon_dobavitelja='$telefon_dobavitelja' WHERE ime_dobavitelja='$ime_dobavitelja'"; 
			
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


	
function izbrisiDobavitelja($ime_dobavitelja)
{	
	global $zbirka, $DEBUG;
	$vzdevek=mysqli_escape_string($zbirka, $ime_dobavitelja);

	if(dobavitelj_obstaja($ime_dobavitelja))
	{
		$poizvedba="DELETE FROM dobavitelji WHERE ime_dobavitelja='$ime_dobavitelja'";
		
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