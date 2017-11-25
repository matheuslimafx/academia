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
                        . "INNER JOIN produtos ON produtos.idprodutos = estoq_prod.idestoques "
                        . "WHERE estoq_prod.idprodutos = :idprodutos", "idprodutos={$Post['idprodutos']}");
                if ($LerEstoque->getResult()):
                    $idEstoque = $LerEstoque->getResult();
                    $jSon = $idEstoque[0];
                endif;
                break;

            case 'cadastrar-venda':
                $Estoque = new Read;
                $Estoque->FullRead("SELECT estoq_prod.quant_estoque FROM estoq_prod WHERE estoq_prod.idestoques = :idestoques AND estoq_prod.idprodutos = :idprodutos", "idestoques={$Post['idestoques']}&idprodutos={$Post['idprodutos']}");
                if ($Estoque->getResult()):
                    $TotalEstoque = $Estoque->getResult();
                    $IntEstoque = (int) $TotalEstoque[0]['quant_estoque'];
                    if ($Post['qt_vendas'] > $IntEstoque):
                        $jSon['trigger'] = "Erro, você não possui no estoque a quantidade desejada para a venda. Seu estoque possui: " . $IntEstoque . " unidade(s) deste produto.";
                    else:
                        $novoEstoque = array();
                        $novoEstoque['quant_estoque'] = $IntEstoque - $Post['qt_vendas'];
                        require '../Controllers/../Models/model.estoque.update.php';
                        $UpdateEstoque = new AtualizarEstoque;
                        $UpdateEstoque->atualizarEstoque('estoq_prod', $novoEstoque, "WHERE estoq_prod.idestoques = :idestoques AND estoq_prod.idprodutos = :idprodutos", "idestoques={$Post['idestoques']}&idprodutos={$Post['idprodutos']}");
                        if (!$UpdateEstoque->getRowCount()):
                            $jSon['trigger'] = "Ops! Algo deu errado ao subtrair no estoque, atualize a página e tente novamente.";
                        else:
                            require '../Models/model.venda.create.php';
                            $Venda = new Venda;
                            $Venda->novaVenda('vendas', $Post);
                            if (!$Venda->getResult()):
                                echo $jSon['trigger'] = "Ops! Não foi possível gerar uma nova venda. Recarregue a página e tente novamente";
                            else:
                                $IdVendaGerada = $Venda->getResult();
                                $LerVenda = new Read;
                                $LerVenda->FullRead("SELECT vendas.idvendas, vendas.data_venda, vendas.valor_vendas, vendas.qt_vendas, " .
                                        "produtos.nome_prod, " .
                                        "alunos_cliente.nome_aluno " .
                                        "FROM vendas " .
                                        "INNER JOIN produtos ON  vendas.idprodutos = produtos.idprodutos " .
                                        "INNER JOIN alunos_cliente ON vendas.idalunos_cliente = alunos_cliente.idalunos_cliente " . 
                                        "WHERE vendas.idvendas = :idvendas", "idvendas={$IdVendaGerada}");
                                if(!$LerVenda->getResult()):
                                    echo $jSon['trigger'] = "Ops! Não foi possível encontrar a venda que você acabou de gerar. Recarregue a página e tente novamente!";
                                else:
                                    $DadosVenda = $LerVenda->getResult();
                                    $VendaFeita = $DadosVenda[0];
                                    $jSon['sucesso'] = true;
                                    $jSon['novavenda'] = $VendaFeita;
                                    $jSon['clear'] = true;
                                endif;        
                            endif;
                        endif;
                    endif;
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
