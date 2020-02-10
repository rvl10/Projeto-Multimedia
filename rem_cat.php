<!--TODO: FIX -->
<?php
// liga��o base dados
require('ligacao_bd.php');

// consulta para apagar evento registado
$sql = "DELETE FROM categoria WHERE categoria = " . $_GET['categoria'];
$consulta = mysqli_query($sql);
header("Location: menu_admin.php");
exit;

?>