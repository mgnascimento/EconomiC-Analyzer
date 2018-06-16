<?php

require_once 'phplot.php';

require_once "db/conexao.php";


// Deixar em branco faz com que o grafico encaixe na janela
$grafico = new PHPlot(500,300);
// Definindo o formato final da imagem
$grafico->SetFileFormat("png");
// Definindo o titulo do grafico
$grafico->SetTitle("Quantidade beneficiarios por mes");

// Tipo do grafico
// Por ser: lines, bars, boxes, bubbles, candelesticks, candelesticks2, linepoints, ohlc, pie, points, squared, stackedarea, stackedbars, thinbarline
$grafico->SetPlotType("bars");
// Titulo dos dados no eixo Y
$grafico->SetYTitle("Quan");
// Titulo dos dados no eixo X
$grafico->SetXTitle("Mes");


//$sql = "SELECT SUM(tb_beneficiaries_id_beneficiaries) as total, P.int_month, P.tb_city_id_city, C.id_city, C.tb_state_id_state, S.id_state,
//S.str_name FROM tb_payments P, tb_city C, tb_state S WHERE P.tb_city_id_city = C.id_city AND C.tb_state_id_state = S.id_state GROUP BY
//P.int_month, str_name";
$sql = "SELECT  int_month, count(tb_beneficiaries_id_beneficiaries) as total FROM tb_payments group by int_month";
$statement = $pdo->prepare($sql);
$statement->execute();
$dados = $statement->fetchAll(PDO::FETCH_ASSOC);
//seta os dados
$grafico->SetDataValues($dados);


$grafico->DrawGraph();
?>