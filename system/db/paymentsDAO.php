<?php


require_once "conexao.php";
require_once "classes/payments.php";


class paymentsDAO
{

    public function remover ($payment)
    {
        //classe global q conecta com o banco
        global $pdo;
        try {
            //preparação para execução da query sql
            $statement = $pdo->prepare("DELETE FROM tb_payments WHERE id_payment=:id_payment");
            $statement->bindValue(":id_payment", $payment->getIdPayment());
            if ($statement->execute()) {
                return "Registo foi excluído com êxito";
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function salvar($payment)
    {
        global $pdo;
        try {

            if ($payment->getIdPayment() != "") {
                $statement = $pdo->prepare("UPDATE tb_payments SET tb_city_id_city=:city, tb_functions_id_function=:function, 
tb_subfunctions_id_subfunction=:subfunction, tb_program_id_program=:program, tb_action_id_action=:action,
tb_beneficiaries_id_beneficiaries=:beneficiaries, tb_source_id_source=:source, tb_files_id_file=:file, int_month=:month, 
int_year=:year, db_value=:val WHERE id_payment = :id_payment");
                $statement->bindValue(":id_payment", $payment->getIdPayment());
            } else {
                $statement = $pdo->prepare("INSERT INTO tb_payments (tb_city_id_city, tb_functions_id_function, tb_subfunctions_id_subfunction,
 tb_program_id_program, tb_action_id_action, tb_beneficiaries_id_beneficiaries, tb_source_id_source, tb_files_id_file, int_month, int_year, 
 db_value) VALUES (:city, :function, :subfunction, :program, :action, :beneficiaries, :source, :file, :month, :year, :val )");
            }
            $statement->bindValue(":city", $payment->getCityIdCity());
            $statement->bindValue(":function", $payment->getFunctionsIdFunction());
            $statement->bindValue(":subfunction", $payment->getSubfunctionsIdSubfunction());
            $statement->bindValue(":program", $payment->getProgramIdProgram());
            $statement->bindValue(":action", $payment->getActionIdAction());
            $statement->bindValue(":beneficiaries", $payment->getBeneficiariesIdBeneficiaries());
            $statement->bindValue(":source", $payment->getSourceIdSource());
            $statement->bindValue(":file", $payment->getFilesIdFiles());
            $statement->bindValue(":month", $payment->getMonth());
            $statement->bindValue(":year", $payment->getYear());
            $statement->bindValue(":val", $payment->getValue());

            if ($statement->execute()) {
                if ($statement->rowCount() > 0) {
                    return "Dados cadastrados com sucesso!";
                } else {
                    return "Erro ao tentar efetivar cadastro";
                }
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function atualizar($payment){
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT id_payment, tb_city_id_city, tb_functions_id_function, tb_subfunctions_id_subfunction,
 tb_program_id_program, tb_action_id_action, tb_beneficiaries_id_beneficiaries, tb_source_id_source, tb_files_id_file, int_month, int_year, 
 db_value FROM tb_payments WHERE id_payment = :id_payment");
            $statement->bindValue(":id_payment", $payment->getIdPayment());
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $payment->setIdPayment($rs->id_payment);
                $payment->setCityIdCity($rs->tb_city_id_city);
                $payment->setFunctionsIdFunction($rs->tb_functions_id_function);
                $payment->setSubfunctionsIdSubfunction($rs->tb_subfunctions_id_subfunction);
                $payment->setProgramIdProgram($rs->tb_program_id_program);
                $payment->setActionIdAction($rs->tb_action_id_action);
                $payment->setBeneficiariesIdBeneficiaries($rs->tb_beneficiaries_id_beneficiaries);
                $payment->setSourceIdSource($rs->tb_source_id_source);
                $payment->setFilesIdFiles($rs->tb_files_id_file);
                $payment->setMonth($rs->int_month);
                $payment->setYear($rs->int_year);
                $payment->setValue($rs->db_value);



                return $payment;
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: ".$erro->getMessage();
        }
    }

    public function tabelapaginada() {

        //carrega o banco
        global $pdo;

        //endereço atual da página
        $endereco = $_SERVER ['PHP_SELF'];

        /* Constantes de configuração */
        define('QTDE_REGISTROS', 3);
        define('RANGE_PAGINAS', 1);

        /* Recebe o número da página via parâmetro na URL */
        $pagina_atual = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

        /* Calcula a linha inicial da consulta */
        $linha_inicial = ($pagina_atual -1) * QTDE_REGISTROS;

        $sql = "SELECT P.id_payment, Ct.str_name_city as tb_city, F.str_name_function as tb_functions, SB.str_name_subfunction as tb_subfunctions,
 PR.str_name_program as tb_program, A.str_name_action as tb_action, B.str_name_person as tb_beneficiaries,
  S.str_goal as tb_source, Fl.str_name_file as tb_files, int_month, int_year, db_value FROM tb_payments P
    INNER JOIN tb_city Ct ON (Ct.id_city = P.tb_city_id_city) INNER JOIN tb_functions F ON (F.id_function = P.tb_functions_id_function)
    INNER JOIN tb_subfunctions SB ON (SB.id_subfunction = P.tb_subfunctions_id_subfunction) INNER JOIN tb_program PR ON (PR.id_program = P.tb_program_id_program)
    INNER JOIN tb_action A ON (A.id_action = P.tb_action_id_action) INNER JOIN tb_beneficiaries B ON (B.id_beneficiaries = P.tb_beneficiaries_id_beneficiaries)
    INNER JOIN tb_source S On (S.id_source = P.tb_source_id_source) INNER JOIN tb_files Fl ON (Fl.id_file = P.tb_files_id_file)
    LIMIT {$linha_inicial}, " . QTDE_REGISTROS;

        $statement = $pdo->prepare($sql);
        $statement->execute();
        $dados = $statement->fetchAll(PDO::FETCH_OBJ);

        /* Conta quantos registos existem na tabela */
        $sqlContador = "SELECT COUNT(*) AS total_registros FROM tb_payments";
        $statement = $pdo->prepare($sqlContador);
        $statement->execute();
        $valor = $statement->fetch(PDO::FETCH_OBJ);

        /* Idêntifica a primeira página */
        $primeira_pagina = 1;

        /* Cálcula qual será a última página */
        $ultima_pagina  = ceil($valor->total_registros / QTDE_REGISTROS);

        /* Cálcula qual será a página anterior em relação a página atual em exibição */
        $pagina_anterior = ($pagina_atual > 1) ? $pagina_atual -1 : 0 ;

        /* Cálcula qual será a pŕoxima página em relação a página atual em exibição */
        $proxima_pagina = ($pagina_atual < $ultima_pagina) ? $pagina_atual +1 : 0 ;

        /* Cálcula qual será a página inicial do nosso range */
        $range_inicial  = (($pagina_atual - RANGE_PAGINAS) >= 1) ? $pagina_atual - RANGE_PAGINAS : 1 ;

        /* Cálcula qual será a página final do nosso range */
        $range_final   = (($pagina_atual + RANGE_PAGINAS) <= $ultima_pagina ) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina ;

        /* Verifica se vai exibir o botão "Primeiro" e "Pŕoximo" */
        $exibir_botao_inicio = ($range_inicial < $pagina_atual) ? 'mostrar' : 'esconder';

        /* Verifica se vai exibir o botão "Anterior" e "Último" */
        $exibir_botao_final = ($range_final > $pagina_atual) ? 'mostrar' : 'esconder';

        if (!empty($dados)):
            echo "
     <table class='table table-striped table-bordered'>
     <thead>
       <tr class='active'>
        <th>Id</th>
        <th>Cidade</th>
        <th>Função</th>
        <th>SubFunção</th>
        <th>Programa</th>
        <th>Ação</th>
        <th>Beneficiário</th>
        <th>Fonte</th>
        <th>Relatorio</th>
        <th>Data</th>
        <th>Valor</th>
        <th colspan='2'>Ações</th>
       </tr>
     </thead>
     <tbody>";
            foreach($dados as $inst):
                echo "<tr>
        <td>$inst->id_payment</td>
        <td>$inst->tb_city</td>      
        <td>$inst->tb_functions</td>      
        <td>$inst->tb_subfunctions</td>      
        <td>$inst->tb_program</td>      
        <td>$inst->tb_action</td>      
        <td>$inst->tb_beneficiaries</td>      
        <td>$inst->tb_source</td>      
        <td>$inst->tb_files</td>      
        <td>$inst->int_month/$inst->int_year</td>      
        <td>$inst->db_value</td>      
        <td><a href='?act=upd&id_payment=$inst->id_payment'><i class='ti-reload'></i></a></td>
        <td><a href='?act=del&id_payment=$inst->id_payment'><i class='ti-close'></i></a></td>
       </tr>";
            endforeach;
            echo"
</tbody>
     </table>

     <div class='box-paginacao'>
       <a class='box-navegacao  $exibir_botao_inicio' href='$endereco?page=$primeira_pagina' title='Primeira Página'>Primeira</a>
       <a class='box-navegacao $exibir_botao_inicio' href='$endereco?page=$pagina_anterior' title='Página Anterior'>Anterior</a>
";

            /* Loop para montar a páginação central com os números */
            for ($i=$range_inicial; $i <= $range_final; $i++):
                $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;
                echo "<a class='box-numero $destaque' href='$endereco?page=$i'>$i</a>";
            endfor;

            echo "<a class='box-navegacao $exibir_botao_final' href='$endereco?page=$proxima_pagina' title='Próxima Página'>Próxima</a>
       <a class='box-navegacao $exibir_botao_final' href='$endereco?page=$ultima_pagina' title='Última Página'>Último</a>
     </div>";
        else:
            echo "<p class='bg-danger'>Nenhum registro foi encontrado!</p>
     ";
        endif;

    }




}