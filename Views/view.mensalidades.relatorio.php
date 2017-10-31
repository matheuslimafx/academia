<?php

require '../_app/Config.inc.php';

require 'Relatorios/autoload.inc.php';

use Dompdf\Dompdf;

$html = "        <head>    
                <meta charset='UTF-8'>
                <title>Relátorio de Mensalidades</title>
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

            <h2>Relátorio de todas Mensalidades</h2>";


$html .= "<table  style='width:100%'>"
        
        . "<tr>"
        . "<th>ID</th>"
        . "<td></td>"
        ."</tr>"
        
        . "<tr>"
        . "<th>Matricula do Aluno</th>"
        . "<td></td>"
        ."</tr>"
        
        . "<tr>"
        . "<th>Data de Pagamento</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Valor</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Status</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Observação</th>"
        . "<td></td>"
        . "</tr>"
        
         . "</table>";

$dompdf = new Dompdf();

$dompdf->loadHtml($html);

$dompdf->set_paper('a4');

$dompdf->render();

$dompdf->stream("
relatorioMensalidades.pdf
", array(
    "Attachment" => false)
);
?>