function podatkiIzdelka()
{
	var zeton = window.localStorage.getItem('access_token');
    var ime_izdelka = document.getElementById("obrazec")["ime_izdelka"].value;
    document.getElementById("odgovor").innerHTML = "";
    if(zeton != null && zeton != ""){
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "/seminarAPI/izdelki/"+ime_izdelka, true);	
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
		window.location.href ="../seminar/domacaAdmin.php";
		alert('Nimas pravice za dostop!');
	}
}



function prikaziZaUrejanje(odgovorJSON)
{
	
    var obrazec = document.getElementById("posodobitev");
    
    obrazec.style.display = "block";
    
	obrazec.ime_dobavitelja.value = odgovorJSON["ime_dobavitelja"];
    obrazec.podrocje_izdelka.value = odgovorJSON["podrocje_izdelka"];
    obrazec.nabavna_cena.value = odgovorJSON["nabavna_cena"];
    obrazec.prodajna_cena.value = odgovorJSON["prodajna_cena"];
    obrazec.zaloga_izdelka.value = odgovorJSON["zaloga_izdelka"];
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
    var ime_izdelka = document.getElementById("obrazec")["ime_izdelka"].value;
    var zeton = window.localStorage.getItem('access_token');
	if(zeton != null && zeton != ""){
	
	var xmlhttp = new XMLHttpRequest();	
    xmlhttp.open("PUT", "/seminarAPI/izdelki/"+ime_izdelka, true);	
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
else{
		window.location.href ="../seminar/domacaAdmin.php";
		alert('Nimas pravice za dostop!');
	}
}



function izbrisiIzdelek()
{
	var zeton = window.localStorage.getItem('access_token');
	var ime_izdelka = document.getElementById("obrazec")["ime_izdelka"].value;
	document.getElementById("odgovor").innerHTML = "";
    if(zeton != null && zeton != ""){
	
		
		var xmlhttp = new XMLHttpRequest();	
		xmlhttp.open("DELETE", "/seminarAPI/izdelki/"+ime_izdelka, true);	
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
				document.getElementById("odgovor").innerHTML="Brisanje ni uspelo! " +this.status;
			}
		};		
		xmlhttp.send();	
	}
    else{
		window.location.href ="../seminar/domacaAdmin.php";
		alert('Nimas pravice za dostop!');
	}		
}





