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

    $buscarUsuario = new Read;

    if ($queryPesquisa >= 1):
        $buscarUsuario->FullRead("SELECT usuario.idusuario, usuario.email_usuario, usuario.perfil_usuario, funcionarios.nome_func " .
                "FROM usuario " .
                "INNER JOIN funcionarios ON usuario.idfuncionarios = funcionarios.idfuncionarios " .
                "WHERE usuario.idusuario = {$queryPesquisa}");
        $jSon = $buscarUsuario->getResult();

    elseif ($queryPesquisa === 0):
        $buscarUsuario->FullRead("SELECT usuario.idusuario, usuario.email_usuario, usuario.perfil_usuario, funcionarios.nome_func " .
                "FROM usuario " .
                "INNER JOIN funcionarios ON usuario.idfuncionarios = funcionarios.idfuncionarios");
        $jSon = $buscarUsuario->getResult();

    elseif (is_string($queryPesquisa)):
        $buscarUsuario->FullRead("SELECT usuario.idusuario, usuario.email_usuario, usuario.perfil_usuario, funcionarios.nome_func " .
                "FROM usuario " .
                "INNER JOIN funcionarios ON usuario.idfuncionarios = funcionarios.idfuncionarios " .
                "WHERE funcionarios.nome_func LIKE '%{$queryPesquisa}%'");
        $jSon = $buscarUsuario->getResult();

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

//        CONDIÇÃO  'usuarios' ATENDIDA:
            case 'create-usuario':

//            CRIAÇÃO DE UMA VARIÁVEL RESPONSÁVEL POR RECEBER  O NOME DA TABELA QUE SERÁ INSERIDA OS DADOS NO BANCO:
                $Tabela = "usuario";

//            INSERIR A CLASSE DA MODEL RESPONSÁVEL PELA INTERAÇÃO COM O BANCO DE DADOS:
                require '../Models/model.usuario.create.php';

//            INSTÂNCIA DO OBJETO DA CLASSE USUARIO RESPONSÁVEL POR CADASTRAR NOVOS USUARIOS NO BANCO DE DADOS:

                $CadastrarUsuario = new Usuario;

//            MÉTODO DA CLASSE USUARIO RESPONSÁVEL POR CADASTRAR NOVOS USUARIOS NO BANCO DE DADOS:
                $CadastrarUsuario->novoUsuario($Tabela, $Post);

//            CONDIÇÃO PARA VERIFICAR SE FOI CADASTRADO UM NOVO USUARIO, UTILIZANDO UM MÉTODO DA CLASSE USUARIO:
                if ($CadastrarUsuario->getResult()):
                    $idNovoUsuario = $CadastrarUsuario->getResult();
                    $usuarioCadastrado = new Read;
                    $usuarioCadastrado->FullRead("SELECT usuario.idusuario, usuario.email_usuario, usuario.perfil_usuario, funcionarios.nome_func " .
                            "FROM usuario " .
                            "INNER JOIN funcionarios ON usuario.idfuncionarios = funcionarios.idfuncionarios " .
                            "WHERE usuario.idusuario = :idusuario", " idusuario={$idNovoUsuario}");

                    if ($usuarioCadastrado->getResult()):
                        $novoUsuario = $usuarioCadastrado->getResult();
                        $jSon['novousuario'] = $novoUsuario[0];

                        $jSon['sucesso'] = true;

                        $jSon['clear'] = true;
                    endif;
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

