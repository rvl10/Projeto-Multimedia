<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}

// Include config file
require_once "ligacao_bd.php";

// Define variables and initialize with empty values
$utilizador = $password = "";
$utilizador_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $utilizador_err = "Introduza o nome de utilizador.";
    } else{
        $utilizador = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Introduza a password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($utilizador_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, utilizador, password FROM utilizadores WHERE utilizador = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_utilizador);

            // Set parameters
            $param_utilizador = $utilizador;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $utilizador;

                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "A password que introduziu não é valida";
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $utilizador_err = "Conta não encontrada com esse utilizador.";
                }
            } else {
                echo "Ocorreu um erro. Por favor tente mais tarde.";
                echo mysqli_error();// }
            }
        }
            // Close statement
            mysqli_stmt_close($stmt);
        }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="login.css"/>
</head>
<header class="header">
    <div class="header_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_content d-flex flex-row align-items-center justify-content-start">
                        <div class="logo"><a href="/exercicio15/index.php"><img height="40%" src="images/logo.jpg"
                                                                                width="20%" alt=""></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<body>
<section id="login">
    <h2>Login</h2>
    <p>Por favor preencha os campos para efetuar o login.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($utilizador_err)) ? 'has-error' : ''; ?>">
            <label>Utilizador</label>
            <input type="text" name="username" class="form-control" value="<?php echo $utilizador; ?>">
            <span class="help-block"><?php echo $utilizador_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>
    </form>
</section>
<section id="vantagens"><h2> Vantagens Bit.Estig</h2>
    <p></p>
    <div><img src="images/carro1.jpg" alt="" width="width" height="height"> Produtos com entregas gratuitas.</div>
    <p></p>
    <div><img src="images/cartao1.jpg" alt="" width="width" height="height"> Compre online e levante em loja.</div>
    <p></p>
    <div><img src="images/euro.jpg" alt="" width="width" height="height"> Preço mínimo garantido.</div>
    <p></p>
    <section id="registo"><h2>Ainda não tem conta</h2>
        <p></p>Se ainda não tem conta crie aqui e comece a tirar partido das melhores vantagens Bit.Estig.
        <a href="register.php" class="btn btn-primary">Criar conta</a>
        <p></p>
    </section>
</section>
<footer>
    <img src="images/logo2.jpg">
</footer>
<img src="images/pagamentos1.png" align="right">
</body>
</html>