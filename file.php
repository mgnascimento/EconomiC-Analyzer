<?php

include_once "estrutura/template.php";
require_once "relatorios/reportClient.php";
require_once "relatorios/benCity.php";
require_once "relatorios/benOrderAZ.php";
require_once "relatorios/benValor.php";
require_once "relatorios/somaBen.php";
require_once "relatorios/valTotalEst.php";
require_once "relatorios/valTotalRegion.php";


 if(isset($_POST['payments'])):
   $report = new reportClient("css/estilo.css", "Relatório de Pagamentos");
   $report->BuildPDF();
   $report->Exibir("Relatório de Pagamentos");
 endif;

if(isset($_POST['benAZ'])):
    $report = new benOrderAZ("css/estilo.css", "Relatório de Beneficiarios");
    $report->BuildPDF();
    $report->Exibir("Relatório de Beneficiarios");
endif;
if(isset($_POST['benCity'])):
    $report = new benCity("css/estilo.css", "Relatório de Beneficiarios");
    $report->BuildPDF();
    $report->Exibir("Relatório de Beneficiarios");
endif;
if(isset($_POST['benValor'])):
    $report = new benValor("css/estilo.css", "Relatório de Beneficiarios por valor");
    $report->BuildPDF();
    $report->Exibir("Relatório de Beneficiarios por valor");
endif;
if(isset($_POST['somaBen'])):
    $report = new somaBen("css/estilo.css", "Relatório de soma por Beneficiario");
    $report->BuildPDF();
    $report->Exibir("Relatório de soma por Beneficiarios");
endif;
if(isset($_POST['valTotalRegion'])):
    $report = new valTotalRegion("css/estilo.css", "Relatório de Valor Total");
    $report->BuildPDF();
    $report->Exibir("Relatório de Valor Total");
endif;
if(isset($_POST['valTotalEst'])):
    $report = new valTotalEst("css/estilo.css", "Relatório de Valor Total");
    $report->BuildPDF();
    $report->Exibir("Relatório de Valor Total");
endif;
 ?>



    <div class='content' xmlns="http://www.w3.org/1999/html">
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='card'>
                        <div class='header'>
                            <h4 class='title'>Relatórios</h4>

                            <body><br><br>

                            <form action="" method="POST" target="_blank">
                                <input type="submit" value="Todos Pagamentos" name="payments"/>
                            </form><br>

                            <form action="" method="POST" target="_blank">
                                <input type="submit" value="Beneficiarios" name="benAZ"/>
                            </form><br>
                            <form action="" method="POST" target="_blank">
                                <input type="submit" value="Gerar relatório Beneficiarios" name="benCity"/>
                            </form><br>
                            <form action="" method="POST" target="_blank">
                                <input type="submit" value="Gerar relatório de Auxilio por Beneficiarios" name="benValor"/>
                            </form><br>
                            <form action="" method="POST" target="_blank">
                                <input type="submit" value="Gerar relatório de pagamento por benficiarios" name="somaBen"/>
                            </form><br>
                            <form action="" method="POST" target="_blank">
                                <input type="submit" value="Valor total por regiao" name="valTotalRegion"/>
                            </form><br>
                            <form action="" method="POST" target="_blank">
                                <input type="submit" value="Valor total por estado" name="valTotalEst"/>
                            </form>

                            <br><br>
                            <br><br>

                            <a href="dashboard.php">Voltar</a>

                            </body>


                        </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


