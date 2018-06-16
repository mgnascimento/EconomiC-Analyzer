<?php

include_once "estrutura/template.php";
require_once "db/functionDAO.php";
require_once "classes/functions.php";

$template = new Template();
$object = new functionDAO();

$template->header();
$template->sidebar();
$template->mainpanel();

//verifica se foi enviado dados via post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_function = (isset($_POST["id_function"]) && $_POST["id_function"] != null) ? $_POST["id_function"] : "";
    $cod_function = (isset($_POST["cod_function"]) && $_POST["cod_function"] != null) ? $_POST["cod_function"] : "";
    $name_function = (isset($_POST["name_function"]) && $_POST["name_function"] != null) ? $_POST["name_function"] : "";
} else if (!isset($id_function)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id_function = (isset($_GET["id_function"]) && $_GET["id_function"] != null) ? $_GET["id_function"] : "";
    $cod_function = NULL;
    $name_function = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id_function != "") {
    $function = new functions($id_function, '', '');
    $resultado = $object->atualizar($function);
    $cod_function = $resultado->getCodFunction();
    $name_function = $resultado->getNameFunction();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $cod_function != "") {
    $function = new functions($id_function, $cod_function, $name_function);
    $msg = $object->salvar($function);
    $id_function = null;
    $cod_function = null;
    $name_function = null;

}


if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id_function != "") {
    $function = new functions($id_function, '','');
    $msg = $object->remover($function);
    $id_function= null;
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
                            <input type="hidden" name="id_function" value="<?php
                            // Preenche o id no campo id com um valor "value"
                            echo (isset($id_function) && ($id_function != null || $id_function != "")) ? $id_function : '';
                            ?>" />
                            Código:
                            <input type="text" size="50" name="cod_function" value="<?php
                            // Preenche o nome no campo nome com um valor "value"
                            echo (isset($cod_function) && ($cod_function != null || $cod_function != "")) ? $cod_function : '';
                            ?>" />
                            Nome:
                            <input type="text" size="25" name="name_function" value="<?php
                            // Preenche a matricula no campo sigla com um valor "value"
                            echo (isset($name_function) && ($name_function != null || $name_function != "")) ? $name_function : '';
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
