<?php

include_once "estrutura/template.php";
require_once "db/sourceDAO.php";
require_once "classes/source.php";

$template = new Template();
$object = new sourceDAO();

$template->header();
$template->sidebar();
$template->mainpanel();

//verifica se foi enviado dados via post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_source = (isset($_POST["id_source"]) && $_POST["id_source"] != null) ? $_POST["id_source"] : "";
    $goal = (isset($_POST["goal"]) && $_POST["goal"] != null) ? $_POST["goal"] : "";
    $origin = (isset($_POST["origin"]) && $_POST["origin"] != null) ? $_POST["origin"] : "";
    $periodicity = (isset($_POST["periodicity"]) && $_POST["periodicity"] != null) ? $_POST["periodicity"] : "";
} else if (!isset($id_source)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id_source = (isset($_GET["id_source"]) && $_GET["id_source"] != null) ? $_GET["id_source"] : "";
    $goal = NULL;
    $origin = NULL;
    $periodicity = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id_source != "") {
    $source = new source($id_source, '', '', '');
    $resultado = $object->atualizar($source);
    $goal = $resultado->getGoal();
    $origin = $resultado->getOrigin();
    $periodicity = $resultado->getPeriodicity();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $goal != "") {
    $source = new source($id_source, $goal, $origin, $periodicity);
    $msg = $object->salvar($source);
    $id_source = null;
    $goal = null;
    $origin = null;
    $periodicity = null;

}


if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id_source != "") {
    $source = new source($id_source, '','', '');
    $msg = $object->remover($source);
    $id_source = null;
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
                            <input type="hidden" name="id_source" value="<?php
                            // Preenche o id no campo id com um valor "value"
                            echo (isset($id_source) && ($id_source != null || $id_source != "")) ? $id_source : '';
                            ?>" />
                            Objetivo:
                            <input type="text" size="50" name="goal" value="<?php
                            // Preenche o nome no campo nome com um valor "value"
                            echo (isset($goal) && ($goal != null || $goal != "")) ? $goal : '';
                            ?>" />
                            Origin:
                            <input type="text" size="25" name="origin" value="<?php
                            // Preenche a matricula no campo sigla com um valor "value"
                            echo (isset($origin) && ($origin != null || $origin != "")) ? $origin : '';
                            ?>" />
                            Período:
                            <input type="text" size="25" name="periodicity" value="<?php
                            // Preenche a matricula no campo sigla com um valor "value"
                            echo (isset($periodicity) && ($periodicity != null || $periodicity != "")) ? $periodicity : '';
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
