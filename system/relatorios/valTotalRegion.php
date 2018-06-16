<?php

require_once "db/conexao.php";
require_once "vendor/mpdf/mpdf/mpdf.php";
/**
 * Created by PhpStorm.
 * User: Maria Gabriela
 * Date: 13/06/2018
 * Time: 01:37
 */

class valTotalRegion extends Mpdf
{

    private function getTabela(){

        global $pdo;


        $color  = false;
        $retorno = "<h2>Relatório - Valor Total por Região</h2>";;

        $retorno .= "<h2 style=\"text-align:center\">{$this->titulo}</h2>";
        $retorno .= "<table width='1000' align='center'>  
           <tr class='header'>  
             <th>Valor Total</th>  
             <th>Região </th>  
           </tr>";

        $sql = "SELECT SUM(db_value) as Total, P.tb_city_id_city, C.id_city, C.tb_state_id_state, S.id_state, S.str_name, S.tb_region_id_region, R.id_region, R.str_name_region FROM tb_payments P, tb_city C, tb_state S, tb_region R
WHERE C.id_city = P.tb_city_id_city AND C.tb_state_id_state=S.id_state AND  S.tb_region_id_region=R.id_region GROUP BY R.str_name_region ORDER BY str_name_region";

        foreach ($pdo->query($sql) as $reg):
            $retorno .= ($color) ? "<tr>" : "<tr class=\"zebra\">";
            $retorno .= "<td>{$reg['Total']}</td>";
            $retorno .= "<td>{$reg['str_name_region']}</td>";
            $retorno .= "<tr>";
            $color = !$color;
        endforeach;

        $retorno .= "</table>";
        return $retorno;
    }


    public function BuildPDF(){

        $mpdf=new mPDF();

        $mpdf->SetDisplayMode('fullpage');
        $css = file_get_contents("assets/css/estilo.css");
        $mpdf->WriteHTML($css,1);
        $mpdf->WriteHTML($this->getTabela());

        $mpdf->Output();
    }


}