<html lang="pt-br">
<head>
	<meta charset="UTF-8"/>
	<title>GESE</title>
	<link rel="icon" href="_imgs/icone_gese.png" type="image/x-icon" />
	<link rel="stylesheet" href="_css/estilo.css"/>
	<link rel="stylesheet" href="_css/form.css"/>
	<link rel="stylesheet" href="_css/table.css"/>
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

	<article id="mid">

<?php
function grupo_modalidade()
{
	if(!empty($_POST['n_grupo']))
	{
	    foreach($_POST['n_grupo'] as $check) 
	    {
	            return $check;
	    }
	}
}
$grupo = grupo_modalidade();

/**
 * Convert a comma separated file into an associated array.
 * The first row should contain the array keys.
 * 
 * Example:
 * 
 * @param string $filename Path to the CSV file
 * @param string $delimiter The separator used in the file
 * @return array
 * @link http://gist.github.com/385876
 * @author Jay Williams <http://myd3.com/>
 * @copyright Copyright (c) 2010, Jay Williams
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
function csv_to_array1($filename='Consumidor.csv', $delimiter=';')
{
	if(!file_exists($filename) || !is_readable($filename))
		return FALSE;
	
	$header = NULL;
	$data = array();
	if (($handle = fopen($filename, 'r')) !== FALSE)
	{
		while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
		{
			if(!$header)
				$header = array_map('trim', $row);
			else
				$data[] = array_combine($header, $row);
		}
		fclose($handle);
	}
	return $data;
}

$dados1 = csv_to_array1('Consumidor.csv');

echo "<br/>";





function csv_to_array2($filename='Tarifas.csv', $delimiter=';')
{
	if(!file_exists($filename) || !is_readable($filename))
		return FALSE;
	
	$header = NULL;
	$data = array();
	if (($handle = fopen($filename, 'r')) !== FALSE)
	{
		while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
		{
			if(!$header)
				$header = array_map('trim', $row);
			else
				$data[] = array_combine($header, $row);
		}
		fclose($handle);
	}
	return $data;
}
$dados2 = csv_to_array2('Tarifas.csv');
echo "<br/>";



foreach ($dados1 as $key => $value) {
	$dados_entrada_data[]=$value['DATA'];
}
foreach ($dados2 as $key => $value) {
	$dados_tarifas_data[]=$value['DATA'];
}


$data_tarifa = array_intersect(($dados_tarifas_data),($dados_entrada_data));
$data_entrada = array_intersect(($dados_entrada_data),($dados_tarifas_data));
$initialkey_tarifa = key($data_tarifa);
$initialkey_entrada = key($data_entrada);
end($data_tarifa);
end($data_entrada);
$endkey_tarifa = key($data_tarifa);
$endkey_entrada = key($data_entrada);


#troca , por .
for ($i=0; $i < count($dados2); $i++)
{ 
	$dados2[$i] = str_replace(",",".",$dados2[$i]);
}
for ($j=0; $j < count($dados1); $j++)
{ 
	$dados1[$j] = str_replace(".","",$dados1[$j]);
}


#separa o array multidimensional em outros
foreach ($dados1 as $key => $value) { $DCP[]=floatval($value['DCP']); }
foreach ($dados1 as $key => $value) { $DCFP[]=floatval($value['DCFP']); }
foreach ($dados1 as $key => $value) { $DMP[]=floatval($value['DMP']); }
foreach ($dados1 as $key => $value) { $DMFP[]=floatval($value['DMFP']); }
foreach ($dados1 as $key => $value) { $CP[]=floatval($value['CP']); }
foreach ($dados1 as $key => $value) { $CFP[]=floatval($value['CFP']); }

foreach ($dados2 as $key => $value) { $PIS[]=floatval($value['PIS']); }
foreach ($dados2 as $key => $value) { $COFINS[]=floatval($value['COFINS']); }

foreach ($dados2 as $key => $value) { $TUSDd_P[]=floatval($value["TUSDd_P_$grupo"]); }
foreach ($dados2 as $key => $value) { $TUSDd_FP[]=floatval($value["TUSDd_FP_$grupo"]); }
foreach ($dados2 as $key => $value) { $TUSDe_P[]=floatval($value["TUSDe_P_$grupo"]); }
foreach ($dados2 as $key => $value) { $TUSDe_FP[]=floatval($value["TUSDe_FP_$grupo"]); }
foreach ($dados2 as $key => $value) { $TE_P[]=floatval($value["TE_P_$grupo"]); }
foreach ($dados2 as $key => $value) { $TE_FP[]=floatval($value["TE_FP_$grupo"]); }




$j=$initialkey_entrada;
//verificaçao se ocorrei ultrapassagem
for ($i=$initialkey_tarifa; $i <= $endkey_tarifa; $i++) { 
	if (($DMP[$j] + $DMFP[$j]) > (($DCP[$j] + $DCFP[$j])*1.05))
	{
		$U[$j] = 1;
	} else
	{
		$U[$j] = 0;
	}
	$j++;
}





$P=1;

$ICMS=25;

$CCEE=400;
$ESS=3;
$K=3;

$j=$initialkey_entrada;
for ($i=$initialkey_tarifa; $i <= $endkey_tarifa; $i++) 
{


		if ($U[$j]==1)
		{
			$AC[$j] = (( 
						(($TE_P[$i]*$CP[$j])+($TE_FP[$i]*$CFP[$j]))/1000 + 
						(($TUSDd_P[$i]*$DMP[$j])+($TUSDd_FP[$i]*$DMFP[$j])) + 
						(($TUSDe_P[$i]*$CP[$j])+($TUSDe_FP[$i]*$CFP[$j]))/1000 
					  ) 
					  / 
					  (1-($PIS[$i]+$COFINS[$i]+$ICMS)/100))+((2*$TE_P[$i])*($DMP[$j] - $DCP[$j]) + (2*$TE_FP[$i])*($DMFP[$j] - $DCFP[$j]));
		}
		else if ($U[$j]==0)
		{
			$AC[$j] = ( 
				(($TE_P[$i]*$CP[$j])+($TE_FP[$i]*$CFP[$j]))/1000 + 
				(($TUSDd_P[$i]*$DMP[$j])+($TUSDd_FP[$i]*$DMFP[$j])) + 
				(($TUSDe_P[$i]*$CP[$j])+($TUSDe_FP[$i]*$CFP[$j]))/1000 
			  ) 
			  / 
			  (1-($PIS[$i]+$COFINS[$i]+$ICMS)/100);
		}

	
		

	/*	echo("<br> ( 
				(($TE_P[$i]*$CP[$j])+($TE_FP[$i]*$CFP[$j]))/1000 + 
				(($TUSDd_P[$i]*$DMP[$j])+($TUSDd_FP[$i]*$DMFP[$j])) + 
				(($TUSDe_P[$i]*$CP[$j])+($TUSDe_FP[$i]*$CFP[$j]))/1000 
			  ) 
			  / 
			  (1-($PIS[$i]+$COFINS[$i]+$ICMS)/100)");
	*/

		$AL[$j] = ( 
			( 	((($CP[$j]+$CFP[$j])/1000*(1+$K/100))*$P)+(($TUSDd_P[$i]*$DMP[$j])+($TUSDd_FP[$i]*$DMFP[$j]))+(($TUSDe_P[$i]*$CP[$j])+($TUSDe_FP[$i]*$CFP[$j]))/1000) 
				/ 
				(1-($PIS[$i]+$COFINS[$i]+$ICMS)/100) 
			) 
			+
			$CCEE+((($CP[$j]+$CFP[$j])/1000*(1+$K/100))*$ESS);

	/*	echo("<br> ( 
			( 	((($CP[$j]+$CFP[$j])*(1+$K))*$P) + (($TUSDd_P[$i]*$DMP[$j])+($TUSDd_FP[$i]*$DMFP[$j])) + (($TUSDe_P[$i]*$CP[$j])+($TUSDe_FP[$i]*$CFP[$j])) ) 
				/ 
				(1-($PIS[$i]+$COFINS[$i]+$ICMS)/100) 
			) 
			+
			$CCEE + ( (($CP[$j]+$CFP[$j])*(1+$K)) * $ESS)");
	*/

				

