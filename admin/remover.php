<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "categorias";
// cria a ligação
$conn = new mysqli($servername, $username, $password, $dbname);
// testa a ligação
if ($conn->connect_error) {
    die("Erro de ligação à base de dados:" . $conn->connect_error);
}
$sql = "select id, categoria  from categoria";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
 // mostra os resultados
 print "<table class='table table-striped'>
<thead>
<tr>
<th scope='col'>id</th>
<th scope='col'>Categoria</th>";




 while($row = $result->fetch_assoc()) {
 print
"<tr><td>".$row['id']."</td>
<td>".$row['categoria']."</td>
<td> <align center><input class=\"btn btn-danger\" type='submit' value='Eliminiar' </td>
 </tr>";

 }
 print "</tbody></table>";
} else {
 echo "Sem resultados.";
}
$conn->close();
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<form name="eliminar" method="post" action="remover_categoria.php"</form>
<input type="submit" value="eliminar" name="Eliminar"/>
<form id="form_registo" name="form_registo" method="POST" action="remover_categoria.php">