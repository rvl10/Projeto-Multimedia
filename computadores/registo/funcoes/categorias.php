<?php

/**
 * @param $pdo
 * @return mixed
 */
function getCategorias($pdo)
{
    $sql = "SELECT *  FROM categoria ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCategoriasByIds($pdo, $ids){
    $sql = "SELECT * FROM categoria WHERE id IN (" . $ids . ")";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}