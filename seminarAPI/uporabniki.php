<?php
$DEBUG = true;							

include("orodja.php"); 					

$zbirka = dbConnect();					

header('Content-Type: application/json');	
header("Accept", "application/json");	
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

//preveri token

switch($_SERVER["REQUEST_METHOD"])		
{
	case 'GET':
		if(!empty($_GET["id_uporabnika"]) && ($nivo_uporabnika == '0' || $nivo_uporabnika == '1'))
		{
			podatkiUporabnika($_GET["id_uporabnika"]);		
		}
		elseif($nivo_uporabnika == '1')
		{
			vsiUporabniki();
            
		}
		else
		{
			http_response_code(400);    
		}
		break;
		
	case 'POST':
		if($nivo_uporabnika == '1')
		{
			dodajUporabnika();
		}
		elseif(empty($nivo_uporabnika))
		{
			dodajUporabnika();
		}
		else
		{
			http_response_code(400);  
		}
		break;

	case 'PUT':
		if(!empty($_GET["id_uporabnika"]) && ($nivo_uporabnika == '0' || $nivo_uporabnika == '1'))
		{
			posodobiUporabnika($_GET["id_uporabnika"]);
		}
		else
		{
			http_response_code(400);    
		}
		break;

	case 'DELETE':
		if(!empty($_GET["id_uporabnika"]) && $nivo_uporabnika == '1')
		{
			izbrisiUporabnika($_GET["id_uporabnika"]);
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


function vsiUporabniki()
{
	global $zbirka;
	$odgovor=array();
	
	$poizvedba="SELECT id_uporabnika, ime_uporabnika, priimek_uporabnika, podruznica_uporabnika, datum_rojstva, telefon_uporabnika, email_uporabnika, nivo_uporabnika FROM uporabniki";	
	
	$rezultat=mysqli_query($zbirka, $poizvedba);
	
	while($vrstica=mysqli_fetch_assoc($rezultat))
	{
		$odgovor[]=$vrstica;
	}
	
	http_response_code(200);		
	echo json_encode($odgovor);
}

function podatkiUporabnika($id_uporabnika)
{
	global $zbirka;
	$id_uporabnika=mysqli_escape_string($zbirka, $id_uporabnika);
	
	
	$poizvedba="SELECT id_uporabnika, ime_uporabnika, priimek_uporabnika, geslo_uporabnika, podruznica_uporabnika, datum_rojstva, telefon_uporabnika, email_uporabnika, nivo_uporabnika FROM uporabniki WHERE id_uporabnika='$id_uporabnika'";
	
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
        alert("Uporabnik ne obstaja.");
	}
}

function dodajUporabnika()
{
	global $zbirka, $DEBUG;
	$podatki = json_decode(file_get_contents('php://input'), true);

	if(isset($podatki["ime_uporabnika"], $podatki["priimek_uporabnika"], $podatki["geslo_uporabnika"], $podatki["podruznica_uporabnika"], $podatki["datum_rojstva"], $podatki["telefon_uporabnika"], $podatki["email_uporabnika"]))
	{
		
		$ime_uporabnika=mysqli_escape_string($zbirka, $podatki["ime_uporabnika"]);
		$priimek_uporabnika=mysqli_escape_string($zbirka, $podatki["priimek_uporabnika"]);
		$geslo_uporabnika=mysqli_escape_string($zbirka, $podatki["geslo_uporabnika"]);
        $podruznica_uporabnika=mysqli_escape_string($zbirka, $podatki["podruznica_uporabnika"]);
		$datum_rojstva=mysqli_escape_string($zbirka, $podatki["datum_rojstva"]);
		$telefon_uporabnika=mysqli_escape_string($zbirka, $podatki["telefon_uporabnika"]);
		$email_uporabnika=mysqli_escape_string($zbirka, $podatki["email_uporabnika"]);
        //$hashedPwd = password_hash($geslo_uporabnika, PASSWORD_DEFAULT); za skrivanje gesla v bazi

		
		if(!uporabnik_obstaja($email_uporabnika))	
		{
			$poizvedba= "INSERT INTO uporabniki (ime_uporabnika, priimek_uporabnika, geslo_uporabnika, podruznica_uporabnika, datum_rojstva, telefon_uporabnika, email_uporabnika) VALUES ('$ime_uporabnika', '$priimek_uporabnika','$geslo_uporabnika', '$podruznica_uporabnika', '$datum_rojstva','$telefon_uporabnika', '$email_uporabnika')";
           
			
			if(mysqli_query($zbirka, $poizvedba))
			{
				http_response_code(201);			
				$odgovor=URL_vira($id_uporabnika);
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
			alert("Uporabnik že obstaja.");
		}
	}
	else
	{
		http_response_code(400);					
		pripravi_odgovor_napaka("Nekaj je narobe!");
	}
}



function posodobiUporabnika($id_uporabnika)
{
	global $zbirka, $DEBUG;
	$id_uporabnika=mysqli_escape_string($zbirka, $id_uporabnika);
	$podatki = json_decode(file_get_contents('php://input'), true);
	
	if(u_obstaja($id_uporabnika))
	{
		if(isset($podatki["ime_uporabnika"], $podatki["priimek_uporabnika"], $podatki["geslo_uporabnika"], $podatki["podruznica_uporabnika"], $podatki["datum_rojstva"], $podatki["telefon_uporabnika"], $podatki["email_uporabnika"], $podatki["nivo_uporabnika"]))
		{
			$ime_uporabnika=mysqli_escape_string($zbirka, $podatki["ime_uporabnika"]);
			$priimek_uporabnika=mysqli_escape_string($zbirka, $podatki["priimek_uporabnika"]);
			$geslo_uporabnika=mysqli_escape_string($zbirka, $podatki["geslo_uporabnika"]);
            $podruznica_uporabnika=mysqli_escape_string($zbirka, $podatki["podruznica_uporabnika"]);
			$datum_rojstva=mysqli_escape_string($zbirka, $podatki["datum_rojstva"]);
			$telefon_uporabnika=mysqli_escape_string($zbirka, $podatki["telefon_uporabnika"]);
			$email_uporabnika=mysqli_escape_string($zbirka, $podatki["email_uporabnika"]);
			$nivo_uporabnika=mysqli_escape_string($zbirka, $podatki["nivo_uporabnika"]);
		
			$poizvedba = "UPDATE uporabniki SET ime_uporabnika='$ime_uporabnika', priimek_uporabnika='$priimek_uporabnika', geslo_uporabnika='$geslo_uporabnika', podruznica_uporabnika='$podruznica_uporabnika', datum_rojstva='$datum_rojstva', telefon_uporabnika='$telefon_uporabnika', email_uporabnika='$email_uporabnika', nivo_uporabnika='$nivo_uporabnika' WHERE id_uporabnika='$id_uporabnika'";
			
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



function izbrisiUporabnika($id_uporabnika)
{
	global $zbirka, $DEBUG;	
	$id_uporabnika=mysqli_escape_string($zbirka, $id_uporabnika);
	
	if(u_obstaja($id_uporabnika))
	{
		$poizvedba = "DELETE FROM uporabniki WHERE id_uporabnika='$id_uporabnika'";
		
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