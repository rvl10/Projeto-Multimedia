<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrador</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="page-header">
    <h1> Painel de administrador</h1>
</div>
<p>
    <?php
    // inicia sessao
    session_start();

    // verifica se o utilizador ja realizou o acesso
    if (!isset($_SESSION['loggedin'])) {
        echo "<tr>Não esta logado faça login! </tr>";
        echo "<tr><a href='../login.php'>Clique para logar!</a></tr>";
    } else {
// verifica nivel de utilizador e atribui variavel
        if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
            $iduser = $_SESSION['id'];
            require_once "../ligacao_bd.php";
            $sql = "select Tipo_Utilizador_id  from utilizador where id = $iduser and Tipo_Utilizador_id = 1";
            $result = $link->query($sql);
            if ($result->num_rows == 1) {
                //ok
                print "  <a href=\"adicionar_categoria.php\" class=\"btn btn-primary\">Adicionar Categoria</a>
    <a href=\"adicionar_sub_categoria.php\" class=\"btn btn-primary\">Adicionar Sub Categoria</a>
    <a href=\"remover_categoria.php\" class=\"btn btn-danger\">Remover Categoria</a>
    <a href=\"remover_sub_categoria.php\" class=\"btn btn-danger\">Remover Sub Categoria</a>
    <a href=\"sair.php\" class=\"btn btn-danger\">Sair</a>";
            } else {
                header("location: ../welcome.php");
                echo "<tr>Nao esta autorizado a aceder a esta pagina! </tr>";
                echo "<tr><a href='../login.php'>Clique para logar!</a></tr>";
            }
        }

    }
    ?>

</p>
</body>
</html>

