<?php

include_once "estrutura/template.php";
require_once "db/subfunctionDAO.php";
require_once "classes/subfunction.php";

$template = new Template();
$object = new subfunctionDAO();

$template->header();
$template->sidebar();
$template->mainpanel();

//verifica se foi enviado dados via post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_subfunction = (isset($_POST["id_subfunction"]) && $_POST["id_subfunction"] != null) ? $_POST["id_subfunction"] : "";
    $cod_subfunction = (isset($_POST["cod_subfunction"]) && $_POST["cod_subfunction"] != null) ? $_POST["cod_subfunction"] : "";
    $name_subfunction = (isset($_POST["name_subfunction"]) && $_POST["name_subfunction"] != null) ? $_POST["name_subfunction"] : "";
} else if (!isset($id_subfunction)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id_subfunction = (isset($_GET["id_subfunction"]) && $_GET["id_subfunction"] != null) ? $_GET["id_subfunction"] : "";
    $cod_subfunction = NULL;
    $name_subfunction = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id_subfunction != "") {
    $subfunction = new subfunction($id_subfunction, '', '');
    $resultado = $object->atualizar($subfunction);
    $cod_subfunction = $resultado->getCodSubfunction();
    $name_subfunction = $resultado->getNameSubfunction();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $cod_subfunction != "") {
    $subfunction = new subfunction($id_subfunction, $cod_subfunction, $name_subfunction);
    $msg = $object->salvar($subfunction);
    $id_subfunction = null;
    $cod_subfunction = null;
    $name_subfunction = null;

}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id_subfunction != "") {
    $subfunction = new subfunction($id_subfunction, '','');
    $msg = $object->remover($subfunction);
    $id_subfunction= null;
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
                            <input type="hidden" name="id_subfunction" value="<?php
                            // Preenche o id no campo id com um valor "value"
                            echo (isset($id_subfunction) && ($id_subfunction != null || $id_subfunction != "")) ? $id_subfunction : '';
                            ?>" />
                            Código:
                            <input type="text" size="50" name="cod_subfunction" value="<?php
                            // Preenche o nome no campo nome com um valor "value"
                            echo (isset($cod_subfunction) && ($cod_subfunction != null || $cod_subfunction != "")) ? $cod_subfunction : '';
                            ?>" />
                            Nome:
                            <input type="text" size="25" name="name_subfunction" value="<?php
                            // Preenche a matricula no campo sigla com um valor "value"
                            echo (isset($name_subfunction) && ($name_subfunction != null || $name_subfunction != "")) ? $name_subfunction : '';
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
