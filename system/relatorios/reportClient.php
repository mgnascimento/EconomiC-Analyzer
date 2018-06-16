<?php

require_once "db/conexao.php";
require_once "vendor/mpdf/mpdf/mpdf.php";

class reportClient extends Mpdf{


    private function getTabela(){

        global $pdo;


        $color  = false;
        $retorno = "";

        $retorno .= "<h2 style=\"text-align:center\">{$this->titulo}</h2>";
        $retorno .= "<table width='1000' align='center'>  
           <tr class='header'>  
             <th>Cidade</th>
        <th>Função</th>
        <th>SubFunção</th>
        <th>Programa</th>
        <th>Ação</th>
        <th>Beneficiário</th>
        <th>Fonte</th>
        <th>Data</th>
        <th>Valor</th>  
           </tr>";

      $sql = "SELECT P.id_payment, Ct.str_name_city as tb_city, F.str_name_function as tb_functions, SB.str_name_subfunction as tb_subfunctions,
 PR.str_name_program as tb_program, A.str_name_action as tb_action, B.str_name_person as tb_beneficiaries,
  S.str_goal as tb_source, Fl.str_name_file as tb_files, int_month, int_year, db_value FROM tb_payments P
    INNER JOIN tb_city Ct ON (Ct.id_city = P.tb_city_id_city) INNER JOIN tb_functions F ON (F.id_function = P.tb_functions_id_function)
    INNER JOIN tb_subfunctions SB ON (SB.id_subfunction = P.tb_subfunctions_id_subfunction) INNER JOIN tb_program PR ON (PR.id_program = P.tb_program_id_program)
    INNER JOIN tb_action A ON (A.id_action = P.tb_action_id_action) INNER JOIN tb_beneficiaries B ON (B.id_beneficiaries = P.tb_beneficiaries_id_beneficiaries)
    INNER JOIN tb_source S On (S.id_source = P.tb_source_id_source) INNER JOIN tb_files Fl ON (Fl.id_file = P.tb_files_id_file)";
      foreach ($pdo->query($sql) as $reg):
          $retorno .= ($color) ? "<tr>" : "<tr class=\"zebra\">";
          $retorno .= "<td>{$reg['tb_city']}</td>";
          $retorno .= "<td>{$reg['tb_functions']}</td>";
          $retorno .= "<td>{$reg['tb_subfunctions']}</td>";
          $retorno .= "<td>{$reg['tb_program']}</td>";
          $retorno .= "<td>{$reg['tb_action']}</td>";
          $retorno .= "<td>{$reg['tb_beneficiaries']}</td>";
          $retorno .= "<td>{$reg['tb_source']}</td>";
          $retorno .= "<td>{$reg['int_month']}/{$reg['int_year']}</td>";
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