<?php

require '../_app/Config.inc.php';

require 'Relatorios/autoload.inc.php';

use Dompdf\Dompdf;

$html = "        <head>    
                <meta charset='UTF-8'>
                <title>Relátorio de Vendas</title>
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

            <h2>Relátorio de todas as Vendas</h2>";


$html .= "<table  style='width:100%'>"
        
        . "<tr>"
        . "<th>ID</th>"
        . "<td></td>"
        ."</tr>"
        
        . "<tr>"
        . "<th>Produto</th>"
        . "<td></td>"
        ."</tr>"
        
        . "<tr>"
        . "<th>Cliente</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Data da Venda</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Quantidade</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Valor da Venda</th>"
        . "<td></td>"
        . "</tr>"
        
        . "</table>";

$dompdf = new Dompdf();

$dompdf->loadHtml($html);

$dompdf->set_paper('a4');

$dompdf->render();

$dompdf->stream("
relatorioVendas.pdf
", array(
    "Attachment" => false)
);
?>