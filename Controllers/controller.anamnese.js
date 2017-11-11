//INICIAR JQUERY:
$(function () {
    //A FUNÇÃO ABAIXO EVITA QUE AO TECLAR ENTER O INPUT DE PESQUISA FAÇA UMA NOVA REQUISIÇÃO HTTP
    $('.pesquisar-anamnese').on('keypress', function (e) {
        return e.which !== 13;
    });
    //FUNÇÃO RESPONSAVEL POR FAZER CONSULTAS DE ACORDO COM A PESQUISA DO USUÁRIO
    $(".pesquisar-anamnese").keyup(function () {
        var termo = $(".pesquisar-anamnese").val();
        if (termo === '') {
            termo = '0';
        }
        $.ajax({
            url: "Controllers/controller.anamnese.php",
            data: termo,
            type: 'POST',
            dataType: 'json',
            beforeSend: function (xhr) {

            },
            success: function (data) {
                $('.j-result-anamneses').html('');
                $(data).each(function (index, value) {
                    $('.j-result-anamneses').append(
                            "<tr id='" + value.idanamneses + "'>" +
                            "<td>" + value.idanamneses + "</td>" +
                            "<td>" + value.idalunos_cliente + "</td>" +
                            "<td>" + value.nome_aluno + "</td>" +
                            "<td align='right'>" +
                            "<button class='btn btn-success btn-xs open-modal-update' idanamenes='" + value.idanamneses + "'><i class='glyphicon glyphicon-edit'></i></button> " +
                            "<a href='http://localhost/academia/Views/view.anamnese.relatorio.php' target='_blank'><button class='btn btn-warning btn-xs open-imprimir'><i class='glyphicon glyphicon-print'></i></button></a> " +
                            "<button class='btn btn-danger btn-xs open-delete'><i class='glyphicon glyphicon-trash'></i></button>" +
                            "</td>" +
                            "</tr>"
                            );
                });
            }
        });
    });


    //FUNÇÃO RESPONSÁVEL POR CADASTRAR UMA NOVA ANAMNESE NO BANCO DE DADOS:
    $(".j-form-create-anamnese").submit(function () {
        //VARIVEL FORM RECEBE O PROPRIO FORMULÁRIO USANDO O METODO DO JQUERY "THIS":
        var Form = $(this);
        //VARIAVEL ACTION RECEBE O VALOR DO CALLBACK QUE É UM INPUT ESCONDIDO NO FORMULÁRIO ESSE CALLBACK SERVE COMO GATILHO PARA CONDIÇÕES:
        var Action = Form.find('input[name="callback"]').val();
        //VARIAVEL DATA RECEBE UMA MATRIZ COM OS DADOS DO FORMULÁRIO (FORM) INDICE E VALOR:
        var Data = Form.serialize();

        //INICIAÇÃO DO AJAX - PARA ENVIAR E RECEBER DADOS:
        $.ajax({
            //URL É O CAMINHO QUE ESTÁ A CONTROLLER, ONDE SERÃO ENVIADOS OS DADOS DO FORMULÁRIO (FORM -> DATA):
            url: "Controllers/controller.anamnese.php",
            //DATA SÃO OS DADOS QUE SERÃO ENVIADOS:
            data: Data,
            //TYPE É O TIPO USADO PARA O ENVIO DOS DADOS:
            type: 'POST',
            //DATATYPE É O TIPO DE DADOS TRAFÉGADOS:
            dataType: 'json',
            //BEFORE SEND É A FUNÇÃO QUE PERMITE EXECUTAR UM ALGORITMO DO JQUERY ANTES DOS DADOS SEREM ENVIADOS:
            beforeSend: function (xhr) {
            },
            //SUCCESS É A FUNÇÃO DO AJAX RESPONSÁVEL POR EXECUTAR ALGORITMOS DEPOIS QUE OS DADOS RETORNAM DA CONTROLLER, TAIS DADOS PODEM SER ACESSADOS PELA VARIAVEL "(data)":
            success: function (data) {
                if (data.sucesso) {
                    $('.alert-success').fadeIn();
                }
                if (data.clear) {
                    Form.trigger('reset');
                }
                $('.modal-create').fadeOut(0);
                $('.close-modal-create').fadeOut(0);
                $('.open-modal-create').fadeIn(0);
                $('.relatorio-geral').fadeIn(0);
                $('.pesquisar').fadeIn(0);
                $('.modal-table').fadeIn(0);
                if (data.novaanamnese) {
                    var novaAnamnese = data.novaanamnese;
                    $('.j-result-anamneses').prepend("<tr id='" + novaAnamnese.idanamneses + "' class='animated zoomInDown'>" +
                            "<td>" + novaAnamnese.idanamneses + "</td>" +
                            "<td>" + novaAnamnese.idalunos_cliente + "</td>" +
                            "<td>" + novaAnamnese.nome_aluno + "</td>" +
                            "<td align='right'>" +
                            "<button class='btn btn-success btn-xs open-modal-update j-update-anamnese' idanamneses='" + novaAnamnese.idanamneses + "'><i class='glyphicon glyphicon-edit'></i></button> " +
                            "<a href='http://localhost/academia/Views/view.anamnese.relatorio.php' target='_blank'><button class='btn btn-warning btn-xs open-imprimir'><i class='glyphicon glyphicon-print'></i></button></a> " +
                            "<button class='btn btn-danger btn-xs open-delete' idanamneses='" + novaAnamnese.idanamneses + "'><i class='glyphicon glyphicon-trash'></i></button>" +
                            "</td>" +
                            "</tr>"
                            );
                    setTimeout(function () {
                        $("tr[id='" + novaAnamnese.idanamneses + "']:first").removeClass("animated zoomInDown");
                    }, 1000);
                }
            }
        });

        //RETURN É A FUNÇÃO PARA NÃO PERMITIR QUE O FORMULÁRIO GERE AÇÃO:
        return false;
    });

});


