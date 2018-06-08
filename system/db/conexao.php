<?php
/**
 * Created by PhpStorm.
 * User: Maria Gabriela
 * Date: 10/05/2018
 * Time: 10:11
 */


try {
    $pdo = new PDO('mysql:host=localhost;dbname=db_eca', 'root', 'root');
    $pdo->exec("set names utf8");
} catch ( PDOException $e ) {
    echo 'Erro ao conectar com o Banco: ' . $e->getMessage();
    exit(1);
}