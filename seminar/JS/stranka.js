function podatkiStranke()
{
	var zeton = window.localStorage.getItem('access_token');
    var naziv_stranke = document.getElementById("obrazec")["naziv_stranke"].value;
    document.getElementById("odgovor").innerHTML = "";
    if(zeton != null && zeton != ""){
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "/seminarAPI/stranke/"+naziv_stranke, true);	
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
    
	obrazec.tip_stranke.value = odgovorJSON["tip_stranke"];
    obrazec.naslov_stranke.value = odgovorJSON["naslov_stranke"];
    obrazec.email_stranke.value = odgovorJSON["email_stranke"];
    obrazec.telefon_stranke.value = odgovorJSON["telefon_stranke"];
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
    var naziv_stranke = document.getElementById("obrazec")["naziv_stranke"].value;
    var zeton = window.localStorage.getItem('access_token');
	if(zeton != null && zeton != ""){
	
	var xmlhttp = new XMLHttpRequest();	
    xmlhttp.open("PUT", "/seminarAPI/stranke/"+naziv_stranke, true);	
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



function izbrisiStranko()
{
	var zeton = window.localStorage.getItem('access_token');
	var naziv_stranke = document.getElementById("obrazec")["naziv_stranke"].value;
	document.getElementById("odgovor").innerHTML = "";
    if(zeton != null && zeton != ""){
	
		
		var xmlhttp = new XMLHttpRequest();	
		xmlhttp.open("DELETE", "/seminarAPI/stranke/"+naziv_stranke, true);	
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


