<?php

include_once "estrutura/template.php";
require_once "db/actionDAO.php";
require_once "classes/action.php";

$template = new Template();
$object = new actionDAO();

$template->header();
$template->sidebar();
$template->mainpanel();

//verifica se foi enviado dados via post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_action = (isset($_POST["id_action"]) && $_POST["id_action"] != null) ? $_POST["id_action"] : "";
    $cod_action = (isset($_POST["cod_action"]) && $_POST["cod_action"] != null) ? $_POST["cod_action"] : "";
    $name_action = (isset($_POST["name_action"]) && $_POST["name_action"] != null) ? $_POST["name_action"] : "";
} else if (!isset($id_action)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id_action = (isset($_GET["id_action"]) && $_GET["id_action"] != null) ? $_GET["id_action"] : "";
    $cod_action = NULL;
    $name_action = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id_action != "") {
    $action = new action($id_action, '', '');
    $resultado = $object->atualizar($action);
    $cod_action = $resultado->getCodAction();
    $name_action = $resultado->getNameAction();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $cod_action != "") {
    $action = new action($id_action, $cod_action, $name_action);
    $msg = $object->salvar($action);
    $id_action = null;
    $cod_action = null;
    $name_action = null;

}


if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id_action != "") {
    $action = new action($id_action, '','');
    $msg = $object->remover($action);
    $id_action = null;
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
                            <input type="hidden" name="id_action" value="<?php
                            // Preenche o id no campo id com um valor "value"
                            echo (isset($id_action) && ($id_action != null || $id_action != "")) ? $id_action : '';
                            ?>" />
                            Código:
                            <input type="text" size="50" name="cod_action" value="<?php
                            // Preenche o nome no campo nome com um valor "value"
                            echo (isset($cod_action) && ($cod_action != null || $cod_action != "")) ? $cod_action : '';
                            ?>" />
                            Nome:
                            <input type="text" size="25" name="name_action" value="<?php
                            // Preenche a matricula no campo sigla com um valor "value"
                            echo (isset($name_action) && ($name_action != null || $name_action != "")) ? $name_action : '';
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
