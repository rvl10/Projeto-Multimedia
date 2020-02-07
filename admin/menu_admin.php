<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrador</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
<div class="page-header">
    <h1> Painel de administrador</h1>
</div>
<p>
    <a href="adicionar_categoria.php" class="btn btn-primary">Adicionar Categoria</a>
    <a href="adicionar_sub_categoria.php" class="btn btn-primary">Adicionar Sub Categoria</a>
    <a href="remover_categoria.php" class="btn btn-danger">Remover Categoria</a>
    <a href="sair.php" class="btn btn-danger">Sair</a>

</p>
</body>
</html>

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

<?php }



?>

</body>
</html>
