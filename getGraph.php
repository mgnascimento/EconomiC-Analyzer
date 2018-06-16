<?php

require_once 'phplot.php';

require_once "db/conexao.php";


// Deixar em branco faz com que o grafico encaixe na janela
$grafico = new PHPlot(1000,300);
// Definindo o formato final da imagem
$grafico->SetFileFormat("png");
// Definindo o titulo do grafico
$grafico->SetTitle("Quantidade beneficiarios por mes por ano");
// Tipo do grafico
// Por ser: lines, bars, boxes, bubbles, candelesticks, candelesticks2, linepoints, ohlc, pie, points, squared, stackedarea, stackedbars, thinbarline
$grafico->SetPlotType("lines");
// Titulo dos dados no eixo Y
$grafico->SetYTitle("Quan");
// Titulo dos dados no eixo X
$grafico->SetXTitle("Mês");


$sql = "SELECT  int_month, count(tb_beneficiaries_id_beneficiaries) as total FROM tb_payments group by int_month";
$statement = $pdo->prepare($sql);
$statement->execute();
$dados = $statement->fetchAll(PDO::FETCH_ASSOC);
//seta os dados
$grafico->SetDataValues($dados);


$grafico->DrawGraph();
?>