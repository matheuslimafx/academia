<?php

//IMPORTA O ARQUIVO DE CONFIGURAÇÃO:
require '../_app/Config.inc.php';

//A VARIAVEL $JSON É CRIADA COMO ARRAY PARA QUE NO FINAL DO CODIGO ELA SEJA A VARIAVEL DE RESPOSTA DA CONTROLLER:
$jSon = array();

//$getPost É A VARIAVEL QUE RECEBE OS DADOS ENVIADOS DO ARQUIVO JS:
$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//Verifica se os dados vindos do arquivo js são referentes a função pesquisa por anamnese. Caso o tamanho do array seja igual a 1 é referente a pesquisa. Caso o array seja maior que 1 significa que são dados para realizar o CRUD.
if (count($getPost) == 1):

    $getQuery = array_keys($getPost);

    $queryPesquisa = (is_int($getQuery[0]) ? $getQuery[0] : strip_tags(str_replace('_', ' ', $getQuery[0])));

    $buscarAnamnese = new Read;

    if ($queryPesquisa >= 1):
        $buscarAnamnese->FullRead("SELECT anamneses.idanamneses, anamneses.idalunos_cliente, alunos_cliente.nome_aluno "
                . "FROM anamneses "
                . "LEFT JOIN alunos_cliente ON anamneses.idalunos_cliente = alunos_cliente.idalunos_cliente "
                . "WHERE anamneses.idalunos_cliente = {$queryPesquisa}");
        $jSon = $buscarAnamnese->getResult();
    elseif ($queryPesquisa === 0):
        $buscarAnamnese->FullRead("SELECT anamneses.idanamneses, anamneses.idalunos_cliente, alunos_cliente.nome_aluno "
                . "FROM anamneses "
                . "LEFT JOIN alunos_cliente ON anamneses.idalunos_cliente = alunos_cliente.idalunos_cliente");
        $jSon = $buscarAnamnese->getResult();
    elseif (is_string($queryPesquisa)):
        $buscarAnamnese->FullRead("SELECT anamneses.idanamneses, anamneses.idalunos_cliente, alunos_cliente.nome_aluno "
                . "FROM anamneses "
                . "LEFT JOIN alunos_cliente ON anamneses.idalunos_cliente = alunos_cliente.idalunos_cliente "
                . "WHERE alunos_cliente.nome_aluno LIKE '%{$queryPesquisa}%'");
        $jSon = $buscarAnamnese->getResult();
    endif;
else:

//PRIMEIRA CONDIÇÃO  - NESSA CONDIÇÃO VERIFICA, SE O INDICE CALLBACK FOI PREENCHIDO:
    if (empty($getPost['callback'])):
        //CASO NÃO HAJA O INDICE CALLBACK UM GATILHO DE ERRO (TRIGGER) É CRIADO NO ARRAY $jSon:
        $jSon['trigger'] = "<div class 'alert alert warning'>Ação não selecionada 1!</div>";
    else:

        //CASO O CALLBACK ESTEJA CORRETO A FUNÇÃO ARRAY_MAP INICIA A 'LIMPEZA' DOS VALORES DE CADA INDICE RETIRANDO TAGS DE SQL INJECTION E OUTRAS AMEAÇAS:
        $Post = array_map("strip_tags", $getPost);

        //A VARIAVEL $Action É CRIADA PARA RECEBER O ACTION DO ARRAY QUE VEIO DO JS:
        $Action = $Post['callback'];

        //O INDICE 'CALLBACK' E O SEU RESPECTIVO VALOR SÃO DESMEMBRADOS DA VARIAVEL POST, ISSO É NECESSÁRIO PARA ENVIAR PARA O BANCO APENAS OS DADOS NECESSÁRIOS:
        unset($Post['callback']);

        //SWITCH SERÁ AS CONDIÇÕES VERIFICADAS E USADAS PARA TOMAR AÇÕES DE ACORDO COM CADA CALLBACK:
        switch ($Action):
            //CONDIÇÃO 'anamnese' ATENDIDA:
            case 'buscar-estoque-produto':
                $LerEstoque = new Read;
                $LerEstoque->FullRead("SELECT estoq_prod.idestoques, estoq_prod.quant_estoque, produtos.valor_prod "
                        . "FROM estoq_prod "
                        . "INNER JOIN produtos ON estoq_prod.idprodutos = produtos.idprodutos "
                        . "WHERE estoq_prod.idprodutos = :idprodutos", "idprodutos={$Post['idprodutos']}");
                if ($LerEstoque->getResult()):
                    $idEstoque = $LerEstoque->getResult();
                    $jSon = $idEstoque[0];
                endif;
                break;

            case 'adicionar-carrinho';
                if (!array_key_exists('idprodutos', $Post)):
                    $jSon['trigger'] = "Atenção é preciso selecionar um Produto para ser adicionado ao carrinho";
                elseif (empty($Post['qt_vendas'])):
                    $jSon['trigger'] = "Atenção é preciso inserir a quantidade itens a serem adicionados ao carrinho";
                else:
                    session_start();
//                unset($_SESSION['itens_vendas']);
                    $idProduto = $Post['idprodutos'];
                    $LerNomeProduto = new Read;
                    $LerNomeProduto->FullRead("SELECT produtos.nome_prod FROM produtos WHERE produtos.idprodutos = :idprodutos", "idprodutos={$idProduto}");
                    if ($LerNomeProduto->getResult()):
                        $NameProduto = $LerNomeProduto->getResult();
                        $Post['nome_prod'] = $NameProduto[0]['nome_prod'];
                        $_SESSION['itens_vendas']["{$idProduto}"] = $Post;
                        $i = (float) 0;
                        foreach ($_SESSION['itens_vendas'] as $e):
                            extract($e);
                            $i += $valor_vendas;
                        endforeach;
                        $_SESSION['valor_total'] = $i;
                        $jSon['valor_total'] = $i;
                        $jSon['item_info'] = $Post;
                        $jSon['sucesso'] = true;
                    endif;
                endif;
                break;


            case 'cadastrar-venda':
                if(!array_key_exists("idalunos_cliente", $Post)):
                    $jSon['trigger'] = "Selecione um cliente antes de concluir a venda.";
                else:
                    session_start();
                    foreach ($_SESSION['itens_vendas'] as $e):
                        var_dump($e);
                    endforeach;
                endif;
                break;

            //CASO O CALLBACK NÃO SEJA ATENDIDO O DEFAULT SETA O GATILHO DE ERRO (TRIGGER) RESPONSAVEL POR RETORNAR O ERRO AO JS:
            default :
                $jSon['trigger'] = "<div class='alert alert-warning'>Ação não selecionada 2!</div>";
                break;
        endswitch;

    endif;
endif;
echo json_encode($jSon);
