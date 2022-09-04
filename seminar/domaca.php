<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/stil.css" />
		<title>Entia | User</title>
		<script src="JS/prevPrijavoU.js"></script>
	</head>
    
	<body onload="prevPrijavoU()">
		<div class="center">
			<?php include("Meni.html");?>
            <br><br>
            
        <table id="tabela2">

          <tr>
              <th onclick="location.href='https://entia.intrix.si/calendar?start=2021-10-01'">Intrix</th>
          </tr>
          <tr>
              <th onclick="location.href='https://data.entia.si:8443/#group/3/'">Datoteke</th>
          </tr>
          <tr>
              <th onclick="location.href='https://server1.entia.si/Login.php'">Server 1</th>
          </tr>
          <tr>
              <th onclick="location.href='https://server2.entia.si/Login.php'">Server 2</th>
          </tr>
          <tr>
              <th onclick="location.href='https://server3.entia.si/Login.php'">Server 3</th>
          </tr>
          <tr>
              <th onclick="location.href='https://server4.entia.si/Login.php'">Server 4</th>
          </tr>
          <tr>
              <th onclick="location.href='https://server5.entia.si/Login.php'">Server 5</th>
          </tr>
          <tr>
              <th onclick="location.href='https://docs.google.com/spreadsheets/d/1PfhBdbGweeIov0barcEYjDyGeMo2H3oLlzpWiy1ch8w/edit#gid=1730964371'">Izvedbena tabela</th>
          </tr>
        </table>
            
        <img alt="drawing" src="images/meni.png" usemap="#menimap" outline-color="#111" margin-right="10px" style="width:750px;height:400px;"/>
        <map name="menimap">
            <area shape="rect" coords="20,15,175,190" alt="Ogrevanje in hlajenje" href="https://entia.si/funkcionalnosti/ogrevanje-hlajenje-in-prezracevanje-hvac/">
            <area shape="rect" coords="205,15,360,190" alt="Senčenje" href="https://entia.si/funkcionalnosti/sencenje/">
            <area shape="rect" coords="390,15,545,190" alt="Razsvetljava" href="https://entia.si/funkcionalnosti/razsvetljava/">
            <area shape="rect" coords="575,15,730,190" alt="Varnost" href="https://entia.si/funkcionalnosti/varnost/">
            <area shape="rect" coords="20,220,175,385" alt="Domofonski sistem" href="https://entia.si/funkcionalnosti/napreden-domofonski-sistem/">
            <area shape="rect" coords="205,220,360,385" alt="Ključavnice" href="https://entia.si/funkcionalnosti/kljucavnice-smartlocks/">
            <area shape="rect" coords="390,220,545,385" alt="Vtičnice" href="https://entia.si/funkcionalnosti/pametne-vticnice/">
            <area shape="rect" coords="575,220,730,385" alt="Ostali segmenti" href="https://entia.si/funkcionalnosti/upravljanje-ostalih-segmentov/">
        </map>
              
		</div>
	</body>
    
</html>