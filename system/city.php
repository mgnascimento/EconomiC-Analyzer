<?php

include_once "estrutura/template.php";
require_once "db/cityDAO.php";
require_once "classes/city.php";

$template = new Template();
$object = new cityDAO();

$template->header();
$template->sidebar();
$template->mainpanel();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_city = (isset($_POST["id_city"]) && $_POST["id_city"] != null) ? $_POST["id_city"] : "";
    $name_city = (isset($_POST["name_city"]) && $_POST["name_city"] != null) ? $_POST["name_city"] : "";
    $cod_siafi_city = (isset($_POST["cod_siafi_city"]) && $_POST["cod_siafi_city"] != null) ? $_POST["cod_siafi_city"] : "";
    $state_id_state = (isset($_POST["state_id_state"]) && $_POST["state_id_state"] != null) ? $_POST["state_id_state"] : "";
} else if (!isset($id_city)) {
    $id_city = (isset($_GET["id_city"]) && $_GET["id_city"] != null) ? $_GET["id_city"] : "";
    $name_city = NULL;
    $cod_siafi_city = NULL;
    $state_id_state = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id_city != "") {
    $city = new city($id_city, '', '', '');
    $resultado = $object->atualizar($city);
    $name_city = $resultado->getNameCity();
    $cod_siafi_city = $resultado->getCodSiafiCity();
    $state_id_state = $resultado->getStateIdState();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $name_city != "") {
    $city = new city($id_city, $name_city, $cod_siafi_city, $state_id_state);
    $msg = $object->salvar($city);
    $id_city = null;
    $name_city = null;
    $cod_siafi_city = null;
    $state_id_state = null;
}


if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id_city != "") {
    $city = new city($id_city, '','', '');
    $msg = $object->remover($city);
    $id_city = null;
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
                            <input type="hidden" name="id_city" value="<?php
                            echo (isset($id_city) && ($id_city != null || $id_city != "")) ? $id_city : '';
                            ?>" />
                            Nome:
                            <input type="text" size="50" name="name_city" value="<?php
                            echo (isset($name_city) && ($name_city != null || $name_city != "")) ? $name_city : '';
                            ?>" />
                            Codigo:
                            <input type="text" size="25" name="cod_siafi_city" value="<?php
                            echo (isset($cod_siafi_city) && ($cod_siafi_city != null || $cod_siafi_city != "")) ? $cod_siafi_city : '';
                            ?>" />
                            Estado:
                            <input type="text" size="25" name="state_id_state" value="<?php
                            echo (isset($state_id_state) && ($state_id_state != null || $state_id_state != "")) ? $state_id_state : '';
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