$j++;
}
#var_dump($AC);
#var_dump(array_sum($AC));
#var_dump($AL);
#var_dump(array_sum($AL));
#var_dump($U);
$i=$initialkey_tarifa;
$j=$initialkey_entrada;

while ($j <= $endkey_entrada) 
{

	if (($DMP[$j] + $DMFP[$j]) > (($DCP[$j] + $DCFP[$j])*1.05))
	{
		$PI[$j] =( ((($TE_P[$i]*$CP[$j])+($TE_FP[$i]*$CFP[$j]))/1000)+(((2*$TE_P[$i])*($DMP[$j] - $DCP[$j]) + (2*$TE_FP[$i])*($DMFP[$j] - $DCFP[$j]))*(1-($PIS[$i]+$COFINS[$i]+$ICMS)/100)) - ((($CCEE + ((($CP[$j]+$CFP[$j])/1000)*(1+$K/100))*$ESS))*((1-($PIS[$i]+$COFINS[$i]+$ICMS)/100))))/((($CP[$j]+$CFP[$j])/1000*(1+$K/100)));
	}
	else
	{
		$PI[$j] =( ((($TE_P[$i]*$CP[$j])+($TE_FP[$i]*$CFP[$j]))/1000) - ((($CCEE + ((($CP[$j]+$CFP[$j])/1000)*(1+$K/100))*$ESS))*((1-($PIS[$i]+$COFINS[$i]+$ICMS)/100))))/((($CP[$j]+$CFP[$j])/1000*(1+$K/100)));
	}

	/*while(
			(	( 
				(($TE_P[$i]*$CP[$j])+($TE_FP[$i]*$CFP[$j]))/1000 + 
				(($TUSDd_P[$i]*$DMP[$j])+($TUSDd_FP[$i]*$DMFP[$j])) + 
				(($TUSDe_P[$i]*$CP[$j])+($TUSDe_FP[$i]*$CFP[$j]))/1000 
				) 
			  / 
				(1-($PIS[$i]+$COFINS[$i]+$ICMS)/100)
		 	)
			>
			(((
			((($CP[$j]+$CFP[$j])/1000*(1+$K/100))*$P)+
			(($TUSDd_P[$i]*$DMP[$j])+($TUSDd_FP[$i]*$DMFP[$j]))+
			(($TUSDe_P[$i]*$CP[$j])+($TUSDe_FP[$i]*$CFP[$j]))/1000
			) 
			/ 
			(1-($PIS[$i]+$COFINS[$i]+$ICMS)/100) 
			) 
			+
			$CCEE+((($CP[$j]+$CFP[$j])/1000*(1+$K/100))*$ESS)
			)
			)
			{
				$P=$P+0.01;
			} */
			
			#echo "<br/>Para indiferença no mes de $data_entrada[$j], P = ";
			#echo number_format($P,2,",",".");
$i++;
$j++;
} 
$messes = count(array_filter($PI));
$mediapi = array_sum($PI)/($messes);

