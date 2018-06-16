<?php

include_once "estrutura/template.php";
require_once "db/paymentsDAO.php";
require_once "classes/payments.php";

$template = new Template();
$object = new paymentsDAO();

$template->header();
$template->sidebar();
$template->mainpanel();

//verifica se foi enviado dados via post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_payment = (isset($_POST["id_payment"]) && $_POST["id_payment"] != null) ? $_POST["id_payment"] : "";
    $city = (isset($_POST["city"]) && $_POST["city"] != null) ? $_POST["city"] : "";
    $function = (isset($_POST["function"]) && $_POST["function"] != null) ? $_POST["function"] : "";
    $subfunction = (isset($_POST["subfunction"]) && $_POST["subfunction"] != null) ? $_POST["subfunction"] : "";
    $program = (isset($_POST["program"]) && $_POST["program"] != null) ? $_POST["program"] : "";
    $action = (isset($_POST["action"]) && $_POST["action"] != null) ? $_POST["action"] : "";
    $beneficiaries = (isset($_POST["beneficiaries"]) && $_POST["beneficiaries"] != null) ? $_POST["beneficiaries"] : "";
    $source = (isset($_POST["source"]) && $_POST["source"] != null) ? $_POST["source"] : "";
    $file = (isset($_POST["file"]) && $_POST["file"] != null) ? $_POST["file"] : "";
    $month = (isset($_POST["month"]) && $_POST["month"] != null) ? $_POST["month"] : "";
    $year = (isset($_POST["year"]) && $_POST["year"] != null) ? $_POST["year"] : "";
    $val = (isset($_POST["val"]) && $_POST["val"] != null) ? $_POST["val"] : "";
} else if (!isset($id_payment)) {
    $id_payment= (isset($_GET["id_payment"]) && $_GET["id_payment"] != null) ? $_GET["id_payment"] : "";
    $city = null;
    $function = null;
    $subfunction = null;
    $program = null;
    $action = null;
    $beneficiaries = null;
    $source = null;
    $file = null;
    $month = null;
    $year = null;
    $val = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id_payment != "") {
    $payment = new payments($id_payment, '', '', '', '', '', '', '', '', '', '', '');
    $resultado = $object->atualizar($payment);
    $city = $resultado->getCityIdCity();
    $function = $resultado->getFunctionsIdFunction();
    $subfunction = $resultado->getSubfunctionsIdSubfunction();
    $program = $resultado->getProgramIdProgram();
    $action = $resultado->getActionIdAction();
    $beneficiaries = $resultado->getBeneficiariesIdBeneficiaries();
    $source = $resultado->getSourceIdSource();
    $file = $resultado->getFilesIdFiles();
    $month = $resultado->getMonth();
    $year = $resultado->getYear();
    $val = $resultado->getValue();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $city != "") {
    $payment = new payments($id_payment, $city, $function, $subfunction, $program, $action, $beneficiaries, $source, $file, $month, $year, $val);
    $msg = $object->salvar($payment);
    $id_payment = null;
    $city = null;
    $function = null;
    $subfunction = null;
    $program = null;
    $action = null;
    $beneficiaries = null;
    $source = null;
    $file = null;
    $month = null;
    $year = null;
    $val = null;

}


