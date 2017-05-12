<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8"/>
	<title>GESE</title>
	<link rel="icon" href="_imgs/icone_gese.png" type="image/x-icon" />
	<link rel="stylesheet" href="_css/estilo.css"/>
	<link rel="stylesheet" href="_css/form.css"/>
	<style type="text/css">
		nav#menu li#ferramentas
		{
			background-color: #2F4F4F;
		}
		nav#menu a#ferramentas
		{
			color: white;
		}
	</style>
</head>
<!--
<script type="text/javascript">
    function calc()
    {
        var	Consumop = parseFloat(document.getElementById('i_Consumop').value);
        var Consumofp = parseFloat(document.getElementById('i_Consumofp').value);
        var	Demandap = parseFloat(document.getElementById('i_Demandap').value);
        var Demandafp = parseFloat(document.getElementById('i_Demandafp').value);
        var	Tarifap = parseFloat(document.getElementById('i_Tarifap').value);
        var Tarifafp = parseFloat(document.getElementById('i_Tarifafp').value);
        var	TUSDdp = parseFloat(document.getElementById('i_TUSDdp').value);
        var TUSDdfp = parseFloat(document.getElementById('i_TUSDdfp').value);
        var	TUSDep = parseFloat(document.getElementById('i_TUSDep').value);
        var TUSDefp = parseFloat(document.getElementById('i_TUSDefp').value);
        var k = parseFloat(document.getElementById('i_k').value);
        
        var TE =  ((Consumop*Tarifap)+(Consumofp*Tarifafp))/1000;
		var TE_f = parseFloat(TE.toFixed(2));
        document.getElementById('i_TE').value = TE_f;

        var TUSDd =  ((Demandap*TUSDdp)+(Demandafp*TUSDdfp));
        var TUSDd_f = parseFloat(TUSDd.toFixed(2));
        document.getElementById('i_TUSDd').value = TUSDd_f;

        var TUSDe =  ((Consumop*TUSDep)+(Consumofp*TUSDefp))/1000;
        var TUSDe_f = parseFloat(TUSDe.toFixed(2));
        document.getElementById('i_TUSDe').value = TUSDe_f;

        var perdas =  ((Consumop+Consumofp)/1000)*(1+(k)/100);
		var perdas_f = parseFloat(perdas.toFixed(2));
        document.getElementById('i_perdas').value = perdas_f;

    }
    
}
-->
    
</script>

<body>
	<div id="interface">
		<header id="top">
			<?php include("header.php"); ?>
		</header>

		<article id="mid">

		<form action="envia.php" method="post" enctype="multipart/form-data">
				<fieldset>
				<legend>Preço de Indiferença p/ um período</legend>
				Para gerar o preço de indiferença informe os dados de entrada:<br/>
				1 - Baixe o arquivo csv;<br/>
				2 - Cole nas cedulas o dados: Consumo e Demanda;<br/>
				3 - Realize o upload do arquivo csv;<br/>
				4 - Clique em Gerar;<br/><br/>
				
				<a href="_csv/Consumidor.csv" download>Clique aqui p/ baixar o arquivo base csv</a><br/><br/>

		  		<input type="file" name="Arquivo" id="Arquivo"/>
			  	<input type="submit" value="Enviar" /><br/><br/>

				
				</fieldset>
		
		</form>
		
		<!--
		<form method="get" action="p_indi.php" oninput="calc();">
			<fieldset>
				<legend>Preço de Indiferença p/ um mês</legend>
				<img id="acr" src="_imgs/ccr.png"> </img>	<img id="acl" src="_imgs/ccl.png"> </img>


				<p><label for="i_Demandap">Demanda na Ponta:</label>		<input type="text" name="n_Demandap" id="i_Demandap" placeholder=" kW"/></p>
				<p><label for="i_Demandafp">Demanda Fora Ponta:</label>		<input type="text" name="n_Demandafp" id="i_Demandafp" placeholder=" kW"/></p>
				<p><label for="i_Consumop">Consumo na Ponta:</label>		<input type="text" name="n_Consumop" id="i_Consumop" placeholder=" kWh"/></p>
				<p><label for="i_Consumofp">Consumo fora da Ponta:</label>	<input type="text" name="n_Consumofp" id="i_Consumofp" placeholder=" kWh"/></p>
				<p><label for="i_Tarifap">Tarifa na Ponta:</label>			<input type="text" name="n_Tarifap" id="i_Tarifap" placeholder=" R$/MWh"/></p>
				<p><label for="i_Tarifafp">Tarifa fora da Ponta:</label>	<input type="text" name="n_Tarifafp" id="i_Tarifafp" placeholder=" R$/MWh"/></p>
				<p><label for="i_TUSDdp">TUSDd na ponta:</label>			<input type="text" name="n_TUSDdp" id="i_TUSDdp" placeholder=" R$/kW"/></p>
				<p><label for="i_TUSDdfp">TUSDd fora da ponta:</label>		<input type="text" name="n_TUSDdfp" id="i_TUSDdfp" placeholder=" R$/kW"/></p>
				<p><label for="i_TUSDep">TUSDe na ponta:</label>			<input type="text" name="n_TUSDep" id="i_TUSDep" placeholder=" R$/MWh"/></p>
				<p><label for="i_TUSDefp">TUSDe fora da ponta:</label>		<input type="text" name="n_TUSDefp" id="i_TUSDefp" placeholder=" R$/MWh"/></p>
				<p class="auto"><label for="i_TE">TE:</label>				<input type="text" name="n_TE" id="i_TE" placeholder=" (Cpt×TEpt)+(Cfpt×TEfpt)" readonly/></p>
				<p class="auto"><label for="i_TUSDd">TUSDd:</label>		<input type="text" name="n_TUSDd" id="i_TUSDd" placeholder=" (Dpt×TUSDdpt)+(Dfpt×TUSDdfpt)" readonly/></p>
				<p class="auto"><label for="i_TUSDe">TUSDe:</label>		<input type="text" name="n_TUSDe" id="i_TUSDe" placeholder=" (Cpt×TUSDept)+(Cfpt×TUSDefpt)" readonly/></p>
				<br/>
				<p><label for="i_pis">PIS:</label>			<input type="text" name="n_PIS" id="i_PIS"/></p>
				<p><label for="i_COFINS">COFINS:</label>	<input type="text" name="n_COFINS" id="i_COFINS"/></p>
				<p><label for="i_ICMS">ICMS:</label>		<input type="text" name="n_ICMS" id="i_ICMS"/></p>
				<br/>
				<p><label for="i_k">K:</label>				<input type="text" name="n_k" id="i_k" placeholder=" %"/></p>
				<p><label for="i_PI">P:</label>				<input type="text" name="n_PI" id="i_PI" placeholder=" R$/kWh"/></p>
				<p><label for="i_CCEE">CCEE:</label>		<input type="text" name="n_CCEE" id="i_CCEE" placeholder=" R$"/></p>
				<p><label for="i_ESS">ESS:</label>			<input type="text" name="n_ESS" id="i_ESS" placeholder=" R$/MWh"/></p>
				<p class="auto"><label for="i_perdas">C_perdas:</label>	<input type="text" name="n_perdas" id="i_perdas" placeholder=" (Cpt+Cfpt)×(1+k)" readonly/></p>
				<br/>
				<input type="submit" value="Calcular"/>
			</fieldset>
		</form>
		-->

		</article>

		<footer id="bot">
			<?php include("footer.php"); ?>
		</footer>
	</div>

</body>

</html>