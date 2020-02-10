<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "ligacao_bd.php";
 
// Define variables and initialize with empty values
$email = $telefone ="";
$email_err = $telefone_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["Email"]))){
        $email_err = "Insira um Email.";
    }else{
        $email = trim($_POST["Email"]);
    }

    if(empty(trim($_POST["Telefone"]))){
        $telefone_err = "Insira um Telefone.";
    }else{
        $telefone = trim($_POST["Telefone"]);
    }
        
    // Check input errors before updating the database
    if(empty($email_err) && empty($telefone_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET email = ?, phone = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sii", $param_email, $param_telefone, $param_id);
            
            // Set parameters
            $param_email = $email;
            $param_telefone = $telefone;
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // pdated successfully.  redirect to welcome page
                header("location: welcome.php");
                exit;
            } else{
                echo "Algo deu errado. Por favor, tente novamente mais tarde.";
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
    <title>Dados</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 650px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Informações Pessoais</h2>
        <p>Preencha os campos para alterar as suas informações.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" name="Email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($telefone_err)) ? 'has-error' : ''; ?>">
                <label>Telefone</label>
                <input type="text" name="Telefone" class="form-control" value="<?php echo $telefone; ?>">
                <span class="help-block"><?php echo $telefone_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submeter">
                <a class="btn btn-link" href="welcome.php">Cancelar</a>
            </div>
        </form>
    </div>    
</body>
</html>