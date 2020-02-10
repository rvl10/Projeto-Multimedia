<?php
// Include config file
require_once "ligacao_bd.php";

// Define variables and initialize with empty values
$nome = $codigo = $preco = $descricao = $Categoria_id = $Sub_categoria_id ="";
$nome_err = $codigo_err =$preco_err =  $descricao_err = $Categoria_id_err = $Sub_categoria_id_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){


    // Validate nome
    if(empty(trim($_POST["nome"]))){
        $nome_err = "Por favor introduza o nome do produto.";
    } else{
        $nome = trim($_POST["nome"]);

    }
    // Validate codigo
    if(empty(trim($_POST["codigo"]))){
        $codigo_err = "Introduza o codigo.";
    } elseif(strlen(trim($_POST["codigo"])) < 4){
        $codigo_err = "O codigo tem de ter pelo menos 4 caracteres.";
    } else{
        $password = trim($_POST["codigo"]);
    }

    // Validate preco
    if(empty(trim($_POST["preco"]))){
        $preco_err = "Por favor introduza o preço.";
    } else{
        $preco = trim($_POST["preco"]);

    }

    // Validate descricao
    if(empty(trim($_POST["descricao"]))){
        $descricao_err = "Introduza a descrição.";
    }
     else{
        $descricao = trim($_POST["descricao"]);
    }

    // Validate sub categoria
    if(empty(trim($_POST["sub_categoria"]))){
    $Sub_categoria_id_err = "Introduza a sub categoria.";
}
else {
    $Sub_categoria_id= trim($_POST["sub_categoria"]);
}
    // Check input errors before inserting in database
    if(empty($nome_err) && empty($codigo_err) && empty($preco_err)&& empty($descricao_err)&& empty($Categoria_id_err)&& empty($Sub_categoria_id_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO produto (nome, codigo, preco, descricao, Categoria_id, Sub_categoria_id) VALUES (?, ?,?,?,?,?)";

        if($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_nome, $param_codigo, $param_preco, $param_descricao, $param_Categoria_id, $param_Sub_categoria_id);

            // Set parameters
            $param_nome = $nome;
            $param_codigo = $codigo;
            $param_preco = $preco;
            $param_descricao = $descricao;
            $param_Categoria_id = $Categoria_id;
            $param_Sub_categoria_id= $Sub_categoria_id;

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
    <h2>Adicionar produto</h2>
    <p>Por favor preencha os seguintes campos para adicionar um produto.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <!--  nome -->
        <div class="form-group <?php echo (!empty($nome_err)) ? 'has-error' : ''; ?>">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>">
            <span class="help-block"><?php echo $nome_err; ?></span>
        </div>


        <!--  codigo -->


        <div class="form-group <?php echo (!empty($codigo_err)) ? 'has-error' : ''; ?>">
            <label>Codigo</label>
            <input type="text" name="codigo" class="form-control" value="<?php echo $codigo; ?>">
            <span class="help-block"><?php echo $codigo_err; ?></span>
        </div>



        <!--  preco-->



        <div class="form-group <?php echo (!empty($preco_err)) ? 'has-error' : ''; ?>">
            <label>Preço</label>
            <input type="text" name="preco" class="form-control" value="<?php echo $preco; ?>">
            <span class="help-block"><?php echo $preco_err; ?></span>
        </div>



        <!--  descrição -->




        <div class="form-group <?php echo (!empty($descricao_err)) ? 'has-error' : ''; ?>">
            <label>Descrição</label>
            <input type="text" name="descricao" class="form-control" value="<?php echo $descricao; ?>">
            <span class="help-block"><?php echo $descricao_err; ?></span>
        </div>



        <!--  dropdown categorias -->



        <div class="dropdown">
            <label>Categoria</label>
            <span class="help-block"></span>
            <?php
            $query = "SELECT id, nome FROM categoria";
            $result = mysqli_query($link, $query);
            ?>
            <select name="categorias">
                <option type="text" name="categoria" class="form-control" value="dropbox categorias">Escolha as categorias</option>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                   $rows[] = $row;
                }
                   foreach($rows as $row){
                       echo '<option >' .$row['nome']."</option>";
                   }

                ?>
            </select>
            <span class="help-block"><?php echo $Categoria_id_err; ?></span>
        </div>


        <!--  dropdown sub categorias -->
        <div class="dropdown">
            <label>Sub-Categoria</label>
            <span class="help-block"></span>
            <?php
            $query1 = "SELECT id, nome FROM sub_categoria";
            $result1 = mysqli_query($link, $query1);
            ?>
            <select name="sub_categorias">
                <option type="text" name="sub_categoria" class="form-control" value="dropbox sub_categorias">Escolha as sub-categorias</option>
                <?php
                while ($row1 = mysqli_fetch_array($result1)) {
                    $rows1[] = $row1;
                }
                foreach($rows1 as $row1){
                    echo '<option >' .$row1['nome']."</option>";
                }

                ?>
            </select>
            <span class="help-block"><?php echo $Sub_categoria_id_err; ?></span>
        </div>


        <div class="form-group <?php echo (!empty($Sub_categoria_id_err)) ? 'has-error' : ''; ?>">
            <label>Sub Categoria</label>
            <input type="text" name="sub_categoria" class="form-control" value="<?php echo $Sub_categoria_id; ?>">
            <span class="help-block"><?php echo $Sub_categoria_id_err; ?></span>
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