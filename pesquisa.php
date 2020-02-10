<?php

// ------------ pesquisar artigo ---------------
if (isset($_REQUEST['pesquisar'])) {
    // ligacao a base de dados
    include('ligacao_bd.php');

    // pesquisar termo inserido
    $termo_pesquisa = '%' . $_POST['termo_pesquisa'] . '%';
    $sql_artigo = "SELECT * FROM produto WHERE nome LIKE '$termo_pesquisa'";
    $consulta = mysqli_query($sql_artigo);
    $resultado = mysqli_num_rows($consulta);

    if ($resultado != 0) {
        echo "<table width='800 px' border='1' align='center'>";
        echo "<th>Artigos encontrados na pesquisa com o termo " . $_POST['termo_pesquisa'] . "</th>";
        // apresenta artigos disponiveis
        while ($mostrar = mysqli_fetch_array($consulta)) {
            echo "<table width='800 px' border='1' align='center'>";
            echo "<tr>";
            echo "<td align='center' width='100' height='100' valign='middle'>
		<img src='$pasta_imagens" . $mostrar['nome'] . "' border='0'></td>";
            echo "<td><align='center'>" . $mostrar['codigo'] . "</a></br>EUR " . $mostrar['preco'] . " 
		</br>" . $mostrar['descricao'] . "</td>";
            echo "<td width='200' align='left' valign='middle'></br><a href='comprar.php?
		id_artigo=" . $mostrar['id'] . "'><img border=0 src='icones/carrinho.jpg'></td></tr>";
            echo "</table>";
        }
    } else {
        echo "<table width='800 px' border='1' align='center'>";
        echo "<td align='center'>Nao foram encontrados artigos que correspondam ao criterio!";
    }
}
