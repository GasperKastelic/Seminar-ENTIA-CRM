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
		if(!empty($_GET["id_uporabnika"]) && $nivo_uporabnika == '0')
		{
			projektiUporabnika($_GET["id_uporabnika"]);		
		}
		else
        {
			vsiProjekti();				
		}
        break;
		
	case 'POST':
			dodajProjekt();
		break;
		
	    default:
		http_response_code(405);	
		break;
        
    case 'DELETE':
		if(!empty($_GET["ime_projekta"]))
		{
			izbrisiProjekt($_GET["ime_projekta"]);
		}
		else
		{
			http_response_code(400);	
		}
		break;
}

mysqli_close($zbirka);					





function vsiProjekti()
{
	global $zbirka;
	$odgovor=array(); 
    
    $poizvedba="SELECT projekti.id_projekta, projekti.ime_projekta, projekti.tip_projekta, stranke.naziv_stranke, uporabniki.ime_uporabnika, projekti.zacetek_projekta, projekti.zakljucek_projekta FROM projekti INNER JOIN uporabniki ON (projekti.id_uporabnika=uporabniki.id_uporabnika) INNER JOIN stranke ON (projekti.id_stranke=stranke.id_stranke)";	
    
	
	$rezultat=mysqli_query($zbirka, $poizvedba);
	
	while($vrstica=mysqli_fetch_assoc($rezultat))
	{
		$odgovor[]=$vrstica;          
	}
	
	http_response_code(200);		
	echo json_encode($odgovor);     
}



function projektiUporabnika($id_uporabnika)
{
	global $zbirka;
	$odgovor=array();
	$id_uporabnika=mysqli_escape_string($zbirka, $id_uporabnika);
	
	$poizvedba="SELECT projekti.id_projekta, projekti.ime_projekta, projekti.tip_projekta, stranke.naziv_stranke, projekti.zacetek_projekta, projekti.zakljucek_projekta FROM projekti INNER JOIN stranke ON (projekti.id_stranke=stranke.id_stranke) WHERE id_uporabnika='$id_uporabnika'";
    
	$rezultat=mysqli_query($zbirka, $poizvedba);

	while($vrstica=mysqli_fetch_assoc($rezultat))
	{
		$odgovor[]=$vrstica;
	}
	
	http_response_code(200);		
	echo json_encode($odgovor);
}



function dodajProjekt()
{
	global $zbirka, $DEBUG;
	
	$podatki = json_decode(file_get_contents('php://input'), true);
	
	if(isset($podatki["ime_projekta"], $podatki["tip_projekta"], $podatki["id_stranke"], $podatki["id_uporabnika"], $podatki["zacetek_projekta"], $podatki["zakljucek_projekta"] ))
	{
		if(!projekt_obstaja($podatki["ime_projekta"]))	
		{
			$ime_projekta = mysqli_escape_string($zbirka, $podatki["ime_projekta"]);
            $tip_projekta = mysqli_escape_string($zbirka, $podatki["tip_projekta"]);
			$id_stranke = mysqli_escape_string($zbirka, $podatki["id_stranke"]);
            $id_uporabnika = mysqli_escape_string($zbirka, $podatki["id_uporabnika"]);
            $zacetek_projekta = mysqli_escape_string($zbirka, $podatki["zacetek_projekta"]);
            $zakljucek_projekta = mysqli_escape_string($zbirka, $podatki["zakljucek_projekta"]);
            
				
			$poizvedba="INSERT INTO projekti (ime_projekta, tip_projekta, id_stranke, id_uporabnika, zacetek_projekta, zakljucek_projekta ) VALUES ('$ime_projekta', '$tip_projekta', '$id_stranke', '$id_uporabnika', '$zacetek_projekta', '$zakljucek_projekta')";
			
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
			pripravi_odgovor_napaka("Projekt že obstaja!");
		}
	}
	else
	{
		http_response_code(400);	
	}
}
