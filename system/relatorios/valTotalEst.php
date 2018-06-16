<?php
/**
 * Created by PhpStorm.
 * User: Maria Gabriela
 * Date: 13/06/2018
 * Time: 01:38
 */


require_once "db/conexao.php";
require_once "vendor/mpdf/mpdf/mpdf.php";


class valTotalEst extends Mpdf
{


    private function getTabela()
    {

        global $pdo;


        $color = false;
        $retorno = "<h2>Relatório - Valor Total por Estado</h2>";

        $retorno .= "<h2 style=\"text-align:center\">{$this->titulo}</h2>";
        $retorno .= "<table width='1000' align='center'>  
           <tr class='header'>  
             <th>Valor Total</th>  
             <th>Estado </th>  
             
           </tr>";

        $sql = "SELECT SUM(db_value) as Total, P.tb_city_id_city, C.id_city, C.tb_state_id_state, S.id_state, S.str_name
FROM tb_payments P, tb_city C, tb_state S
WHERE C.id_city = P.tb_city_id_city AND C.tb_state_id_state=S.id_state GROUP BY S.str_name ORDER BY S.str_name";
        /*LEFT JOIN tb_beneficiaries ON tb_beneficiaries.id_beneficiaries = tb_payment.tb_beneficiaries_id_beneficiaries*/
        foreach ($pdo->query($sql) as $reg):
            $retorno .= ($color) ? "<tr>" : "<tr class=\"zebra\">";
            $retorno .= "<td>{$reg['Total']}</td>";
            $retorno .= "<td>{$reg['str_name']}</td>";
            $retorno .= "<tr>";
            $color = !$color;
        endforeach;

        $retorno .= "</table>";
        return $retorno;
    }

        public function BuildPDF()
        {

            $mpdf = new mPDF();

            $mpdf->SetDisplayMode('fullpage');
            $css = file_get_contents("assets/css/estilo.css");
            $mpdf->WriteHTML($css, 1);
            $mpdf->WriteHTML($this->getTabela());
            $mpdf->Output();
        }



}