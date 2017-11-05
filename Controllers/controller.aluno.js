//INICIAR JQUERY:
$(function () {
    //A FUNÇÃO ABAIXO EVITA QUE AO TECLAR ENTER O INPUT DE PESQUISA FAÇA UMA NOVA REQUISIÇÃO HTTP
    $('.pesquisar-aluno').on('keypress', function (e) {
        return e.which !== 13;
    });
    //FUNÇÃO RESPONSÁVEL POR FAZER CONSULTAS DE ACORDO COM PESQUISAS DO USUÁRIO:
    $(".pesquisar-aluno").keyup(function () {
        var termo = $(".pesquisar-aluno").val();
        if (termo === '') {
            termo = '0';
        }
        $.ajax({
            url: "Controllers/controller.aluno.php",
            data: termo,
            type: 'POST',
            dataType: 'json',
            beforeSend: function (xhr) {

            },
            success: function (data) {
                $('.j-result-alunos').html('');
                $(data).each(function (index, value) {
                    $('.j-result-alunos').append("<tr id='" + value.idalunos_cliente + "'>" +
                            "<td>" + value.idalunos_cliente + "</td>" +
                            "<td>" + value.nome_aluno + "</td>" +
                            "<td>" + value.status_aluno + "</td>" +
                            "<td><button id='aluno-editar' class='btn btn-success btn-xs open-modal-update' idalunos_cliente='" + value.idalunos_cliente + "' idendereco_aluno='" + value.idendereco_aluno + "'><i class='glyphicon glyphicon-edit'></i></button>" +
                            "&nbsp;&nbsp;&nbsp;<a href='http://localhost/academia/Views/view.aluno.relatorio.php' target='_blank'><button id='imprimir' class='btn btn-warning btn-xs'><i class='glyphicon glyphicon-print'></i></button></a> " +
                            "</td>" +
                            "</tr>");
                });
            }
        });
    });
//    FUNÇÃO RESPONSÁVEL POR CADASTRAR UM NOVO ALUNO NO BANCO DE DADOS: 
    $(".j-form-create-aluno").submit(function () {
//        VARIAVEL FORM RECEBE O PROPRIO FORMULARIO USANDO O METODO DO JQUERY "THIS":
        var Form = $(this);
//        VARIAVEL ACTION RECEBE O VALOR DO CALLBACK QUE É UM INPUT ESCONDIDO NO FORMULARIO ESSE CALLBACK SERVE COMO GATILHO PARA CONDIÇÕES:
        var Action = Form.find('input[name="callback"]').val();
//        VARIAVEL DATA RECEBE UMA MATRIZ COM OS DADOS DO FORMULARIO (FORM) INDICE E VALOR:
        var Data = Form.serialize();

//        INICIAÇÃO DO AJAX - PARA ENVIAR E RECEBER DADOS:
        $.ajax({
//            URL É O CAMINHO QUE ESTÁ A CONTROLLER, ONDE SERÃO ENVIADOS OS DADOS DO FORMULARIO (FORM -> DATA):
            url: "Controllers/controller.aluno.php",
//            DATA SÃO OS DADOS QUE SERÃO ENVIADOS:
            data: Data,
//            TYPE É O MÉTODO USADO PARA O ENVIO DOS DADOS:
            type: 'POST',
//            DATATYPE É O TIPO DE DADOS TRAFÉGADOS:
            dataType: 'json',
//            BEFORE SEND É A FUNÇÃO QUE PERMITE EXECUTAR UM ALGORITMO DO JQUERY ANTES DOS DADOS SEREM ENVIADOS:
            beforeSend: function (xhr) {
//                PODE-SE NESSA PARTE MOSTRAR E RETIRAR POR EXEMPLO ELEMENTOS DO HTML:
                alert('enviou');
            },
//            SUCCESS É A FUNÇÃO DO AJAX RESPONSÁVEL POR EXECUTAR ALGORITMOS DEPOIS QUE OS DADOS RETORNAM DA CONTROLLER, TAIS DADOS PODEM SER ACESSADOS PELA VARIAVEL "(data)":
            success: function (data) {

//                NESSA PARTE É INTERESSANTE EXECUTAR AÇÕES DE ACORDO COM OS RESULTADOS VINDOS DA CONTROLER UTILIZANDO CONDIÇÕES:
                alert('voltou');

                if (data.sucesso) {
                    $('.alert-success').fadeIn();
                }
                if (data.clear) {
                    Form.trigger('reset');
                }
                $('.modal-create').fadeOut();
                if (data.novoaluno) {
                    var novoAluno = data.novoaluno;
                    $('.j-result-alunos').prepend("<tr id='" + novoAluno.idalunos_cliente + "' class='animated zoomInDown'>" +
                            "<td>" + novoAluno.idalunos_cliente + "</td>" +
                            "<td>" + novoAluno.nome_aluno + "</td>" +
                            "<td>" + novoAluno.status_aluno + "</td>" +
                            "<td><button id='aluno-editar' class='btn btn-success btn-xs open-modal-update' idalunos_cliente='" + novoAluno.idalunos_cliente + "' idendereco_aluno='" + novoAluno.idendereco_aluno + "'><i class='glyphicon glyphicon-edit'></i></button>" +
                            "&nbsp;&nbsp;&nbsp;<a href='http://localhost/academia/Views/view.aluno.relatorio.php' target='_blank'><button id='imprimir' class='btn btn-warning btn-xs'><i class='glyphicon glyphicon-print'></i></button></a> " +
                            "</td>" +
                            "</tr>");
                    setTimeout(function () {
                        $("tr[id='" + novoAluno.idalunos_cliente + "']:first").removeClass("animated zoomInDown");
                    }, 1000);
                }
            }
        });

//        RETURN É A FUNÇÃO PARA NÃO PERMITIR QUE O FORMULÁRIO GERE AÇÃO: 
        return false;
    });

//    FUNÇÃO RESPONSÁVEL POR ATUALIZAR OS DADOS NO BANCO DE DADOS:
    $('.j-form-update-aluno').submit(function () {
        var Form = $(this);
        var Data = Form.serialize();

        $.ajax({
            url: "Controllers/controller.aluno.php",
            data: Data,
            type: 'POST',
            dataType: 'json',
            beforeSend: function (xhr) {
            },
            success: function (data) {
                if (data.clear) {
                    Form.trigger('reset');
                }
                if (data.sucesso) {
                    $('.modal-update').fadeOut(0);
                    $('.close-modal-update').fadeOut(0);
                    $('.pesquisar').fadeIn(0);
                    $('.open-modal-create').fadeIn(0);
                    $('.relatorio-geral').fadeIn(0);
                    $('.modal-table').fadeIn(0);
                }
                if (data.content) {
                    var alunoEditado = data.content;
                    //FUNÇÃO RESPONSÁVEL POR OCULTAR DO DOM O REGISTRO QUE FOI EDITADO COM EFEITO ANIMATE E POIS FADEOUT, POIS O EFEITO DO ANIMTE GERA UM CSS COMO 'display: hidden' E NÃO 'display: none', E DEIXA ESPAÇO NO HTML, POR ISSO O USO DA FUNÇÃO 'fadeOut()' POSTERIORMENTE.
                    $('html').find("tr[id='" + alunoEditado.idalunos_cliente + "']").addClass("animated zoomOutDown").fadeOut(720);
                    //FUNÇÃO RESPONSÁVEL POR INSERIR NO DOM O NOVO ALUNO CADASTRADO. *IMPORTANTE USAR O PARÂMETRO ':first' PARA QUE O JQUERY COLOQUE O NOVO ALUNO ACIMA DO ANTIGO REGISTRO, CASO NÃO TENHA O PARÂMETRO O MESMO ALUNO EDITADO PODERÁ SER INSERIDO NO DOM MAIS DE UMA VEZ.
                    $("tr[id='" + alunoEditado.idalunos_cliente + "']:first").before("<tr id='" + alunoEditado.idalunos_cliente + "' class='animated zoomInDown'>" +
                            "<td>" + alunoEditado.idalunos_cliente + "</td>" +
                            "<td>" + alunoEditado.nome_aluno + "</td>" +
                            "<td>" + alunoEditado.status_aluno + "</td>" +
                            "<td><button id='aluno-editar' class='btn btn-success btn-xs open-modal-update' idalunos_cliente='" + alunoEditado.idalunos_cliente + "' idendereco_aluno='" + alunoEditado.idendereco_aluno + "'><i class='glyphicon glyphicon-edit'></i></button>" +
                            "&nbsp;&nbsp;&nbsp;<a href='http://localhost/academia/Views/view.aluno.relatorio.php' target='_blank'><button id='imprimir' class='btn btn-warning btn-xs'><i class='glyphicon glyphicon-print'></i></button></a> " +
                            "</td>" +
                            "</tr>");
                    //ESSA FUNÇÃO EVITA QUE AO ADICIONAR UM NOVO USUÁRIO DIFERENTE GERE EFEITOS EM ELEMENTOS QUE JÁ FORAM CADASTRADOS ANTES.
                    setTimeout(function () {
                        $("tr[id='" + alunoEditado.idalunos_cliente + "']:first").removeClass("animated zoomInDown");
                    }, 1000);
                }
            }
        });

        return false;
    });

//FUNÇÃO PARA PREENCHER A DIV DE ATUALIZAÇÃO DE CADASTRO COM OS DADOS DE CADA ALUNO:
    $('html').on('click', '.open-modal-update', function () {
        var button = $(this);
        var idalunos_cliente = $(button).attr('idalunos_cliente');
        var idendereco_aluno = $(button).attr('idendereco_aluno');
        var dados_edit = {callback: 'povoar-edit', idalunos_cliente: idalunos_cliente, idendereco_alunos: idendereco_aluno};
        $.ajax({
            url: "Controllers/controller.aluno.php",
            data: dados_edit,
            type: 'POST',
            dataType: 'json',
            beforeSend: function (xhr) {

            },
            success: function (data) {
                var Form = $('.j-form-update-aluno');
                $.each(data, function (key, value) {
                    Form.find("input[name='" + key + "']").val(value);
                });
            }
        });
    });

//    SELECIONAR CIDADE DE ACORDO COM O ESTADO:


});