#var_dump($PI);
?>
<p style="text-align:center;">
<?php
echo "<br/><br/>O preço de indiferença médio para o período de $messes messes é ",number_format($mediapi,2,",",".");
echo " R$/kWh";
?>
</p>
<?php
/*
?>

<table id="dados">
     <tr id="titulos">
     	<td><?php echo "DATA"; ?></td>
     	<td ><?php echo "COFINS"; ?></td>
     	<td ><?php echo "PIS"; ?></td>

     	<td ><?php echo "TUSDd_P_A2_AZUL"; ?></td>
     	<td ><?php echo "TUSDd_FP_A2_AZUL"; ?></td>
     	<td ><?php echo "TUSDe_P_A2_AZUL"; ?></td>
     	<td ><?php echo "TUSDe_FP_A2_AZUL"; ?></td>
     	<td ><?php echo "TE_P_A2_AZUL"; ?></td>
		<td ><?php echo "TE_FP_A2_AZUL"; ?></td>
     	
     	<td ><?php echo "TUSDd_P_A3_AZUL"; ?></td>
     	<td ><?php echo "TUSDd_FP_A3_AZUL"; ?></td>
     	<td ><?php echo "TUSDe_P_A3_AZUL"; ?></td>
     	<td ><?php echo "TUSDe_FP_A3_AZUL"; ?></td>
     	<td ><?php echo "TE_P_A3_AZUL"; ?></td>
     	<td ><?php echo "TE_FP_A3_AZUL"; ?></td>
     	
     	<td ><?php echo "TUSDd_P_A3a_AZUL"; ?></td>
     	<td ><?php echo "TUSDd_FP_A3a_AZUL"; ?></td>
     	<td ><?php echo "TUSDe_P_A3a_AZUL"; ?></td>
     	<td ><?php echo "TUSDe_FP_A3a_AZUL"; ?></td>
     	<td ><?php echo "TE_P_A3a_AZUL"; ?></td>
     	<td ><?php echo "TE_FP_A3a_AZUL"; ?></td>
     	
     	<td ><?php echo "TUSDd_P_A3a_VERDE"; ?></td>
     	<td ><?php echo "TUSDd_FP_A3a_VERDE"; ?></td>
     	<td ><?php echo "TUSDe_P_A3a_VERDE"; ?></td>
     	<td ><?php echo "TUSDe_FP_A3a_VERDE"; ?></td>
     	<td ><?php echo "TE_P_A3a_VERDE"; ?></td>
     	<td ><?php echo "TE_FP_A3a_VERDE"; ?></td>
		
		<td ><?php echo "TUSDd_P_A4_AZUL"; ?></td>
     	<td ><?php echo "TUSDd_FP_A4_AZUL"; ?></td>
     	<td ><?php echo "TUSDe_P_A4_AZUL"; ?></td>
     	<td ><?php echo "TUSDe_FP_A4_AZUL"; ?></td>
     	<td ><?php echo "TE_P_A4_AZUL"; ?></td>
     	<td ><?php echo "TE_FP_A4_AZUL"; ?></td>
     	
     	<td ><?php echo "TUSDd_P_A4_VERDE"; ?></td>
     	<td ><?php echo "TUSDd_FP_A4_VERDE"; ?></td>
     	<td ><?php echo "TUSDe_P_A4_VERDE"; ?></td>
     	<td ><?php echo "TUSDe_FP_A4_VERDE"; ?></td>
     	<td ><?php echo "TE_P_A4_VERDE"; ?></td>
     	<td ><?php echo "TE_FP_A4_VERDE"; ?></td>
     </tr>

<?php 
	foreach($dados as $tipodedado => $dado) 
	{ 
?>
     <tr>
     	<td><?php print_r ($dado['DATA']); ?></td>
     	<td><?php print_r ($dado['PIS']); ?></td>
     	<td><?php print_r ($dado['COFINS']); ?></td>

     	<td><?php print_r ($dado['TUSDd_P_A2_AZUL']); ?></td>
     	<td><?php print_r ($dado['TUSDd_FP_A2_AZUL']); ?></td>
     	<td><?php print_r ($dado['TUSDe_P_A2_AZUL']); ?></td>
      	<td><?php print_r ($dado['TUSDe_FP_A2_AZUL']); ?></td>
      	<td><?php print_r ($dado['TE_P_A2_AZUL']); ?></td>
       	<td><?php print_r ($dado['TE_FP_A2_AZUL']); ?></td>

      	<td><?php print_r ($dado['TUSDd_P_A3_AZUL']); ?></td>
      	<td><?php print_r ($dado['TUSDd_FP_A3_AZUL']); ?></td>
      	<td><?php print_r ($dado['TUSDe_P_A3_AZUL']); ?></td>
      	<td><?php print_r ($dado['TUSDe_FP_A3_AZUL']); ?></td>
      	<td><?php print_r ($dado['TE_P_A3_AZUL']); ?></td>
      	<td><?php print_r ($dado['TE_FP_A3_AZUL']); ?></td>

      	<td><?php print_r ($dado['TUSDd_P_A3a_AZUL']); ?></td>
      	<td><?php print_r ($dado['TUSDd_FP_A3a_AZUL']); ?></td>
      	<td><?php print_r ($dado['TUSDe_P_A3a_AZUL']); ?></td>
      	<td><?php print_r ($dado['TUSDe_FP_A3a_AZUL']); ?></td>
      	<td><?php print_r ($dado['TE_P_A3a_AZUL']); ?></td>
      	<td><?php print_r ($dado['TE_FP_A3a_AZUL']); ?></td>

      	<td><?php print_r ($dado['TUSDd_P_A3a_VERDE']); ?></td>
      	<td><?php print_r ($dado['TUSDd_FP_A3a_VERDE']); ?></td>
      	<td><?php print_r ($dado['TUSDe_P_A3a_VERDE']); ?></td>
      	<td><?php print_r ($dado['TUSDe_FP_A3a_VERDE']); ?></td>
      	<td><?php print_r ($dado['TE_P_A3a_VERDE']); ?></td>
      	<td><?php print_r ($dado['TE_FP_A3a_VERDE']); ?></td>

      	<td><?php print_r ($dado['TUSDd_P_A4_AZUL']); ?></td>
      	<td><?php print_r ($dado['TUSDd_FP_A4_AZUL']); ?></td>
      	<td><?php print_r ($dado['TUSDe_P_A4_AZUL']); ?></td>
      	<td><?php print_r ($dado['TUSDe_FP_A4_AZUL']); ?></td>
      	<td><?php print_r ($dado['TE_P_A4_AZUL']); ?></td>
      	<td><?php print_r ($dado['TE_FP_A4_AZUL']); ?></td>

      	<td><?php print_r ($dado['TUSDd_P_A4_VERDE']); ?></td>
      	<td><?php print_r ($dado['TUSDd_FP_A4_VERDE']); ?></td>
      	<td><?php print_r ($dado['TUSDe_P_A4_VERDE']); ?></td>
      	<td><?php print_r ($dado['TUSDe_FP_A4_VERDE']); ?></td>
      	<td><?php print_r ($dado['TE_P_A4_VERDE']); ?></td>
      	<td><?php print_r ($dado['TE_FP_A4_VERDE']); ?></td>
    </tr>
<?php 
	} 
*/

