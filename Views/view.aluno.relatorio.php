<?php

require '../_app/Config.inc.php';

require 'Relatorios/autoload.inc.php';

use Dompdf\Dompdf;

$html = "        <head>    
                <meta charset='UTF-8'>
                <title>Relátorio do Aluno</title>
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

            <h2>Relátorio do Aluno</h2>";


$html .= "<table  style='width:100%'>"
        . "<tr>"
        . "<th>Matricula</th>"
        . "<td></td>"
        ."</tr>"
        
        . "<tr>"
        . "<th>Nome</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>CPF</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>RG</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Nome da Mãe</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Nome da Pai</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>E-mail</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Celular</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Residencial</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Data de Nascimento</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Status</th>"
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
        
        . "<tr>"
        . "<th>Observações</th>"
        . "<td></td>"
        . "</tr>"
        
        . "</table>";

$dompdf = new Dompdf();

$dompdf->loadHtml($html);

$dompdf->set_paper('a4', 'landscape');

$dompdf->render();

$dompdf->stream("
relatorioAluno.pdf
", array(
    "Attachment" => false)
);
?>