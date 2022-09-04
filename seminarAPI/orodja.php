<?php

function dbConnect()
{
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "seminar";

	
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	mysqli_set_charset($conn,"utf8");
	
	
	if (mysqli_connect_errno())
	{
		printf("Povezovanje s podatkovnim strežnikom ni uspelo: %s\n", mysqli_connect_error());
		exit();
	} 	
	return $conn;
}



function pripravi_odgovor_napaka($vsebina)
{
	$odgovor=array(
		'status' => 0,
		'error_message'=>$vsebina
	);
	echo json_encode($odgovor);
}



function dobavitelj_obstaja($ime_dobavitelja)
{	
	global $zbirka;
	$ime_dobavitelja=mysqli_escape_string($zbirka, $ime_dobavitelja);
	
	$poizvedba="SELECT * FROM dobavitelji WHERE ime_dobavitelja='$ime_dobavitelja'";
	
	if(mysqli_num_rows(mysqli_query($zbirka, $poizvedba)) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}	
}



function izdelek_obstaja($ime_izdelka)
{	
	global $zbirka;
	$ime_izdelka=mysqli_escape_string($zbirka, $ime_izdelka);
	
	$poizvedba="SELECT * FROM izdelki WHERE ime_izdelka='$ime_izdelka'";
	
	if(mysqli_num_rows(mysqli_query($zbirka, $poizvedba)) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}	
}



function stranka_obstaja($naziv_stranke)
{	
	global $zbirka;
	$naziv_stranke=mysqli_escape_string($zbirka, $naziv_stranke);
	
	$poizvedba="SELECT * FROM stranke WHERE naziv_stranke='$naziv_stranke'";
	
	if(mysqli_num_rows(mysqli_query($zbirka, $poizvedba)) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}	
}



function projekt_obstaja($ime_projekta)
{	
	global $zbirka;
	$ime_projekta=mysqli_escape_string($zbirka, $ime_projekta);
	
	$poizvedba="SELECT * FROM projekti WHERE ime_projekta='$ime_projekta'";
	
	if(mysqli_num_rows(mysqli_query($zbirka, $poizvedba)) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}	
}



function uporabnik_obstaja($email_uporabnika)
{	
	global $zbirka;
	$email_uporabnika=mysqli_escape_string($zbirka, $email_uporabnika);
	
	$poizvedba="SELECT * FROM uporabniki WHERE email_uporabnika='$email_uporabnika'";
	
	if(mysqli_num_rows(mysqli_query($zbirka, $poizvedba)) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}	
}



function u_obstaja($id_uporabnika)
{	
	global $zbirka;
	$id_uporabnika=mysqli_escape_string($zbirka, $id_uporabnika);
	
	$poizvedba="SELECT * FROM uporabniki WHERE id_uporabnika='$id_uporabnika'";
	
	if(mysqli_num_rows(mysqli_query($zbirka, $poizvedba)) > 0)
	{
		return true;
	}
	else
	{
		return false;
	}	
}



function URL_vira($vir)
{
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
	{
		$url = "https"; 
	}
	else
	{
		$url = "http"; 
	}
	$url .= "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $vir;
	
	return $url; 
}



function preveri_zeton($email_uporabnika, $geslo_uporabnika)
{
	global $zbirka, $DEBUG;	
	$email_uporabnika=mysqli_escape_string($zbirka, $email_uporabnika);
	$geslo_uporabnika=mysqli_escape_string($zbirka, $geslo_uporabnika);
	
	if(uporabnik_obstaja($email_uporabnika))
	{
		$headers = apache_request_headers();	

		// preverimo, ce je prisotno polje Authorization
		if(isset($headers['Authorization'])) {
			$headers = trim($headers["Authorization"]);
			
			// preverimo, ce je vrsta avtentikacije 'Bearers', in shranimo zeton
			if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
				
				// preverimo, ce je zeton v bazi ujema z zetonom v brskalniku, potem preverimo 
				if($matches[1] == hash("md5", $email_uporabnika.$geslo_uporabnika)){
					//sql stavek
					$sql = "SELECT * from uporabniki where token = '$matches[1]'";
					echo "Uporabnik je authoriziran";	
				}
				else{
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
	}
	else
	{
		echo "Uporabnik ne obstaja!";
		http_response_code(404);
	}
}

?>