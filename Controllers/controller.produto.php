<?php

//IMPORTA O ARQUIVO DE CONFIGURAÇÃO:
require '../_app/Config.inc.php';

//A VARIAVEL $JSON É CRIADA COMO ARRAY PARA QUE NO FINAL DO CODIGO ELA SEJPA A VARIAVEL DE  RESPOSTA DA CONTROLLER:
$jSon = array();

//$getPost É A VARIAVEL QUE RECEBE OS DADOS ENVIADOS DO ARQUIVO JS:
$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//VERIFICA SE OS DADOS VINDOS DO ARQUIVO JS SÃO REFERENTES A FUNÇÃO PESQUISA POR PRODUTO.
//CASO O TAMANHO DO ARRAY SEJA IGUAL A 1 É REFERENTE A PESQUISA . CASO O ARRAY SEJA MAIOR
//QUE 1 SIGNIFICA QUE SÃO DADOS PARA REALIZAR O crud.
if(count($getPost) == 1):
    
    $getQuery = array_keys($getPost);

    $queryPesquisa = (is_int($getQuery[0]) ? $getQuery[0] : strip_tags(str_replace('_', ' ', $getQuery[0])));
    
    $buscarProduto = new Read;
    
    if($queryPesquisa >= 1):
        $buscarProduto->FullRead("SELECT produtos.idprodutos, produtos.nome_prod, " .
                        "cat_produto.descricao, " .
                        "fornecedores.nome_forn, " .
                        "estoq_prod.quant_estoque " .
                        "FROM produtos " .
                        "LEFT JOIN cat_produto ON  produtos.idprodutos = cat_produto.idcate_produto " .
                        "LEFT JOIN fornecedores ON produtos.idfornecedores = fornecedores.idfornecedores " .
                        "LEFT JOIN estoq_prod ON produtos.idprodutos = estoq_prod.idestoques " .
                        "WHERE produtos.idprodutos = {$queryPesquisa}");
        $jSon = $buscarProduto->getResult();
        
    elseif ($queryPesquisa === 0):
        $buscarProduto->FullRead("SELECT produtos.idprodutos, produtos.nome_prod, " .
                        "cat_produto.descricao, " .
                        "fornecedores.nome_forn, " .
                        "estoq_prod.quant_estoque " .
                        "FROM produtos " .
                        "LEFT JOIN cat_produto ON  produtos.idprodutos = cat_produto.idcate_produto " .
                        "LEFT JOIN fornecedores ON produtos.idfornecedores = fornecedores.idfornecedores " .
                        "LEFT JOIN estoq_prod ON produtos.idprodutos = estoq_prod.idestoques");
        $jSon = $buscarProduto->getResult();
        
    elseif (is_string($queryPesquisa)):
        $buscarProduto->FullRead("SELECT produtos.idprodutos, produtos.nome_prod, " .
                        "cat_produto.descricao, " .
                        "fornecedores.nome_forn, " .
                        "estoq_prod.quant_estoque " .
                        "FROM produtos " .
                        "LEFT JOIN cat_produto ON  produtos.idprodutos = cat_produto.idcate_produto " .
                        "LEFT JOIN fornecedores ON produtos.idfornecedores = fornecedores.idfornecedores " .
                        "LEFT JOIN estoq_prod ON produtos.idprodutos = estoq_prod.idestoques ".
                        "WHERE produtos.nome_prod LIKE '%{$queryPesquisa}%'");
        $jSon = $buscarProduto->getResult();
        
    endif;
    
    else:
        
        $Post = array_map("strip_tags", $getPost);
    
        $Action = $Post['calback'];
        
        unset($Post['calback']);
        
        switch ($Action):
            
            case 'produto';
                
                require '../Models/model.produto.php';
                
                $cadastarProduto = new ProdutoCreate;
                $cadastarProduto->novoProduto("produtos", $produtos);
        endswitch;
endif;
?>
