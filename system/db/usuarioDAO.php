
<?php
/**
 * Created by PhpStorm.
 * User: Maria Gabriela
 * Date: 14/06/2018
 * Time: 18:12
 */


require_once "conexao.php";
require_once "classes/usuario.php";

class usuarioDAO
{


    public function remover($user){
        global $pdo;
        try {
            $statement = $pdo->prepare("DELETE FROM Usuario WHERE idUsuario = :id");
            $statement->bindValue(":id", $user->getIdUsuario());
            if ($statement->execute()) {
                return "Registo foi excluído com êxito";
                $id = null;
                $usuario = null;
                $senha = null;
                $nome = null;
                $email = null;
                $resetar = null;


            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: ".$erro->getMessage();
        }
    }

    public function salvar($user){
        global $pdo;
        try {

            if ($user->getIdUsuario() != "") {
                $statement = $pdo->prepare("UPDATE Usuario SET Usuario=:usuario, Senha=:senha, Nome=:nome, Email=:email, Resetar=:resetar  WHERE idUsuario = :id;");
                $statement->bindValue(":id", $user->getIdUsuario());
            } else {
                $statement = $pdo->prepare("INSERT INTO Usuario (Usuario, Senha, Nome, Email, Resetar) VALUES (:usuario, :senha, :nome, :email, :resetar)");
            }
            $statement->bindValue(":usuario",$user->getUsuario());
            $statement->bindValue(":senha",sha1($user->getSenha()));
            $statement->bindValue(":nome",$user->getNome());
            $statement->bindValue(":email",$user->getEmail());
            $statement->bindValue(":resetar",$user->getResetar());


            if ($statement->execute()) {
                if ($statement->rowCount() > 0) {
                    return "Dados cadastrados com sucesso!";
                    $id = null;
                    $usuario = null;
                    $senha = null;
                    $nome = null;
                    $email = null;
                    $resetar = null;

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

    public function atualizar($user){
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT idUsuario, Usuario, Senha, Nome, Email, Resetar FROM Usuario WHERE idUsuario = :id");
            $statement->bindValue(":id", $user->getIdUsuario());
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $user->setIdUsuario($rs->idUsuario);
                $user->setUsuario($rs->Usuario);
                $user->setSenha($rs->Senha);
                $user->setNome($rs->Nome);
                $user->setEmail($rs->Email);
                $user->setResetar($rs->Resetar);

                return $user;
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: ".$erro->getMessage();
        }
    }

    public function tabelapaginada()
    {

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
        $linha_inicial = ($pagina_atual - 1) * QTDE_REGISTROS;

        /* Instrução de consulta para paginação com MySQL */
        $sql = "SELECT idUsuario, Usuario, Senha, Nome, Email, Resetar FROM Usuario LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $dados = $statement->fetchAll(PDO::FETCH_OBJ);

        /* Conta quantos registos existem na tabela */
        $sqlContador = "SELECT COUNT(*) AS total_registros FROM Usuario";
        $statement = $pdo->prepare($sqlContador);
        $statement->execute();
        $valor = $statement->fetch(PDO::FETCH_OBJ);



        /* Idêntifica a primeira página */
        $primeira_pagina = 1;

        /* Cálcula qual será a última página */
        $ultima_pagina = ceil($valor->total_registros / QTDE_REGISTROS);

        /* Cálcula qual será a página anterior em relação a página atual em exibição */
        $pagina_anterior = ($pagina_atual > 1) ? $pagina_atual - 1 : 0;

        /* Cálcula qual será a pŕoxima página em relação a página atual em exibição */
        $proxima_pagina = ($pagina_atual < $ultima_pagina) ? $pagina_atual + 1 : 0;

        /* Cálcula qual será a página inicial do nosso range */
        $range_inicial = (($pagina_atual - RANGE_PAGINAS) >= 1) ? $pagina_atual - RANGE_PAGINAS : 1;

        /* Cálcula qual será a página final do nosso range */
        $range_final = (($pagina_atual + RANGE_PAGINAS) <= $ultima_pagina) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina;

        /* Verifica se vai exibir o botão "Primeiro" e "Pŕoximo" */
        $exibir_botao_inicio = ($range_inicial < $pagina_atual) ? 'mostrar' : 'esconder';

        /* Verifica se vai exibir o botão "Anterior" e "Último" */
        $exibir_botao_final = ($range_final > $pagina_atual) ? 'mostrar' : 'esconder';

        if (!empty($dados)):
            echo "
     <table class='table table-striped table-bordered'>
     <thead>
       <tr class='active'>
       <th>Código</th>
        <th>Usuario</th>
        <th>Nome</th>
        <th>Email</th>
        
        <th colspan='2'>Ações</th>
       </tr>
     </thead>
     <tbody>";
            foreach ($dados as $inst):
                echo "<tr>
        <td>$inst->idUsuario</td>
        <td>$inst->Usuario</td>
        <td>$inst->Nome</td>
        <td>$inst->Email</td>
        <td><a href='?act=upd&id=$inst->idUsuario'><i class='ti-reload'></i></a></td>
        <td><a href='?act=del&id=$inst->idUsuario'><i class='ti-close'></i></a></td>
       
       </tr>";
            endforeach;
            echo "
</tbody>
     </table>

     <div class='box-paginacao'>
       <a class='box-navegacao  $exibir_botao_inicio' href='$endereco?page=$primeira_pagina' title='Primeira Página'>Primeira</a>
       <a class='box-navegacao $exibir_botao_inicio' href='$endereco?page=$pagina_anterior' title='Página Anterior'>Anterior</a>
";

            /* Loop para montar a páginação central com os números */
            for ($i = $range_inicial; $i <= $range_final; $i++):
                $destaque = ($i == $pagina_atual) ? 'destaque' : '';
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