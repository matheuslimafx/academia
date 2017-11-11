<?php

//IMPORTA O ARQUIVO DE CONFIGURAÇÃO:
require '../_app/Config.inc.php';

//A VARIÁVEL $JSON É CRIADA COMO ARRAY PARA QUE NO FINAL DO CODIGO ELA SERÁ A VARIAVEL DE RESPOSTA DA CONTROLER:
$jSon = array();

//$getPost É A VARIÁVEL QUE RECEBE OS DADOS ENVIADOS DO ARQUIVO JS:
$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (count($getPost) == 1):

    $getQuery = array_keys($getPost);

    $queryPesquisa = (is_int($getQuery[0]) ? $getQuery[0] : strip_tags(str_replace('_', ' ', $getQuery[0])));

    $buscarMensalidade = new Read;

    if ($queryPesquisa >= 1):
        $buscarMensalidade->FullRead("SELECT mensalidades.idmensalidades, mensalidades.valor_mensalidades, mensalidades.data_mens_pag, mensalidades.status_mensalidades, alunos_cliente.idalunos_cliente, alunos_cliente.nome_aluno " .
                "FROM mensalidades " .
                "LEFT JOIN alunos_cliente ON mensalidades.idmensalidades = alunos_cliente.idalunos_cliente " .
                "WHERE alunos_cliente.idalunos_cliente = {$queryPesquisa}");
        $jSon = $buscarMensalidade->getResult();
    elseif ($queryPesquisa === 0):
        $buscarMensalidade->FullRead("SELECT mensalidades.idmensalidades, mensalidades.valor_mensalidades, mensalidades.data_mens_pag, mensalidades.status_mensalidades, alunos_cliente.idalunos_cliente, alunos_cliente.nome_aluno " .
                "FROM mensalidades " .
                "LEFT JOIN alunos_cliente ON mensalidades.idmensalidades = alunos_cliente.idalunos_cliente");
        $jSon = $buscarMensalidade->getResult();
    elseif (is_string($queryPesquisa)):
        $buscarMensalidade->FullRead("SELECT mensalidades.idmensalidades, mensalidades.valor_mensalidades, mensalidades.data_mens_pag, mensalidades.status_mensalidades, alunos_cliente.idalunos_cliente, alunos_cliente.nome_aluno " .
                "FROM mensalidades " .
                "LEFT JOIN alunos_cliente ON mensalidades.idmensalidades = alunos_cliente.idalunos_cliente " .
                "WHERE alunos_cliente.nome_aluno LIKE '%{$queryPesquisa}%'");
        $jSon = $buscarMensalidade->getResult();
    endif;
else:
    if (empty($getPost['callback'])):
        $jSon['trigger'] = "<div class='alert alert-warning'>Ação não selecionada!</div>";
    else:

        $Post = array_map("strip_tags", $getPost);
        $Action = $Post['callback'];
        unset($Post['callback']);

        switch ($Action):
            case 'create-mensalidade':

                $Tabela = 'mensalidades';

                require '../Models/model.mensalidade.create.php';

                $CadMensalidade = new Mensalidade;
                $CadMensalidade->novoMensalidade($Tabela, $Post);

                if ($CadMensalidade->getResult()):
                    $idNovaMens = $CadMensalidade->getResult();
                    $mensCadastrada = new Read;
                    $mensCadastrada->FullRead("SELECT mensalidades.idmensalidades, mensalidades.valor_mensalidades, mensalidades.data_mens_pag, mensalidades.status_mensalidades, alunos_cliente.idalunos_cliente, alunos_cliente.nome_aluno " .
                            "FROM mensalidades " .
                            "LEFT JOIN alunos_cliente ON mensalidades.idmensalidades = alunos_cliente.idalunos_cliente " .
                            "WHERE mensalidades.idmensalidades = :idmensalidades", "idmensalidades={$idNovaMens}");

                    if ($mensCadastrada->getResult()):
                        $novaMens = $mensCadastrada->getResult();
                        $jSon['idmensalidades'] = $novaMens[0];

                        $jSon['sucesso'] = true;

                        $jSon['clear'] = true;
                    endif;
                endif;

                break;
        
            default :
                $jSon['trigger'] = "<div class='alert alert-warning'>Ação não selecionada!</div>";
                break;
        endswitch;
    endif;
endif;
//USANDO O ECHO OS GATILHOS VOLTA VIA AJAX UTILIZANDO JSON PARA O ARQUIVO JS E LÁ SERÁ INTERPRETADO:
echo json_encode($jSon);

