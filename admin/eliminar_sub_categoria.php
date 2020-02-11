<?php
require_once "../ligacao_bd.php";

if (isset($_GET['id'])) {

    // escreva aqui a sua query de remoção
    $sql = "DELETE FROM sub_categoria WHERE id =  " . $_GET['id'];

    // se a query de remoção for executada com sucesso
    // mensagem de ok
    // se não
    // mensagem de erro


    if ($link->query($sql) === TRUE) {
        echo 'categoria eliminada com sucesso';

    } else {
        echo 'Erro ao eliminar a categoria. ' . $link->error;
    }

    $link->close();
}
?>