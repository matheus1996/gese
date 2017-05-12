
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

<body>
	<div id="interface">
		<header id="top">
			<?php include("header.php"); ?>
		</header>

		<div id="envia" style="text-align:center;">
		<?php

		$arqSize = $_FILES['Arquivo']['size'];
		$tamanhoPermitido = 1024 * 500; // 500 Kb
		$arqError = $_FILES['Arquivo']['error'];
		$nome=$_FILES['Arquivo']["name"];
		$tipo=$_FILES['Arquivo']['type'];
		if ($arqError == 0) 
		{
	    	if ($arqSize > $tamanhoPermitido) 
	    	{
	      	echo 'Arquivo muito grande. ';
	      	?><br/><a href="ferramentas.php">Voltar</a><?php
	    	}
	    	else if ($nome != "Consumidor.csv")
	    	{
	    	echo "Nome do arquivo invalido ";
	    	?><br/><a href="ferramentas.php">Voltar</a><?php
	    	}
	    	else
	    	{
	      	$nome_temporario=$_FILES["Arquivo"]["tmp_name"]; 
			$nome_real=$_FILES["Arquivo"]["name"];
			copy($nome_temporario,$nome_real);
			echo 'Arquivo CSV enviado com sucesso ';
			?>
				<form style="width: 500px;" method="post" action="planilha.php">
					<fieldset id="grupo">
						<legend>Informe o Grupo e Modalidade Tarifária</legend>
						<p>
						<br/>
						<input style="width: auto;" type="radio" name="n_grupo[]" id="i_grupo" value="A2_AZUL" /><label for="i_grupo">A2-Azul</label><br/>
						<input style="width: auto;" type="radio" name="n_grupo[]" id="i_grupo" value="A3_AZUL" /><label for="i_grupo">A3-Azul</label><br/>
						<input style="width: auto;" type="radio" name="n_grupo[]" id="i_grupo" value="A3a_AZUL" /><label for="i_grupo">A3a-Azul</label><br/>
						<input style="width: auto;" type="radio" name="n_grupo[]" id="i_grupo" value="A3a_VERDE" /><label for="i_grupo">A3a-Verde</label><br/>
						<input style="width: auto;" type="radio" name="n_grupo[]" id="i_grupo" value="A4_AZUL" /><label for="i_grupo">A4-Azul</label><br/>
						<input style="width: auto;" type="radio" name="n_grupo[]" id="i_grupo" value="A4_VERDE" /><label for="i_grupo">A4-Verde</label><br/><br/>
						</p>
						<input type="submit" value="Gerar"/>
					</fieldset>
				</form>
			<?php
	    	}
  		}
  		else
  		{
  			echo "Erro ";
  			?><br/><a href="ferramentas.php">Voltar</a><?php
  		}
		?>
		</div>
		<footer id="bot">
			<?php include("footer.php"); ?>
		</footer>
	</div>

</body>

</html>