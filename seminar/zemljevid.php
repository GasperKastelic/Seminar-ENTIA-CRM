<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Zemljevid</title>
		<link rel="stylesheet" type="text/css" href="css/stil.css" />
        <script src="JS/projekt.js"></script>
        <script src="JS/prevPrijavoU.js"></script>
        <script>
			function start(){
				projektiUporabnika();
				prevPrijavoU();
			}
		</script>

	</head>
    
	<body onload="start()">
		<div class="center">
            <?php include "Meni.html"?>
			
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2767.4027207471454!2d14.51067221526732!3d46.08294947911317!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476532c6969a479d%3A0xff94df5477846d5e!2sEntia%20d.o.o!5e0!3m2!1ssl!2ssi!4v1661500942216!5m2!1ssl!2ssi" width="750" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

			<div id="odgovor"></div>
		</div>
	</body>
</html>