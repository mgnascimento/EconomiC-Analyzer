<?php
/**
 * Created by PhpStorm.
 * User: Maria Gabriela
 * Date: 13/06/2018
 * Time: 01:37
 */

require_once "db/conexao.php";
require_once "vendor/mpdf/mpdf/mpdf.php";

class benValor extends Mpdf
{

    private function getTabela(){

        global $pdo;


        $color  = false;
        $retorno = "<h2>Relatório - Soma Por Beneficiário Que Receberam Auxilio</h2>";;

        $retorno .= "<h2 style=\"text-align:center\">{$this->titulo}</h2>";
        $retorno .= "<table width='1000' align='center'>  
           <tr class='header'>  
             <th>Total</th>
             <th>Auxilio</th>
             <th>Mes</th>
             <th>Valor</th>
        
           </tr>";

        $sql = "SELECT SUM(tb_beneficiaries_id_beneficiaries) as Total, P.tb_source_id_source, P.int_month, P.db_value, SC.id_source, 
SC.str_goal FROM tb_payments P, tb_source SC
WHERE P.tb_source_id_source = SC.id_source GROUP BY SC.str_goal";
        foreach ($pdo->query($sql) as $reg):
            $retorno .= ($color) ? "<tr>" : "<tr class=\"zebra\">";
            $retorno .= "<td>{$reg['Total']}</td>";
            $retorno .= "<td>{$reg['str_goal']}</td>";
            $retorno .= "<td>{$reg['int_month']}</td>";
            $retorno .= "<td>{$reg['db_value']}</td>";

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