<?php

//IMPORTA O ARQUIVO DE CONFIGURAÇÃO:
require '../_app/Config.inc.php';

//A VARIÁVEL $JSON É CRIADA COMO ARRAY PARA QUE NO FINAL DO CODIGO ELA SERÁ A VARIAVEL DE RESPOSTA DA CONTROLER:
$jSon = array();

//$getPost É A VARIÁVEL QUE RECEBE OS DADOS ENVIADOS DO ARQUIVO JS:
$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Verifica se os dados vindos do arquivo js são referentes a função pesquisa por aluno. Caso o tamanho do array seja igual a 1 é referente a pesquisa. Caso o array seja maior que 1 significa que são dados para realizar o CRUD.
if (count($getPost) == 1):
    //Passa o valor do índice(key) para a variável e não o valor que está armazenado naquele índice, mas sim o índice em si:
    $getQuery = array_keys($getPost);
    //A $queryPesquisa recebe o termo da pesquisa que foi armazenado no índice '0' da variável $getQuery. Caso o valor em '$getQuery[0]' seja do tipo STRING é retirado os '_' e subtituido por ' ' utilizando a função 'str_replace' e feito a prevenção contra scripts maliciosos utilizando o 'strip_tags'. Caso 'getQuery[o]' seja do tipo INT não é efetuado o tratamento:
    $queryPesquisa = (is_int($getQuery[0]) ? $getQuery[0] : strip_tags(str_replace('_', ' ', $getQuery[0])));
    //Cria um novo objeto para consultar no banco de dados o resultado da pesquisa referente ao termo que foi colocado na variável $queryPesquisa.
    $buscarAluno = new Read;

    //CONDIÇÃO PARA VERIFICAR SE O TERMO DE PESQUISA É INT, CASO SEJA SERÁ REALIZADO UMA CONSULTA NO BANCO DE DADOS PELA MATRÍCULA OU CASO SEJA STRING SERÁ FEITA A CONSULTA NO BANCO DE DADOS PELO NOME DO ALUNO.
    if (is_int($queryPesquisa)):
        $buscarAluno->FullRead("SELECT idalunos_cliente, nome_aluno, status_aluno FROM alunos_cliente WHERE idalunos_cliente = {$queryPesquisa}");
        $jSon = $buscarAluno->getResult();
        echo json_encode($jSon);
    elseif (is_string($queryPesquisa)):
        $buscarAluno->FullRead("SELECT idalunos_cliente, nome_aluno, status_aluno FROM alunos_cliente WHERE nome_aluno LIKE '%{$queryPesquisa}%'");        
        $jSon = $buscarAluno->getResult();
        echo json_encode($jSon);
    endif;
else:
    //PRIMEIRA CONDIÇÃO - NESSA CONDIÇÃO VERIFICA SE O INDICE CALLBACK FOI PREENCHIDO:
    if (empty($getPost['callback'])):
//    CASO NÃO HAJA O INDICE CALLBACK UM GATILHO DE ERRO (TRIGGER) É CRIADO NO ARRAY $jSon:
        $jSon['trigger'] = "<div class='alert alert-warning'>Ação não selecionada *1!</div>";
    else:
//    CASO O CALLBACK ESTEJA CORRETO A FUNÇÃO ARRAY_MAP INICIA A 'LIMPEZA' DOS VALORES DE CADA INDICE RETIRANDO TAGS DE SQL INJECTION E OUTRAS AMEAÇAS:
        $Post = array_map("strip_tags", $getPost);

//A VARIAVEL $Action É CRIADA PARA RECEBER O ACTION DO ARRAY QUE VEIO DO JS:
        $Action = $Post['callback'];

        $EnderecoAluno = array();
        $EnderecoAluno['idcidade'] = $Post['idcidade'];
        $EnderecoAluno['idestado'] = $Post['idestado'];
        $EnderecoAluno['complementos_aluno'] = $Post['complementos_aluno'];

//    O INDICE 'CALLBACK' E O SEU RESPECTIVO VALOR SÃO DESMEMBRADOS DA VARIAVEL POST, ISSO É NECESSÁRIO PARA ENVIAR PARA O BANCO APENAS OS DADOS NECESSÁRIOS:
        unset($Post['callback']);

        unset($Post['idcidade']);
        unset($Post['idestado']);
        unset($Post['complementos_aluno']);
//    SWITCH SERÁ AS CONDIÇÕES VERIFICADAS E USADAS PARA TOMAR AÇÕES DE ACORDO COM CADA CALLBACK:
        switch ($Action):

//        CONDIÇÃO  'aluno' ATENDIDA:
            case 'aluno':

//            CRIAÇÃO DE UMA VARIÁVEL RESPONSÁVEL POR RECEBER  O NOME DA TABELA QUE SERÁ INSERIDA OS DADOS NO BANCO:
                $Tabela = "alunos_cliente";

//            INSERIR A CLASSE DA MODEL RESPONSÁVEL PELA INTERAÇÃO COM O BANCO DE DADOS:
                require '../Models/model.aluno.php';

//            INSTÂNCIA DO OBJETO DA CLASSE ALUNO RESPONSÁVEL POR CADASTRAR NOVOS ALUNOS NO BANCO DE DADOS:
                $CadEndAluno = new Aluno;
                $CadEndAluno->novoEnderecoAluno("endereco_aluno", $EnderecoAluno);
                $IdEnderecoAluno = $CadEndAluno->getResult();

                $Post['idendereco_aluno'] = $IdEnderecoAluno;

                $CadastrarAluno = new Aluno;

//            MÉTODO DA CLASSE ALUNO RESPONSÁVEL POR CADASTRAR NOVOS ALUNOS NO BANCO DE DADOS:
                $CadastrarAluno->novoAluno($Tabela, $Post);

//            CONDIÇÃO PARA VERIFICAR SE FOI CADASTRADO UM NOVO ALUNO, UTILIZANDO UM MÉTODO DA CLASSE ALUNO:
                if ($CadastrarAluno->getResult()):

//                CONFIGURANDO UM GATILHO DE SUCESSO AO EXECUTAR O CADASTRO, TAL GATILHO SERÁ INTERPRETADO PELO ARQUIVO JS:
                    $jSon['sucesso'] = true;

//                GATILHO QUE SERÁ INTERPRETADO PELO ARQUIVO JS PARA LIMPAR OS CAMPOS DO FORMULÁRIO APÓS O CADASTRO:
                    $jSon['clear'] = true;
                endif;
                
                break;

//        CASO O CALLBACK NÃO SEJA ATENDIDO O DEFAULT SETA O GATILHO DE ERRO (TRIGGER) RESPONSÁVEL POR RETORNAR O ERRO AO JS:
            default:
                $jSon['trigger'] = "<div class='alert alert-warning'>Ação não selecionada! *2</div>";
                break;
        endswitch;

    endif;

//USANDO O ECHO OS GATILHOS VOLTA VIA AJAX UTILIZANDO JSON PARA O ARQUIVO JS E LÁ SERÁ INTERPRETADO:
    echo json_encode($jSon);  
    
endif;