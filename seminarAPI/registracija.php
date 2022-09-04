<?php
$DEBUG = true;							

include("orodja.php"); 					

$zbirka = dbConnect();					

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	
    $ime_uporabnika = $data['ime_uporabnika'];
    $priimek_uporabnika = $data['priimek_uporabnika'];
    $geslo_uporabnika = $data['geslo_uporabnika'];
    $podruznica_uporabnika = $data['podruznica_uporabnika'];
    $datum_rojstva = $data['datum_rojstva'];
    $telefon_uporabnika = $data['telefon_uporabnika'];
    $email_uporabnika = $data['email_uporabnika'];
   
	
	$sql="insert into uporabniki(ime_uporabnika, priimek_uporabnika, geslo_uporabnika, podruznica_uporabnika, datum_rojstva, telefon_uporabnika, email_uporabnika)
			values('$ime_uporabnika','$priimek_uporabnika', '$geslo_uporabnika','$datum_rojstva', '$telefon_uporabnika','$email_uporabnika') ";
	
	$result=mysqli_query($zbirka,$sql);
	
	$row=mysqli_fetch_array($result);
	
	if(mysqli_num_rows($result)>0)
	{
		if($_POST["email_uporabnika"] == $email_uporabnika && $_POST["geslo_uporabnika"] == $geslo_uporabnika){
			http_response_code(201);
		}
		else{
			
			http_response_code(401);
		}
	}
	else
	{
		http_response_code(401);  
	}
}
?>