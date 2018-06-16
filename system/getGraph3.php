<?php

require_once 'phplot.php';

require_once "db/conexao.php";

//$plot->SetImageBorderType('plain');
//
//$plot->SetPlotType('pie');
//$plot->SetDataType('text-data-single');
//$plot->SetDataValues($dados);
//
//# Set enough different colors;
//$plot->SetDataColors(array('red', 'green'));
//
//# Main plot title:
//$plot->SetTitle("World Gold Production, 1990\n(1000s of Troy Ounces)");
//
//# Build a legend from our data array.x'
//
$sql = "SELECT  int_month, count(db_value) as total FROM tb_payments group by int_month";
//
//$sql = "SELECT SUM(tb_beneficiaries_id_beneficiaries) as total, P.int_month, P.tb_city_id_city, C.id_city, C.tb_state_id_state, S.id_state,
//S.str_name FROM tb_payments P, tb_city C, tb_state S WHERE P.tb_city_id_city = C.id_city AND C.tb_state_id_state = S.id_state GROUP BY
//P.int_month";

$statement = $pdo->prepare($sql);
$statement->execute();
$dados = $statement->fetchAll(PDO::FETCH_ASSOC);
////seta os dados
//
//
//
//$plot->DrawGraph();
//
//
//$data = array(
//    array('Australia', 7849),
//    array('Dem Rep Congo', 299),
//    array('Canada', 5447),
//    array('Columbia', 944),
//    array('Ghana', 541),
//    array('China', 3215),
//    array('Philippines', 791),
//    array('South Africa', 19454),
//    array('Mexico', 311),
//    array('United States', 9458),
//    array('USSR', 9710),
//);

$plot = new PHPlot(450,250);
$plot->SetImageBorderType('plain');

$plot->SetPlotType('pie');
$plot->SetDataType('text-data-single');
$plot->SetDataValues($dados);

# Set enough different colors;
$plot->SetDataColors(array('red', 'green', 'blue', 'yellow', 'cyan',
    'magenta', 'brown', 'lavender', 'pink',
    'gray', 'orange'));

# Main plot title:
$plot->SetTitle("Valor total por mes por estado");

# Build a legend from our data array.
# Each call to SetLegend makes one line as "label: value".
foreach ($dados as $row)
    $plot->SetLegend(implode(': ', $row));
# Place the legend in the upper left corner:
$plot->SetLegendPixels(5, 5);

$plot->DrawGraph();
?>