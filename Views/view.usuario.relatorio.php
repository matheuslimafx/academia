<?php
    require "../../dompdf/autoload.inc.php";
    
    use Dompdf\Dompdf;
    
    $html = "<h1>Teste</h1>";
    
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->set_paper('a4', 'landscape');
    $dompdf->render();
    $dompdf->stream("relatorioUsuarios.pdf", array("Attchment" => false));
?>

