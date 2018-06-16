<?php
/**
 * Created by PhpStorm.
 * User: Maria Gabriela
 * Date: 13/06/2018
 * Time: 01:37
 */


require_once "db/conexao.php";
require_once "vendor/mpdf/mpdf/mpdf.php";

class somaBen extends Mpdf
{
    private function getTabela(){

        global $pdo;

        $color  = false;
        $retorno = "<h2>Relatório - Beneficiário e Total por Cidade</h2>";
        $retorno .= "<h2>{$this->titulo}</h2>";
        $retorno .= "<table width='1000'>  
           <tr>  
             <th>Beneficiários</th>
             <th>Cidade</th>
             <th>Total por Cidade</th>
             <th>Mês</th>
        
           </tr>";

               $sql = "SELECT SUM(db_value) as Total, SUM(tb_beneficiaries_id_beneficiaries) as Tot,
 P.tb_city_id_city, P.int_month, C.id_city, C.str_name_city 
FROM tb_payments P, tb_city C
WHERE C.id_city = P.tb_city_id_city GROUP BY C.str_name_city, P.int_month ORDER BY db_value DESC";
        foreach ($pdo->query($sql) as $reg):
            $retorno .= ($color) ? "<tr>" : "<tr>";
            $retorno .= "<td>{$reg['Tot']}</td>";
            $retorno .= "<td>{$reg['str_name_city']}</td>";
            $retorno .= "<td>{$reg['Total']}</td>";
            $retorno .= "<td>{$reg['int_month']}</td>";
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