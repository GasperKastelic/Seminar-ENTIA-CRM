function projektiUporabnika()
{
	var id_uporabnika = window.localStorage.getItem('id_uporabnika');
	var zeton = window.localStorage.getItem('access_token');
	if(zeton != null && zeton != ""){
		var xmlhttp = new XMLHttpRequest();	
		xmlhttp.open("GET", "/seminarAPI/projekti/"+id_uporabnika, true);					
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
			if (this.readyState == 4 && this.status != 200)
			{
				document.getElementById("hidden").innerHTML="Ni uspelo! " +this.status;
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

const formToJSON = elements => [].reduce.call(elements, (data, element) => 
{
	if(element.name!="")
	{
		data[element.name] = element.value;
	}
  return data;
}, {});



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
