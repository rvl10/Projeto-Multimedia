<?php

function getSubCategorias($pdo)
{
    $sql = "SELECT *  FROM sub_categoria ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getSubCategoriasByIds($pdo, $ids)
{
    $sql = "SELECT * FROM sub_categoria WHERE id IN (" . $ids . ")";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}