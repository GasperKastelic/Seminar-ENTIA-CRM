function vsiProjekti()
{
	var zeton = window.localStorage.getItem('access_token');
	if(zeton != null && zeton != ""){
		var xmlhttp = new XMLHttpRequest();	
		xmlhttp.open("GET", "/seminarAPI/projekti", true);		
		xmlhttp.setRequestHeader("Accept", "application/json");	
		xmlhttp.setRequestHeader("Authorization", "Bearer " + window.localStorage.getItem("access_token"));
		
		xmlhttp.onreadystatechange = function()									
		{
			if (this.readyState == 4 && this.status == 200)						
			{
				try
				{
					var odgovorJSON = JSON.parse(this.responseText);
				}
				catch(e)
				{
					console.log("Napaka pri razčlenjevanju podatkov");
					return;
				}
				prikazi(odgovorJSON);
			}
		};						
		xmlhttp.send();
	}
	else
	{
		window.location.href ="../seminar/index.php";
		alert('Nimas pravice za dostop!');
	}														
}




function prikazi(odgovorJSON)
{
	var fragment = document.createDocumentFragment(); 		
	
	for(var i=0; i<odgovorJSON.length; i++) 
	{ 				
		var tr = document.createElement("tr");
	
		for (var stolpec in odgovorJSON[i])
		{
			var td = document.createElement("td"); 
			td.innerHTML = odgovorJSON[i][stolpec]; 
			tr.appendChild(td);
		}
		fragment.appendChild(tr);
	}
	document.getElementById("tabela1").appendChild(fragment);
}