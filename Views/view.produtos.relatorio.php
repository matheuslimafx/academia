<?php

require '../_app/Config.inc.php';

require 'Relatorios/autoload.inc.php';

use Dompdf\Dompdf;

$html = "        <head>    
                <meta charset='UTF-8'>
                <title>Relátorio de Produtos</title>
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

            <h2>Relátorio de Produtos</h2>";


$html .= "<table  style='width:100%'>"
        
        . "<tr>"
        . "<th>ID</th>"
        . "<td></td>"
        ."</tr>"
        
        . "<tr>"
        . "<th>Categoria</th>"
        . "<td></td>"
        ."</tr>"
        
        . "<tr>"
        . "<th>Fornecedor</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Nome do produto</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Peso</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Cor</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Tamanho</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Número</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Contra indicações</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Data de entrada</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Data de saída</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Marca</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Fabricante</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Data de validade</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Observações</th>"
        . "<td></td>"
        . "</tr>"
        
        . "</table>";

$dompdf = new Dompdf();

$dompdf->loadHtml($html);

$dompdf->set_paper('a4');

$dompdf->render();

$dompdf->stream("
relatorioProdutos.pdf
", array(
    "Attachment" => false)
);
?>