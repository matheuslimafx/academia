<?php

require '../_app/Config.inc.php';

require 'Relatorios/autoload.inc.php';

use Dompdf\Dompdf;

$html = "        <head>    
                <meta charset='UTF-8'>
                <title>Relátorio de Anamneses</title>
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

            <h2>Relátorio de Anamneses</h2>";


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
        . "<th>Peso</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Altura</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>IMC</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Medida do Pescoço</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Largura dos Ombros</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Largura do Torax</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Largura do Addome</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Largura da Cintura</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Largura do Quadril</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Braço direito</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Braço esquerdo</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Braço direito contraido</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Braço esquerdo contraido</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Antebraço esquerdo contraido</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Antebraço direito contraido</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Coxa esquerda</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Coxa direita</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Panturilha esquerda</th>"
        . "<td></td>"
        . "</tr>"
        
        . "<tr>"
        . "<th>Panturilha direita</th>"
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
relatorioAnamneses.pdf
", array(
    "Attachment" => false)
);
?>