//Limite de ultapassagem
for ($u=0; $u < $endkey_entrada+1; $u++) 
{ 
	$LU[$u] = (($DCP[$u] + $DCFP[$u])*1.05);
}

?> 
	<div id="conteudo-right">
<?php 
include'graph1.php';
?> 
	</div>
<?php 



for ($d=0; $d <= $endkey_entrada ; $d++) { 
	$array[$d] = array($data_entrada[$d],$PI[$d]);
}
?>

<div id="conteudo-left">
<table id="dadosg">
     <tr id="titulos">
     	<td><?php echo "MÊS"; ?></td>
     	<td ><?php echo "PI"; ?></td>
     </tr>
<?php
array_shift($data_entrada);
array_shift($PI);
	for($i=0; $i <= $endkey_entrada; $i++) 
	{
?>
     <tr>
     	<td><?php print_r ($data_entrada[$i]); ?></td>
     	<td><?php print_r (number_format(($PI[$i]),2,",",".")); ?></td>
    </tr>
<?php 
	}
?>
</table>
</div>





<table id="dados">
     <tr id="titulos">
     	<td><?php echo "DATA"; ?></td>
     	<td ><?php echo "Demanda Contratada na Ponta [kW]"; ?></td>
     	<td ><?php echo "Demanda Contratada Fora da Ponta [kW]"; ?></td>
     	<td ><?php echo "Demanda Medida na Ponta [kW]"; ?></td>
     	<td ><?php echo "Demanda Medida Fora da Ponta [kW]"; ?></td>
     	<td ><?php echo "Consumo na Ponta [kWh]"; ?></td>
     	<td ><?php echo "Consumo Fora da Ponta [kWh]"; ?></td>
     </tr>

<?php 
	foreach($dados1 as $tipodedado => $dado) 
	{ 
?>
     <tr>
     	<td><?php print_r ($dado['DATA']); ?></td>
     	<td><?php print_r ($dado['DCP']); ?></td>
     	<td><?php print_r ($dado['DCFP']); ?></td>
     	<td><?php print_r ($dado['DMP']); ?></td>
     	<td><?php print_r ($dado['DMFP']); ?></td>
      	<td><?php print_r ($dado['CP']); ?></td>
      	<td><?php print_r ($dado['CFP']); ?></td>
    </tr>

<?php 
	} 
?>
</table>

</article>




		<footer id="bot">
			<?php include("footer.php"); ?>
		</footer>
		</div>

</body>

</html>