<?php
require_once "db/conexao.php";


require_once "estrutura/template.php";
$template = new Template();

$template->header();

$template->sidebar();

$template->mainpanel();

?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-warning text-center">
                                    <i class="ti-server"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Payments</p>

                                    <?php
                                    $soma = $pdo->query("SELECT SUM(db_value) AS total FROM tb_payments")->fetchColumn();
                                    print $soma;
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr/>
                            <div class="stats">
                                <i class="ti-info"></i> Total sum
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-success text-center">
                                    <i class="ti-wallet"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Payments</p>
                                    <?php

                                    $soma = $pdo->query("SELECT SUM(db_value) AS total FROM tb_payments WHERE int_month = '5'")->fetchColumn();
                                    print $soma;
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr/>
                            <div class="stats">
                                <i class="ti-calendar"></i> Last Month
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-danger text-center">
                                    <i class="ti-pulse"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Average</p>
                                    <?php

                                    $media = $pdo->query("SELECT AVG(db_value) AS total FROM tb_payments WHERE int_month = '5'")->fetchColumn();
                                    print $media;
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr/>
                            <div class="stats">
                                <i class="ti-timer"></i> In the last month
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-info text-center">
                                    <i class="ti-user"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Beneficiaries</p>

                                    <?php
                                    $select = $pdo->query("SELECT * FROM tb_beneficiaries")->fetchAll();
                                    $count = count($select);
                                    print $count
                                    ?>

                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr/>
                            <div class="stats">
                                <i class="ti-info"></i> Total
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Monthly beneficiaries</h4>
                        <p class="category">Every year</p>
                    </div>
                    <div class="content">
                        <div id="chartHours" class="ct-chart">
                            <img src="getGraph.php">

                        </div>
                        <div class="footer">
                            <div class="chart-legend">
                                <i class="fa fa-circle text-info"></i> Value
                                <i class="fa fa-circle text-danger"></i> Value
                                <i class="fa fa-circle text-warning"></i> Value
                            </div>
                            <hr>
                            <div class="stats">
                                <i class="ti-info-alt"></i> Historic Serie | <i class="ti-export"></i><a> Export PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Beneficiaries by state</h4>
                        <p class="category">Monthly update</p>
                    </div>
                    <div class="content">
                        <div id="chartPreferences" class="ct-chart ct-perfect-fourth">   
                            <img src="getGraph2.php">
                        </div>
                        <div class="footer">
                            <div class="chart-legend">
                                <i class="fa fa-circle text-info"></i> Value
                                <i class="fa fa-circle text-danger"></i> Value
                                <i class="fa fa-circle text-warning"></i> Value
                            </div>
                            <hr>
                            <div class="stats">
                                <i class="ti-timer"></i> Total | <i class="ti-export"></i><a> Export PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card ">
                    <div class="header">
                        <h4 class="title">Values per state</h4>
                        <p class="category">Monthly update</p>
                    </div>
                    <div class="content">
                        <div id="chartActivity" class="ct-chart"></div>
                        <img src="getGraph3.php">
                        <div class="footer">
                            <div class="chart-legend">
                                <i class="fa fa-circle text-info"></i> Value
                                <i class="fa fa-circle text-warning"></i> Value
                            </div>
                            <hr>
                            <div class="stats">
                                <i class="ti-check"></i> Last Month | <i class="ti-export"></i><a> Export PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$template->footer();

?>