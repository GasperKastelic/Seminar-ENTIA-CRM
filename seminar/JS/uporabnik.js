function podatkiUporabnika()
{
	var id_uporabnika = document.getElementById("obrazec")["id_uporabnika"].value;
	document.getElementById("odgovor").innerHTML = "";
	var zeton = window.localStorage.getItem('access_token');
	if(zeton != null && zeton != ""){
		var xmlhttp = new XMLHttpRequest();	
		xmlhttp.open("GET", "/seminarAPI/uporabniki/"+id_uporabnika, true);
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
				
				prikaziZaUrejanje(odgovorJSON);
			}
			if (this.readyState == 4 && this.status != 200)
			{
				document.getElementById("odgovor").innerHTML="Ni uspelo! " +this.status;
			}
		};
		xmlhttp.send();	
	}
	else{
		window.location.href ="../seminar/index.php";
		alert('Nimas pravice za dostop!');
	}												
}




function vsiUporabniki()
{
	var zeton = window.localStorage.getItem('access_token');
	if(zeton != null && zeton != ""){	
		
		var xmlhttp = new XMLHttpRequest();										
		xmlhttp.open("GET", "/seminarAPI/uporabniki", true);	
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



function prikaziZaUrejanje(odgovorJSON)
{
	var obrazec = document.getElementById("posodobitev"); 
	
	obrazec.style.display = "block";
	
	obrazec.ime_uporabnika.value = odgovorJSON["ime_uporabnika"];
	obrazec.priimek_uporabnika.value = odgovorJSON["priimek_uporabnika"];
	obrazec.geslo_uporabnika.value = odgovorJSON["geslo_uporabnika"];
    obrazec.podruznica_uporabnika.value = odgovorJSON["podruznica_uporabnika"];
	obrazec.datum_rojstva.value = odgovorJSON["datum_rojstva"];
	obrazec.telefon_uporabnika.value = odgovorJSON["telefon_uporabnika"];
	obrazec.email_uporabnika.value = odgovorJSON["email_uporabnika"];
	obrazec.nivo_uporabnika.value = odgovorJSON["nivo_uporabnika"];
}

const formToJSON = elements => [].reduce.call(elements, (data, element) => 
{
	if(element.name!="")
	{
		data[element.name] = element.value;
	}
  return data;
}, {});



function posodobiPodatke()
{
	const data = formToJSON(document.getElementById("posodobitev").elements);
	var JSONdata = JSON.stringify(data, null, "  ");
	var id_uporabnika = document.getElementById("obrazec")["id_uporabnika"].value;
	var zeton = window.localStorage.getItem('access_token');
	if(zeton != null && zeton != ""){
	
		var xmlhttp = new XMLHttpRequest();										
		xmlhttp.open("PUT", "/seminarAPI/uporabniki/"+id_uporabnika, true);
		xmlhttp.setRequestHeader("Accept", "application/json");	
		xmlhttp.setRequestHeader("Authorization", "Bearer " + window.localStorage.getItem("access_token"));
		
		xmlhttp.onreadystatechange = function()									
		{
			if (this.readyState == 4 && this.status == 204)						
			{
				document.getElementById("odgovor").innerHTML="Posodobitev uspela!";
			}
			if(this.readyState == 4 && this.status != 204)						
			{
				document.getElementById("odgovor").innerHTML="Posodobitev ni uspela: "+this.status;
			}
		};					
		xmlhttp.send(JSONdata);
	}
	else
	{
		window.location.href ="../seminar/index.php";
		alert('Nimas pravice za dostop!');
	}	
}



function izbrisiUporabnika()
{
	var zeton = window.localStorage.getItem('access_token');
	var id_uporabnika = document.getElementById("obrazec")["id_uporabnika"].value;
	document.getElementById("odgovor").innerHTML = "";
	if(zeton != null && zeton != ""){
		
		var xmlhttp = new XMLHttpRequest();	
		xmlhttp.open("DELETE", "/seminarAPI/uporabniki/"+id_uporabnika, true);	
		xmlhttp.setRequestHeader("Accept", "application/json");	
		xmlhttp.setRequestHeader("Authorization", "Bearer " + window.localStorage.getItem("access_token"));
		
		xmlhttp.onreadystatechange = function()									
		
		{
			if (this.readyState == 4 && this.status == 204)						
			{
				document.getElementById("odgovor").innerHTML="Brisanje uspelo!";
			}
			if (this.readyState == 4 && this.status != 204)
			{
				document.getElementById("odgovor").innerHTML="Ni uspelo! " +this.status;
			}
		};		
		xmlhttp.send();	
	}
	else{
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