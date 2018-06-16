<?php
/**
 * Created by PhpStorm.
 * User: Maria Gabriela
 * Date: 13/06/2018
 * Time: 01:36
 */

require_once "db/conexao.php";
require_once "vendor/mpdf/mpdf/mpdf.php";


class benOrderAZ extends Mpdf
{
    private function getTabela(){

        global $pdo;


        $color  = false;
        $retorno = "";

        $retorno .= "<h2 style=\"text-align:center\">{$this->titulo}</h2>";
        $retorno .= "<table width='1000' align='center'>  
           <tr class='header'>  
             <th>NIS</th>
        <th>Nome</th> 
           </tr>";

        $sql = "SELECT  * FROM tb_beneficiaries ORDER BY str_name_person";
        foreach ($pdo->query($sql) as $reg):
            $retorno .= ($color) ? "<tr>" : "<tr>";
            $retorno .= "<td>{$reg['str_nis']}</td>";
            $retorno .= "<td>{$reg['str_name_person']}</td>";
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