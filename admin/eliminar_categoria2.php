<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projeto_multimedia";

// cria a ligação
$conn = new mysqli($servername, $username, $password, $dbname);
// testa a ligação
if ($conn->connect_error) {
    die("Erro de ligação à base de dados:" . $conn->connect_error);

}

if (isset($_GET['id'])) {
    // escreva aqui a sua query de remoção
    $sql = "DELETE FROM categoria WHERE id =  " . $_GET['id'];
    // se a query de remoção for executada com sucesso
    // mensagem de ok
    $resultado = $conn->query($sql);
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
$conn->close();
?>