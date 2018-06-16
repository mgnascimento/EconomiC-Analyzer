<?php

include_once "estrutura/template.php";
require_once "db/programDAO.php";
require_once "classes/program.php";

$template = new Template();
$object = new programDAO();

$template->header();
$template->sidebar();
$template->mainpanel();

//verifica se foi enviado dados via post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_program = (isset($_POST["id_program"]) && $_POST["id_program"] != null) ? $_POST["id_program"] : "";
    $cod_program = (isset($_POST["cod_program"]) && $_POST["cod_program"] != null) ? $_POST["cod_program"] : "";
    $name_program = (isset($_POST["name_program"]) && $_POST["name_program"] != null) ? $_POST["name_program"] : "";
} else if (!isset($id_program)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id_program = (isset($_GET["id_program"]) && $_GET["id_program"] != null) ? $_GET["id_program"] : "";
    $cod_program = NULL;
    $name_program = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id_program != "") {
    $program = new program($id_program, '', '');
    $resultado = $object->atualizar($program);
    $cod_program = $resultado->getCodProgram();
    $name_program = $resultado->getNameProgram();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $cod_program != "") {
    $program = new program($id_program, $cod_program, $name_program);
    $msg = $object->salvar($program);
    $id_program = null;
    $cod_program = null;
    $name_program = null;

}


if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id_program != "") {
    $program = new program($id_program, '','');
    $msg = $object->remover($program);
    $id_program = null;
}

?>

<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>Ações</h4>


                    </div>
                    <div class='content table-responsive'>

                        <form action="?act=save" method="POST" name="form1" >
                            <hr>
                            <i class="ti-save"></i>
                            <input type="hidden" name="id_program" value="<?php
                            // Preenche o id no campo id com um valor "value"
                            echo (isset($id_program) && ($id_program != null || $id_program != "")) ? $id_program : '';
                            ?>" />
                            Código:
                            <input type="text" size="50" name="cod_program" value="<?php
                            // Preenche o nome no campo nome com um valor "value"
                            echo (isset($cod_program) && ($cod_program != null || $cod_program != "")) ? $cod_program : '';
                            ?>" />
                            Nome:
                            <input type="text" size="25" name="name_program" value="<?php
                            // Preenche a matricula no campo sigla com um valor "value"
                            echo (isset($name_program) && ($name_program != null || $name_program != "")) ? $name_program : '';
                            ?>" />
                            <input type="submit" VALUE="Cadastrar"/>
                            <hr>
                        </form>


                        <?php


                        echo (isset($msg) && ($msg != null  || $msg != "")) ? $msg : '';
                        //chamada a paginação
                        $object->tabelapaginada();

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$template->footer();
?>
