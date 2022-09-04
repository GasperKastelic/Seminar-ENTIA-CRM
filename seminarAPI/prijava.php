<?php
$DEBUG = true;							

include("orodja.php"); 					

header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Allow-Headers: Content-type, application/x-www-form-urlencoded, Accept, application/json");
header ("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header ("Access-Control-Allow-Headers: *");

$zbirka = dbConnect();					

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$email_uporabnika=$_POST["email_uporabnika"];
	$geslo_uporabnika=$_POST["geslo_uporabnika"];
    
   //$checkPwd = password_verify($geslo_uporabnika, $hashedPwd); za skrivanje gesla v bazi
    

	$query="select * from uporabniki where email_uporabnika='".$email_uporabnika."' AND geslo_uporabnika='".$geslo_uporabnika."' ";
    
	
	$result=mysqli_query($zbirka,$query);
	$row=mysqli_fetch_array($result);
	
	if(mysqli_num_rows($result)>0)
	{
		foreach($result as $data){
			$id_uporabnika = $data['id_uporabnika'];
            $ime_uporabnika = $data['ime_uporabnika'];
            $priimek_uporabnika = $data['priimek_uporabnika'];
            $podruznica_uporabnika = $data['podruznica_uporabnika'];
            $email_uporabnika = $data['email_uporabnika'];
            $datum_rojstva = $data['datum_rojstva'];
            $telefon_uporabnika = $data['telefon_uporabnika'];
            $nivo_uporabnika = $data['nivo_uporabnika'];
            $geslo_uporabnika = $data['geslo_uporabnika'];
		}
		
		$token = hash("md5",$email_uporabnika.$geslo_uporabnika);

		$poizvedba="UPDATE uporabniki SET token='$token' WHERE email_uporabnika = '$email_uporabnika'";	
		$rezultat=mysqli_query($zbirka, $poizvedba);
		echo json_encode(array('token'=>$token, 'id_uporabnika'=>$id_uporabnika));
	}
	else{
		
		http_response_code(401);
	}
}
else{
	http_response_code(500);
}
?>