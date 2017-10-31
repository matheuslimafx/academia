<?php

require '../_app/Config.inc.php';

require 'Relatorios/autoload.inc.php';

use Dompdf\Dompdf;

$html = "        <head>    
                <meta charset='UTF-8'>
                <title>Relátorio de Fornecedores</title>
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

            <h2>Relátorio de Fornecedores</h2>";


$html .= "<table  style='width:100%'>"
        
        . "<tr>"
        . "<th>ID</th>"
        . "<td></td>"
        ."</tr>"
        
        . "<tr>"
        . "<th>Nome</th>"
        . "<td></td>"
        ."</tr>"
        
        . "<tr>"
        . "<th>CNPJ/CPF</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Nome fantasia</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>E-mail</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Telefone</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Estado</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Cidade</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Complemento do Endereço</th>"
        . "<td></td>"
        . "</tr>"

        . "</table>";

$dompdf = new Dompdf();

$dompdf->loadHtml($html);

$dompdf->set_paper('a4', 'landscape');

$dompdf->render();

$dompdf->stream("
relatorioAnamnese.pdf
", array(
    "Attachment" => false)
);
?>