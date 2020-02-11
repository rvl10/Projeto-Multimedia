<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title>BIT ESTiG</title>


</head>
<body>
<?php
// Include config file
require_once "../ligacao_bd.php";

// Define variables and initialize with empty values
$categoria = "";
$categoria_err = "";


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


// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $categoria_err = "Introduza uma categoria.";
    } else {
        $categoria = trim($_POST["username"]);
    }
    // Check input errors before inserting in database
    if (empty($categoria_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO categoria (nome) VALUES (?)";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_categoria);

            // Set parameters
            $param_categoria = $categoria;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                echo "Categoria adicionada com sucesso!";
            } else {
                echo "Ocorreu um erro. Por favor tente mais tarde.";
                echo mysqli_error($link);
            }
        } else {
            echo mysqli_error($link);
        }
        // Close statement

    }
}
// Close connection
mysqli_close($link);

?>
<table class="table"

<tr>
    <th scope="col">Introduza uma categoria</th>
</tr>

<th scope="row">Nome da categoria</th>

<form id="form_registo" name="form_registo" method="POST" action="adicionar_categoria.php">
    <td><input type="text" size="30" name="username" id="username"/></td>
    <p>
    <td><input type="submit" name="registar" id="registar" value="registar" class="btn btn-primary"/>
        <input class="btn btn-primary" type="reset" name="apagar" id="apagar" value="Apagar"/></td>
    </tr>
</form>
<td><p>Clique <a href="menu_admin.php">aqui</a> para voltar ao menu de administrador</p>
</td>
</tr>

</body>
</html>