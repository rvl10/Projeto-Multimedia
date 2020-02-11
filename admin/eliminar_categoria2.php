<?php
require_once "../ligacao_bd.php";


// inicia sessao
session_start();

// verifica se o utilizador ja realizou o acesso
if (!isset($_SESSION['loggedin'])) {
    header("location: ../login.php");
} else {
// verifica nivel de utilizador e atribui variavel
    if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
        $iduser = $_SESSION['id'];
        require_once "../ligacao_bd.php";
        $sql = "select Tipo_Utilizador_id  from utilizador where id = $iduser and Tipo_Utilizador_id = 3";
        $result = $link->query($sql);
        if ($result->num_rows == 1) {
            //ok
        } else {
            header("location: ../login.php");
        }
    }

}


if (isset($_GET['id'])) {
    // escreva aqui a sua query de remoção
    $sql = "DELETE FROM categoria WHERE id =  " . $_GET['id'];
    // se a query de remoção for executada com sucesso
    // mensagem de ok
    $resultado = $link->query($sql);
    if ($resultado) // will return true if succefull else it will return false
    {
        echo "<p>Apagado com sucesso!</p>";
    } else {
        echo "<p>Erro ao apagar!</p>";
//        Debug
//        echo("Error description: " . mysqli_error($conn));
//        echo $resultado->error;
    }
}
$link->close();
?>