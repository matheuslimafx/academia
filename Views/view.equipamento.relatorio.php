<?php

require '../_app/Config.inc.php';

require 'Relatorios/autoload.inc.php';

use Dompdf\Dompdf;

$html = "        <head>    
                <meta charset='UTF-8'>
                <title>Relátorio de Equipamentos</title>
                <style>
                 table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}          </style>
            </head>

            <h1>Performance Academia</h1>

            <h2>Relátorio de Equipamentos</h2>";


$html .= "<table  style='width:100%'>"
        
        . "<tr>"
        . "<th>ID</th>"
        . "<td></td>"
        ."</tr>"
        
        . "<tr>"
        . "<th>Fornecedor</th>"
        . "<td></td>"
        ."</tr>"
        
        . "<tr>"
        . "<th>Treino</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Nome do equipamento</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Data de entrada</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Data de Saida</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Preço de entrada</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Marca</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Funcionalidade</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Data de manutenção</th>"
        . "<td></td>"
        . "</tr>"

        . "</table>";

$dompdf = new Dompdf();

$dompdf->loadHtml($html);

$dompdf->set_paper('a4');

$dompdf->render();

$dompdf->stream("
relatorioEquipamento.pdf
", array(
    "Attachment" => false)
);
?>