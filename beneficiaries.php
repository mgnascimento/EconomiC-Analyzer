<?php

include_once "estrutura/template.php";
require_once "db/beneficiariesDAO.php";
require_once "classes/beneficiaries.php";

$template = new Template();
$object = new beneficiariesDAO();

$template->header();
$template->sidebar();
$template->mainpanel();

//verifica se foi enviado dados via post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_beneficiaries = (isset($_POST["id_beneficiaries"]) && $_POST["id_beneficiaries"] != null) ? $_POST["id_beneficiaries"] : "";
    $nis = (isset($_POST["nis"]) && $_POST["nis"] != null) ? $_POST["nis"] : "";
    $name_person = (isset($_POST["name_person"]) && $_POST["name_person"] != null) ? $_POST["name_person"] : "";
} else if (!isset($id_beneficiaries)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id_beneficiaries = (isset($_GET["id_beneficiaries"]) && $_GET["id_beneficiaries"] != null) ? $_GET["id_beneficiaries"] : "";
    $nis = NULL;
    $name_person = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id_beneficiaries != "") {
    $beneficiaries = new beneficiaries($id_beneficiaries, '', '');
    $resultado = $object->atualizar($beneficiaries);
    $nis = $resultado->getNis();
    $name_person = $resultado->getNamePerson();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nis != "") {
    $beneficiaries = new beneficiaries($id_beneficiaries, $nis, $name_person);
    $msg = $object->salvar($beneficiaries);
    $id_beneficiaries = null;
    $nis = null;
    $name_person = null;

}


if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id_beneficiaries != "") {
    $beneficiaries = new beneficiaries($id_beneficiaries, '','');
    $msg = $object->remover($beneficiaries);
    $id_beneficiaries = null;
}

?>

    <div class='content' xmlns="http://www.w3.org/1999/html">
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='card'>
                        <div class='header'>
                            <h4 class='title'>Beneficiados</h4>


                        </div>
                        <div class='content table-responsive'>

                            <form action="?act=save" method="POST" name="form1" >
                                <hr>
                                <i class="ti-save"></i>
                                <input type="hidden" name="id_beneficiaries" value="<?php
                                // Preenche o id no campo id com um valor "value"
                                echo (isset($id_beneficiaries) && ($id_beneficiaries != null || $id_beneficiaries != "")) ? $id_beneficiaries : '';
                                ?>" />
                                Código:
                                <input type="text" size="50" name="nis" value="<?php
                                // Preenche o nome no campo nome com um valor "value"
                                echo (isset($nis) && ($nis != null || $nis != "")) ? $nis : '';
                                ?>" />
                                Nome:
                                <input type="text" size="25" name="name_person" value="<?php
                                // Preenche a matricula no campo sigla com um valor "value"
                                echo (isset($name_person) && ($name_person != null || $name_person != "")) ? $name_person : '';
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