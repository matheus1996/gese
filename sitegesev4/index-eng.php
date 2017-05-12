<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta charset="UTF-8"/>
	<title>GESE</title>
	<link rel="icon" href="_imgs/icone_gese.png" type="image/x-icon" />
	<link rel="stylesheet" href="_css/estilo.css"/>
	<style type="text/css">
		nav#menu li#home
		{
			background-color: #2F4F4F;
		}
		nav#menu a#home
		{
			color: white;
		}
	</style>
</head>

<body>
	<div id="interface">
		<header id="top">
			<?php include("header-eng.php"); ?>
		</header>

		<article id="mid">
			<h1>Who we are:</h1>
			<p>
			The Study Group on Energy Systems (GESE) consists of a team of academics from the Federal Institute of Santa Catarina (IFSC) and was founded in 2005 by Prof. Rubipiara Cavalcante Fernandes. It aims to conduct studies related to engineering area, specifically the Electrical Engineering.
			</p>

			<h1>Research Lines:</h1>
			<table id="tabela1">
				<tr><td class="cd">&raquo;</td><td class="ce">Integrated Resource Planning</td></tr>
				<tr><td class="cd">&raquo;</td> <td class="ce">Sources of Power Generation Alternatives</td></tr>
				<tr><td class="cd">&raquo;</td> <td class="ce">Energy Resources Management of Industry</td></tr>
				<tr><td class="cd">&raquo;</td> <td class="ce">Operation, Supervision and Control of Power Systems</td></tr>
				<tr><td class="cd">&raquo;</td><td class="ce">Multiobjective Optimization</td></tr>
				<tr><td class="cd">&raquo;</td><td class="ce">Regulation and Electricity Market</td></tr>
			</table>
			<h1>Partner Institutions:</h1>
			<p>
			<img id="img-esquema" src="_imgs/logos.png" usemap="#mapinha"><img>
				<map name="mapinha">
					<area shape="rect" coords="10,10,310,85" href="http://www.paradigmabs.com.br/" target="_blanck" />
					<area shape="rect" coords="324,21,470,180" href="https://www.ipp.pt/" target="_blanck" />
					<area shape="rect" coords="500,15,630,190" href="http://ufsc.br/" target="_blanck" />
					<area shape="rect" coords="24,105,225,180" href="http://www.enex-om.com.br/default.aspx" target="_blanck" />
					<area shape="rect" coords="10,220,112,337" href="http://www.celesc.com.br/portal/" target="_blanck" />
					<area shape="rect" coords="130,220,318,344" href="http://www.grenoble-inp.fr/" target="_blanck" />
					<area shape="rect" coords="319,220,438,339" href="http://ec.europa.eu/research/mariecurieactions/" target="_blanck" />
					<area shape="rect" coords="492,203,679,266" href="http://www.ovgu.de/" target="_blanck" />
					<area shape="rect" coords="447,272,690,345" href="http://cnpq.br/" target="_blanck" />
				</map>
			</p>
		</article>	

		<footer id="bot">
			<?php include("footer.php"); ?>
		</footer>
	</div>

</body>

</html>