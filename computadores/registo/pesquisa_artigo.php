<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="description" content="Sublime project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="styles/contact.css">
    <link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
</
<title>Bit.Estig</title>
</head>
<body> 

	<?php
	// ------------ pesquisar artigo ---------------
	if(isset($_REQUEST['pesquisar'])) {
	// ligacao a base de dados
	include ('config.php');
	
	// pesquisar termo inserido
	$termo_pesquisa = '%'.$_POST['termo_pesquisa'].'%';
	$sql_artigo = "SELECT * FROM produto WHERE nome LIKE '$termo_pesquisa'";
	$consulta = mysqli_query($sql_artigo);
	$resultado = mysqli_num_rows($consulta);
	
	if ($resultado != 0) {
	echo "<table width='800 px' border='1' align='center'>";
	echo "<th>Artigos encontrados na pesquisa com o termo ".$_POST['termo_pesquisa']."</th>";
	// apresenta artigos disponiveis
	while ($mostrar = mysqli_fetch_array($consulta)) {
	echo "<table width='800 px' border='1' align='center'>";
		echo "<tr>";
		echo "<td align='center' width='100' height='100' valign='middle'>
		<img src='$pasta_imagens".$mostrar['nome']."' border='0'></td>";
		echo "<td><align='center'>".$mostrar['codigo']."</a></br>EUR ".$mostrar['preco']." 
		</br>".$mostrar['descricao']."</td>";
		echo "<td width='200' align='left' valign='middle'></br><a href='comprar.php?
		id_artigo=".$mostrar['id']."'><img border=0 src='icones/carrinho.jpg'></td></tr>";
		echo "</table>";
	}}		
	else {
	echo "<table width='800 px' border='1' align='center'>";
	echo "<td align='center'>Nao foram encontrados artigos que correspondam ao criterio!"; }
	}
	?>
	<table width='800 px' border='1' align='center'>
	<form id="form_registo" name="form_registo" method="POST" action="pesquisa_artigo.php">
    <td>Pesquisar...<input type="text" name="termo_pesquisa" size="20" /> (campo obrigatorio) </td>
    <p><td><input type="submit" name="pesquisar" id="pesquisar" value="Pesquisar" />
	<input type="reset" name="apagar" id="apagar" value="Apagar" /></td></tr>
	</form>
	
	</table>
</body>
</html>