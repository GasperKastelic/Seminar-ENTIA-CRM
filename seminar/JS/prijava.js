function prijava() 
{
	var params = "email_uporabnika=" + document.getElementById("email_uporabnika").value + "&geslo_uporabnika=" + document.getElementById("geslo_uporabnika").value;

	var xhr= new XMLHttpRequest();
	xhr.open("POST", "/seminarAPI/prijava.php", true); 
	xhr.setRequestHeader("Accept", "application/json");
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	xhr.onreadystatechange = function () {
	   if (xhr.readyState === 4) 
	   {
			if(xhr.status === 200) 
			{
				var response = JSON.parse(xhr.responseText);
				console.log(response);
				window.localStorage.setItem("access_token", response["token"]);	
				window.localStorage.setItem("id_uporabnika", response["id_uporabnika"]);
				oPrijavi();	
                
			}
			else{
				alert("Prijava ni uspela! Napačen email ali geslo.");
			}
	   }};
	   
	xhr.send(params);
}