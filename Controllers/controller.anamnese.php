<?php

//IMPORTA O ARQUIVO DE CONFIGURAÇÃO:
require '../_app/Config.inc.php';

//A VARIAVEL $JSON É CRIADA COMO ARRAY PARA QUE NO FINAL DO CODIGO ELA SEJA A VARIAVEL DE RESPOSTA DA CONTROLLER:
$jSon = array();

//$getPost É A VARIAVEL QUE RECEBE OS DADOS ENVIADOS DO ARQUIVO JS:
$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//PRIMEIRA CONDIÇÃO  - NESSA CONDIÇÃO VERIFICA, SE O INDICE CALLBACK FOI PREENCHIDO:
if (empty($getPost['callback'])):
    //CASO NÃO HAJA O INDICE CALLBACK UM GATILHO DE ERRO (TRIGGER) É CRIADO NO ARRAY $jSon:
    $jSon['trigger'] = "<div class 'alert alert warning'>Ação não selecionada!</div>";
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
        case 'anamnese':
            //CRIAÇÃO DE UMA VARIAVEL REPONSAVEL POR RECEBER O NOME DA TABELA QUE SERPA INSERIDA OS DADOS
            $Tabela = "anamneses";

            //INSERIR A CLASSE DA MODEL RESPONSAVEL PELA INTERAÇÃO COM O BANCO DE DADOS:
            require '../Models/model.anamnese.php';

            //INSTANCIA DO OBJETO DA CLASSE ANAMNESE RESPONSAVEL POR CADASTRAR NOVAS ANAMNESES:
            $CadastrarAnamnese = new Anamnese;

            //METODO DA CLASSE ANAMNESE REPONSAVEL POR CADASTRAR NOVAS ANAMNESES:
            $CadastrarAnamnese->novoAnamnese($Tabela, $Post);

            //CONDIÇÃO PARA VERIFICAR SE FOI CADASTRADO UMA NOVA ANAMNESE, UTILIZANDO UM METODO DA CLASSE ANAMNESE:
            if ($CadastrarAnamnese->getResult()):
                //CONFIGURANDO UM GATILHO DE SUCESSO AO EXECUTAR O CADASTRO, TAL GATILHO SERÁ INTERPRETADO PELO JS:
                $jSon['sucesso'] = true;

                //GATILHO QUE SERÁ INTERPRETADO PELO ARQUIVO JS PARA LIMPAR OS CAMPOS DO FORMULÁRIO APÓS CADASTRO:
                $jSon['clear'] = true;
            endif;

            break;
        //CASO O CALLBACK NÃO SEJA ATENDIDO O DEFAULT SETA O GATILHO DE ERRO (TRIGGER) RESPONSAVEL POR RETORNAR O ERRO AO JS:
        default :
            $jSon['trigger'] = "<div class='alert alert-warning'>Ação não selecionada!</div>";
            break;
    endswitch;

endif;

echo json_encode($jSon);
?>

