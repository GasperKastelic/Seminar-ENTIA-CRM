function oPrijavi() 
{
	var zeton = window.localStorage.getItem('access_token');
	if(zeton != null && zeton != "")
	{
		var xhr = new XMLHttpRequest();
		xhr.open("GET", "/seminarAPI/podatki.php");	

		xhr.setRequestHeader("Accept", "application/json");
		xhr.setRequestHeader("Authorization", "Bearer " + window.localStorage.getItem("access_token"));

		xhr.onreadystatechange = function () {
			if (xhr.readyState === 4) {
				var level = xhr.responseText;
				if(level == '0')
				{
					window.location.href ="http://localhost:8080/seminar/domaca.php";
                    
                    
				}
				else
				{
					window.location.href ="http://localhost:8080/seminar/domacaAdmin.php";
				}
			}};
		xhr.send();					
	}
}