if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id_payment != "") {
    $payment = new payments($id_payment, '','', '', '', '', '','','','','','');
    $msg = $object->remover($payment);
    $id_payment= null;
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
                            <input type="hidden" name="id_payment" value="<?php
                            echo (isset($id_payment) && ($id_payment != null || $id_payment != "")) ? $id_payment : '';
                            ?>" />
                            <p>
                            Cidade:
                            <select name="city">
                                <?php
                                $query = "SELECT * FROM tb_city order by str_name_city;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($result as $rs) {
                                        if ($rs->id_city == $city) {
                                            echo "<option value='$rs->id_city' selected>$rs->str_name_city</option>";
                                        } else {
                                            echo "<option value='$rs->id_city'>$rs->str_name_city</option>";
                                        }
                                    }
                                } else {
                                    throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                }
                                ?>
                            </select>
                            </p>
                            <p>
                            Função:
                            <select name="function">
                                <?php
                                $query = "SELECT * FROM tb_functions order by str_name_function;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($result as $rs) {
                                        if ($rs->id_function == $function) {
                                            echo "<option value='$rs->id_function' selected>$rs->str_name_function</option>";
                                        } else {
                                            echo "<option value='$rs->id_function'>$rs->str_name_function</option>";
                                        }
                                    }
                                } else {
                                    throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                }
                                ?>
                            </select>
                            </p>
                            <p>
                            Subfunção:
                            <select name="subfunction">
                                <?php
                                $query = "SELECT * FROM tb_subfunctions order by str_name_subfunction;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($result as $rs) {
                                        if ($rs->id_subfunction == $subfunction) {
                                            echo "<option value='$rs->id_subfunction' selected>$rs->str_name_subfunction</option>";
                                        } else {
                                            echo "<option value='$rs->id_subfunction'>$rs->str_name_subfunction</option>";
                                        }
                                    }
                                } else {
                                    throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                }
                                ?>
                            </select>
                            </p>
                            <p>
                            Programa:
                            <select name="program">
                                <?php
                                $query = "SELECT * FROM tb_program order by str_name_program;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($result as $rs) {
                                        if ($rs->id_program == $program) {
                                            echo "<option value='$rs->id_program' selected>$rs->str_name_program</option>";
                                        } else {
                                            echo "<option value='$rs->id_program'>$rs->str_name_program</option>";
                                        }
                                    }
                                } else {
                                    throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                }
                                ?>
                            </select>
                            </p>
                            <p>
                            Ação:
                            <select name="action">
                                <?php
                                $query = "SELECT * FROM tb_action order by str_name_action;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($result as $rs) {
                                        if ($rs->id_action == $action) {
                                            echo "<option value='$rs->id_action' selected>$rs->str_name_action</option>";
                                        } else {
                                            echo "<option value='$rs->id_action'>$rs->str_name_action</option>";
                                        }
                                    }
                                } else {
                                    throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                }
                                ?>
                            </select>
                            </p>
                            <p>
                            Beneficiarios:
                            <select name="beneficiaries">
                                <?php
                                $query = "SELECT * FROM tb_beneficiaries order by str_name_person;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($result as $rs) {
                                        if ($rs->id_beneficiaries == $beneficiaries) {
                                            echo "<option value='$rs->id_beneficiaries' selected>$rs->str_name_person</option>";
                                        } else {
                                            echo "<option value='$rs->id_beneficiaries'>$rs->str_name_person</option>";
                                        }
                                    }
                                } else {
                                    throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                }
                                ?>
                            </select>
                            </p>
                            <p>
                            Fonte:
                            <select name="source">
                                <?php
                                $query = "SELECT * FROM tb_source order by str_goal;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($result as $rs) {
                                        if ($rs->id_source == $source) {
                                            echo "<option value='$rs->id_source' selected>$rs->str_goal</option>";
                                        } else {
                                            echo "<option value='$rs->id_source'>$rs->str_goal</option>";
                                        }
                                    }
                                } else {
                                    throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                }
                                ?>
                            </select>
                            </p>
                            <p>
                            Arquivo:
                                <select name="file">
                                    <?php
                                    $query = "SELECT * FROM tb_files order by str_name_file;";
                                    $statement = $pdo->prepare($query);
                                    if ($statement->execute()) {
                                        $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($result as $rs) {
                                            if ($rs->id_file == $file) {
                                                echo "<option value='$rs->id_file' selected>$rs->str_name_file</option>";
                                            } else {
                                                echo "<option value='$rs->id_file'>$rs->str_name_file</option>";
                                            }
                                        }
                                    } else {
                                        throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                    }
                                    ?>
                                </select>
                            </p>
                            <p>
                            Mês
                            <input type="text" size="25" name="month" value="<?php
                            // Preenche a matricula no campo sigla com um valor "value"
                            echo (isset($month) && ($month != null || $month != "")) ? $month : '';
                            ?>" />
                            </p>
                            <p>
                            Ano:
                            <input type="text" size="25" name="year" value="<?php
                            // Preenche a matricula no campo sigla com um valor "value"
                            echo (isset($year) && ($year != null || $year != "")) ? $year : '';
                            ?>" /></p>
                            <p>
                            Valor:
                            <input type="text" size="25" name="val" value="<?php
                            // Preenche a matricula no campo sigla com um valor "value"
                            echo (isset($val) && ($val != null || $val != "")) ? $val : '';
                            ?>" /></p>

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
