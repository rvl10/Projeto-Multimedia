<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Loja Virtual</title>
</head>
<body>
<?php
// inicia sessao
session_start();

// verifica se o utilizador ja realizou o acesso
if(isset($_SESSION['id_utilizador'])) {
	echo "<tr>Nao esta autorizado a aceder a esta pagina! </tr>";
	echo "<tr><a href='../index.php'>Clique para voltar a pagina inicial!</a></tr>";
	}
else {
// verifica nivel de utilizador e atribui variavel
if(isset($_SESSION['nivel_utilizador'])) {  $nivel = $_SESSION['nivel_utilizador']  ; } 

?>
	<table width="900 px" border="1" align="center">
	<td align="l">Menu de administrador BIT ESTiG</td><br />
	<tr><p><td><a href='adicionar_categoria.php'>Adicionar categoria</a>
        <p><a href='remover_categoria.php'>Remover categoria</a>
	<p><a href='adicionar_artigo.php'>Adicionar artigo</a>
	<p><a href='../estado_encomenda.php'>Ver encomendas</a>
	<p><a href='../logout.php'>Terminar sessao</a>
	</td></tr>
<?php } ?>

</body>
</html>
