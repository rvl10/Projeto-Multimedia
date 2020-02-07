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


$categoria ="";
$categoria_err ="";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty(trim($_GET["id"]))){
        $categoria_err = "remova uma categoria.";
    }
    else{
        $categoria = trim($_GET["id"]);
    }
    // Check input errors before inserting in database
    if (empty($categoria_err)) {

        // Prepare an insert statement
        $sql = " DELETE FROM categoria where  id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_categoria);

            // Set parameters
            $param_categoria = $categoria;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                echo "Categoria removida com sucesso!";
            } else {
                echo "Ocorreu um erro. Por favor tente mais tarde.";
                echo mysqli_error($link);//
            }
        } else {
            echo mysqli_error($link);//
        }
        // Close statement

    }
}

$sql = "select id, nome  from categoria";

$result = $conn->query($sql);
if ($result->num_rows > 0) {

    // mostra os resultados

    print " <table class='table table-striped'>
<thead>
<tr>
<th scope='col'>id</th>
<th scope='col'>Categoria</th>";




    while($row = $result->fetch_assoc()) {
        print
            "<tr><td>".$row['id']."</td>
<td>".$row['nome']."</td>
<td> <align center><a href='eliminar_categoria2.php?id=".$row['id']."' class=\"btn btn-danger btn-sm\" role='button'> Eliminar</a></td>
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









</tr>
</tbody>
</table>