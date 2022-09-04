<?php 
	$DEBUG = true;							

	include("orodja.php"); 					

	header('Content-Type: application/json');	

	header ("Access-Control-Allow-Origin: *");
	header ("Access-Control-Allow-Headers: Content-type, application/x-www-form-urlencoded, Authorization, Accept, application/json");
	header ("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
	header ("Access-Control-Allow-Headers: *");
	
	$zbirka = dbConnect();					
	if($_SERVER["REQUEST_METHOD"]=='GET')
	{	
		
		$headers = apache_request_headers();	

		
		if(isset($headers['Authorization'])) 
		{
			$headers = trim($headers["Authorization"]);
			
			
			if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) 
			{
				
				$sql = "SELECT * from uporabniki where token = '$matches[1]'";
				//echo $sql;
				$result=mysqli_query($zbirka,$sql);
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
					echo $nivo_uporabnika;
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
	}
?>