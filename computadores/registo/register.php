<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$utilizador = $password = $confirm_password = $nome = $email = $telefone = $nif = $data_nascimento = $morada = $localidade = $codigo_postal = $Tipo_Utilizador_id ="";
$utilizador_err = $password_err = $confirm_password_err = $nome_err = $email_err = $telefone_err = $nif_err = $data_nascimento_err = $morada_err = $localidade_err = $codigo_postal_err = $Tipo_Utilizador_id_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $utilizador_err = "Introduza o nome de utilizador.";
    }
    else {
        // Prepare a select statement
        $sql = "SELECT id FROM utilizador WHERE nome = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_utilizador);

            // Set parameters
            $param_utilizador = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $utilizador_err = "Este utilizador já existe.";
                } else {
                    $utilizador = trim($_POST["username"]);
                }
            } else {
                echo "Ocorreu um erro. Por favor tente mais tarde.";
                echo mysqli_error();//
            }
        }
        else {
            echo mysqli_error();//
        }
            // Close statement
            mysqli_stmt_close($stmt);
        }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Introduza a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "A password tem de ter pelo menos 6 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Por favor confirme a password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password não coincide.";
        }
    }
// Validate nome
    if(empty(trim($_POST["nome"]))){
        $nome_err = "Introduza o seu nome.";
    }
     else{
        $nome = trim($_POST["nome"]);
    }
     // Validate email
if(empty(trim($_POST["email"]))){
    $email_err = "Introduza o seu email.";
}
else {
    $email = trim($_POST["email"]);
}
    // Validate telefone
if(empty(trim($_POST["telefone"]))){
    $telefone_err = "Introduza o seu telefone.";
}
else {
    $telefone = trim($_POST["telefone"]);
}
// Validate nif
    if(empty(trim($_POST["nome"]))){
        $nome_err = "Introduza o seu nome.";
    }
    else{
        $nome = trim($_POST["nome"]);
    }
    // Validate data_nascimento
    if(empty(trim($_POST["nome"]))){
        $nome_err = "Introduza o seu nome.";
    }
    else{
        $nome = trim($_POST["nome"]);
    }
    // Validate morada
    if(empty(trim($_POST["nome"]))){
        $nome_err = "Introduza o seu nome.";
    }
    else{
        $nome = trim($_POST["nome"]);
    }
    // Validate localidade
    if(empty(trim($_POST["nome"]))){
        $nome_err = "Introduza o seu nome.";
    }
    else{
        $nome = trim($_POST["nome"]);
    }
    // Validate codigo_postal
    if(empty(trim($_POST["nome"]))){
        $nome_err = "Introduza o seu nome.";
    }
    else{
        $nome = trim($_POST["nome"]);
    }
    // Validate tipo utilizador
    if(empty(trim($_POST["nome"]))){
        $nome_err = "Introduza o seu nome.";
    }
    else{
        $nome = trim($_POST["nome"]);
    }
    // Check input errors before inserting in database
    if(empty($utilizador_err) && empty($password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO utilizador (utilizador, password, nome, email, telefone, nif, data_nascimento, morada, localidade, codigo_postal, Tipo_Utilizador_id) VALUES ( ".$_POST['nome_login'].",".$_POST['palavra_passe'].",".$_POST['primeiro_nome'].",".$_POST['apelido'].",".$_POST['endereco'].",".$_POST['localidade'].",".$_POST['codigo_postal'].",".$_POST['telefone'].",".$_POST['email'].",  3) ";

        if($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssss", $param_utilizador, $param_password, $param_nome, $param_email, $param_telefone,$param_nif,$param_data_nascimento,$param_morada,$param_localidade,$param_codigo_postal,$param_Tipo_Utilizador_id);

            // Set parameters
            $param_utilizador = $utilizador;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_nome = $nome;
            $param_email = $email;
            $param_telefone = $telefone;
            $param_nif = $nif;
            $param_data_nascimento = $data_nascimento;
            $param_morada = $morada;
            $param_localidade = $localidade;
            $param_codigo_postal = $codigo_postal;
            $param_Tipo_Utilizador_id = $Tipo_Utilizador_id;
            

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: ../computador.php");
            } else {
                echo "Ocorreu um erro. Por favor tente mais tarde.";
                echo mysqli_error($link);//
            }
        }
        else {
            echo mysqli_error($link);//
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
    <title>Registar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 650px; padding: 20px; }
    </style>
</head>
<body>
<div class="wrapper">
    <h2>Criar conta</h2>
    <p>Por favor preencha os seguintes campos para criar uma conta.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($utilizador_err)) ? 'has-error' : ''; ?>">
            <label>Utilizador</label>
            <input type="text" name="username" class="form-control" value="<?php echo $utilizador; ?>">
            <span class="help-block"><?php echo $utilizador_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <label>Confirmar Password</label>
            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($nome_err)) ? 'has-error' : ''; ?>">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>">
            <span class="help-block"><?php echo $nome_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
            <span class="help-block"><?php echo $email_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($telefone_err)) ? 'has-error' : ''; ?>">
            <label>Telefone</label>
            <input type="text" name="telefone" class="form-control" value="<?php echo $telefone; ?>">
            <span class="help-block"><?php echo $telefone_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($nif_err)) ? 'has-error' : ''; ?>">
            <label>Nif</label>
            <input type="text" name="telefone" class="form-control" value="<?php echo $nif; ?>">
            <span class="help-block"><?php echo $nif_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($data_nascimento_err)) ? 'has-error' : ''; ?>">
                <label>Data Nascimento</label>
            <input type="text" name="telefone" class="form-control" value="<?php echo $data_nascimento; ?>">
            <span class="help-block"><?php echo $data_nascimento_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($morada_err)) ? 'has-error' : ''; ?>">
            <label>Morada</label>
            <input type="text" name="telefone" class="form-control" value="<?php echo $morada; ?>">
            <span class="help-block"><?php echo $morada_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($localidade_err)) ? 'has-error' : ''; ?>">
            <label>Localidade</label>
            <input type="text" name="telefone" class="form-control" value="<?php echo $localidade; ?>">
            <span class="help-block"><?php echo $localidade_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($codigo_postal_err)) ? 'has-error' : ''; ?>">
            <label>Codigo_Postal</label>
            <input type="text" name="telefone" class="form-control" value="<?php echo $codigo_postal; ?>">
            <span class="help-block"><?php echo $codigo_postal_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submeter">
            <input type="reset" class="btn btn-default" value="Cancelar">
        </div>
        <p>Já tem uma conta? <a href="login.php">Entre aqui!</a></p>
    </form>
</div>
</body>
</html>