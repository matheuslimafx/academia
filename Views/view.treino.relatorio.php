<?php

require '../_app/Config.inc.php';

require 'Relatorios/autoload.inc.php';

use Dompdf\Dompdf;

$html = "        <head>    
                <meta charset='UTF-8'>
                <title>Relátorio de Treino</title>
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

            <h2>Relátorio de Treino por Aluno</h2>";


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
        . "<th>Professor</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Equipamento</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Nome do Treino</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Exercicio</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Grupo muscular</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>número de series</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Turno/Horário</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Treino no Domingo</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Treino na Segunda-feira</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Treino na Terça-feira</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Treino na Quarta-feira</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Treino na Quinta-feira</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Treino na Sexta-feira</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Treino no Sábado</th>"
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
relatorioTreino.pdf
", array(
    "Attachment" => false)
);
?>