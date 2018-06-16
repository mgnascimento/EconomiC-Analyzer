<?php
/**
 * Created by PhpStorm.
 * User: Maria Gabriela
 * Date: 13/06/2018
 * Time: 01:36
 */


require_once "db/conexao.php";
require_once "vendor/mpdf/mpdf/mpdf.php";

class benCity extends Mpdf
{
    private function getTabela(){

        global $pdo;


        $color  = false;
        $retorno = "<h2>Relatório - Lista de Beneficiários</h2>";;

        $retorno .= "<h2 style=\"text-align:center\">{$this->titulo}</h2>";
        $retorno .= "<table width='1000' align='center'>  
           <tr class='header'>  
            <th>Beneficiário</th>
            <th>NIS</th>
            <th>Cidade</th>
            <th>Código</th>
            <th>Estado</th>
            <th>UF</th>
            <th>Região</th>

           </tr>";

        $sql = "SELECT P.id_payment, P.tb_beneficiaries_id_beneficiaries, P.tb_city_id_city, B.id_beneficiaries, B.str_name_person,
                B.str_nis, 
                C.id_city, C.str_name_city, C.str_cod_siafi_city, C.tb_state_id_state, 
                E.id_state, E.str_uf, E.str_name, E.tb_region_id_region,
                R.id_region, R.str_name_region
                FROM tb_payments P, tb_beneficiaries B, tb_city C, tb_state E, tb_region R
                WHERE P.tb_beneficiaries_id_beneficiaries=B.id_beneficiaries AND P.tb_city_id_city = C.id_city 
                AND  C.tb_state_id_state=E.id_state AND E.tb_region_id_region=R.id_region ORDER BY C.str_name_city, B.str_name_person";

        foreach ($pdo->query($sql) as $reg):
            $retorno .= ($color) ? "<tr>" : "<tr class=\"zebra\">";
            $retorno .= "<td>{$reg['str_name_person']}</td>";
            $retorno .= "<td>{$reg['str_nis']}</td>";
            $retorno .= "<td>{$reg['str_name_city']}</td>";
            $retorno .= "<td>{$reg['str_cod_siafi_city']}</td>";
            $retorno .= "<td>{$reg['str_name']}</td>";
            $retorno .= "<td>{$reg['str_uf']}</td>";
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