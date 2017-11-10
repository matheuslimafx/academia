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

    $buscarMensPag = new Read;

    //Mensalidades Em dia
    if ($queryPesquisa >= 1):
        $buscarMensPag->FullRead("SELECT mensalidades.idmensalidades, mensalidades.valor_mensalidades, mensalidades.data_mens_pag, mensalidades.status_mensalidades, alunos_cliente.idalunos_cliente, alunos_cliente.nome_aluno " .
                "FROM mensalidades " .
                "LEFT JOIN alunos_cliente ON mensalidades.idmensalidades = alunos_cliente.idalunos_cliente " .
                "WHERE status_mensalidades = 'Em dia' AND alunos_cliente.idalunos_cliente = {$queryPesquisa}");
        $json = $buscarMensPag->getResult();

    elseif ($queryPesquisa === 0):
        $buscarMensPag->FullRead("SELECT mensalidades.idmensalidades, mensalidades.valor_mensalidades, mensalidades.data_mens_pag, mensalidades.status_mensalidades, alunos_cliente.idalunos_cliente, alunos_cliente.nome_aluno " .
                "FROM mensalidades " .
                "LEFT JOIN alunos_cliente ON mensalidades.idmensalidades = alunos_cliente.idalunos_cliente " .
                "WHERE status_mensalidades = 'Em dia'");
        $json = $buscarMensPag->getResult();
        var_dump($json);
    elseif (is_string($queryPesquisa)):
        $buscarMensPag->FullRead("SELECT mensalidades.idmensalidades, mensalidades.valor_mensalidades, mensalidades.data_mens_pag, mensalidades.status_mensalidades, alunos_cliente.idalunos_cliente, alunos_cliente.nome_aluno " .
                "FROM mensalidades " .
                "LEFT JOIN alunos_cliente ON mensalidades.idmensalidades = alunos_cliente.idalunos_cliente " .
                "WHERE status_mensalidades = 'Em dia' AND alunos_cliente.nome_aluno LIKE '%{$queryPesquisa}%'");
        $json = $buscarMensPag->getResult();
        var_dump($json);
    endif;
else:
    //PRIMEIRA CONDIÇÃO - NESSA CONDIÇÃO VERIFICA SE O INDICE CALLBACK FOI PREENCHIDO:
    if (empty($getPost['callback'])):
//    CASO NÃO HAJA O INDICE CALLBACK UM GATILHO DE ERRO (TRIGGER) É CRIADO NO ARRAY $jSon:
        $jSon['trigger'] = "<div class='alert alert-warning'>Ação não selecionada!</div>";
    else:
//    CASO O CALLBACK ESTEJA CORRETO A FUNÇÃO ARRAY_MAP INICIA A 'LIMPEZA' DOS VALORES DE CADA INDICE RETIRANDO TAGS DE SQL INJECTION E OUTRAS AMEAÇAS:
        $Post = array_map("strip_tags", $getPost);

//A VARIAVEL $Action É CRIADA PARA RECEBER O ACTION DO ARRAY QUE VEIO DO JS:
        $Action = $Post['callback'];

//    O INDICE 'CALLBACK' E O SEU RESPECTIVO VALOR SÃO DESMEMBRADOS DA VARIAVEL POST, ISSO É NECESSÁRIO PARA ENVIAR PARA O BANCO APENAS OS DADOS NECESSÁRIOS:
        unset($Post['callback']);

//    SWITCH SERÁ AS CONDIÇÕES VERIFICADAS E USADAS PARA TOMAR AÇÕES DE ACORDO COM CADA CALLBACK:
        switch ($Action):

//        CONDIÇÃO  'mensalidade' ATENDIDA:
            case 'mensalidade':

//            CRIAÇÃO DE UMA VARIÁVEL RESPONSÁVEL POR RECEBER  O NOME DA TABELA QUE SERÁ INSERIDA OS DADOS NO BANCO:
                $Tabela = "mensalidades";

//            INSERIR A CLASSE DA MODEL RESPONSÁVEL PELA INTERAÇÃO COM O BANCO DE DADOS:
                require '../Models/model.mensalidade.php';

//            INSTÂNCIA DO OBJETO DA CLASSE MENSALIDADE RESPONSÁVEL POR CADASTRAR NOVOS EQUIPAMENTOS NO BANCO DE DADOS:
                $CadastrarMens = new Mensalidade;

//            MÉTODO DA CLASSE MENSALIDADE RESPONSÁVEL POR CADASTRAR NOVOS MENSALIDADES NO BANCO DE DADOS:
                $CadastrarMens->novoMensalidade($Tabela, $Post);

//            CONDIÇÃO PARA VERIFICAR SE FOI CADASTRADO UMA NOVA MENSALIDADE, UTILIZANDO UM MÉTODO DA CLASSE MENSALIDADE:
                if ($CadastrarMens->getResult()):

//                CONFIGURANDO UM GATILHO DE SUCESSO AO EXECUTAR O CADASTRO, TAL GATILHO SERÁ INTERPRETADO PELO ARQUIVO JS:
                    $jSon['sucesso'] = true;

//                GATILHO QUE SERÁ INTERPRETADO PELO ARQUIVO JS PARA LIMPAR OS CAMPOS DO FORMULÁRIO APÓS O CADASTRO:
                    $jSon['clear'] = true;
                endif;


                break;

//        CASO O CALLBACK NÃO SEJA ATENDIDO O DEFAULT SETA O GATILHO DE ERRO (TRIGGER) RESPONSÁVEL POR RETORNAR O ERRO AO JS:
            default:
                $jSon['trigger'] = "<div class='alert alert-warning'>Ação não selecionada!</div>";
                break;
        endswitch;

    endif;
endif;
//USANDO O ECHO OS GATILHOS VOLTA VIA AJAX UTILIZANDO JSON PARA O ARQUIVO JS E LÁ SERÁ INTERPRETADO:
echo json_encode($jSon);

