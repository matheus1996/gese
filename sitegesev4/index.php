	<?php
$a = 0;
include 'contador.php';
   

if (isset($_COOKIE['counte']))
{
	$counte = $_COOKIE['counte'] + 1;
}
else
{
    $counte = 1;
    $a++;
}
setcookie('counte', "$counte", time()+3700);
$abre =@fopen("contador.php","w");
$ss ='<?php $a='.$a.'; ?>';
$escreve =fwrite($abre, $ss);
?>

<html lang="pt-br">
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
			<?php include("header.php"); ?>
		</header>

		<article id="mid">
			<h1>Quem somos:</h1>
			<p>
			O Grupo de Estudos em Sistemas de Energia (GESE) é composto por uma equipe de acadêmicos do Instituto Federal de Santa Catarina (IFSC) e foi fundado em 2005 pelo Prof. Rubipiara Cavalcante Fernandes. Tem como objetivo desenvolver estudos relacionados a área de Engenharia, especificamente a Engenharia Elétrica.
			</p>

			<h1>Linhas de Pesquisa:</h1>
			<table id="tabela1">
				<tr><td class="cd">&raquo;</td><td class="ce">Planejamento Integrado de Recursos</td></tr>
				<tr><td class="cd">&raquo;</td><td class="ce">Fontes Alternativas de Geração de Energia</td></tr>
				<tr><td class="cd">&raquo;</td><td class="ce">Gerenciamento pelo Lado da Demanda</td></tr>
				<tr><td class="cd">&raquo;</td><td class="ce">Microrredes e Usinas Virtuais</td></tr>
				<tr><td class="cd">&raquo;</td><td class="ce">Modelagem e Desenvolvimento de Ferramentas Computacionais</td></tr>
				<tr><td class="cd">&raquo;</td><td class="ce">Gerenciamento de Recursos Energéticos de uma Indústria</td></tr>
				<tr><td class="cd">&raquo;</td><td class="ce">Operação, Supervisão e Controle de Sistemas de Energia Elétrica</td></tr>
				<tr><td class="cd">&raquo;</td><td class="ce">Otimização Multiobjetivo</td></tr>
				<tr><td class="cd">&raquo;</td><td class="ce">Planejamento de Sistemas de Energia Elétrica</td></tr>
				<tr><td class="cd">&raquo;</td><td class="ce">Regulação e Mercado de Energia Elétrica</td></tr>
				<tr><td class="cd">&raquo;</td><td class="ce">Tarifação de Energia Elétrica</td></tr>
			</table>
			<h1>Instituições Parceiras:</h1>
			<p>
			<div style="text-align:center;">
			<img src="_imgs/logos.png" usemap="#mapinha"><img>
			<div>
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