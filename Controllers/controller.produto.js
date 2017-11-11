//INICIAR JQUERY:
$(function () {
//A FUNÇÃO ABAIXO EVITA QUE AO TECLAR ENTER O INPUT DE PESQUISA FAÇA UMA NOVA REQUISIÇÃO HTTP
    $('.pesquisar-produto').on('keypress', function (e) {
        return e.which !== 13;
    });
    //FUNÇÃO RESPONSÁVEL POR FAZER CONSULTAS DE ACORDO COM PESQUISAS DO PRODUTO:
    $('.pesquisar-produto').keyup(function () {
        var termo = $('.pesquisar-produto').val();
        if (termo === '') {
            termo = '0';
        }
        $.ajax({
            url: "Controllers/controller.produto.php",
            data: termo,
            type: 'POST',
            dataType: 'json',
            beforeSend: function (xhr) {

            },
            success: function (data) {
                $('.j-result-produtos').html('');
                $(data).each(function (index, value) {
                    $('.j-result-produtos').append(
                            "<tr id='" + value.idprodutos + "'>" +
                            "<td>" + value.idprodutos + "</td>" +
                            "<td>" + value.descricao + "</td>" +
                            "<td>" + value.nome_forn + "</td>" +
                            "<td>" + value.nome_prod + "</td>" +
                            "<td>" + value.quant_estoque + "</td>" +
                            "<td align='right'>" +
                            "<button class='btn btn-success btn-xs open-modal-update' idprodutos='" + value.idprodutos + "'><i class='glyphicon glyphicon-edit'></i></button> " +
                            "</td>" +
                            "</tr>"
                            );
                });
            }
        });
    });
    //FUNÇÃO RESPONSÁVEL POR CADASTRAR UM NOVO PRODUTO NO BANCO DE DADOS:
    $(".j-form-create-produto").submit(function () {
//VARIVEL FORM RECEBE O PROPRIO FORMULÁRIO USANDO O METODO DO JQUERY "THIS":
        var Form = $(this);
        //VARIAVEL ACTION RECEBE O VALOR DO CALLBACK QUE É UM INPUT ESCONDIDO NO FORMULÁRIO ESSE CALLBACK SERVE COMO GATILHO PARA CONDIÇÕES:
        var Action = Form.find('input[name="callback"]').val();
        //VARIAVEL DATA RECEBE UMA MATRIZ COM OS DADOS DO FORMULÁRIO (FORM) INDICE E VALOR:
        var Data = Form.serialize();
        //INICIAÇÃO DO AJAX - PARA ENVIAR E RECEBER DADOS:
        $.ajax({
            //URL É O CAMINHO QUE ESTÁ A CONTROLLER, ONDE SERÃO ENVIADOS OS DADOS DO FORMULÁRIO (FORM -> DATA):
            url: "Controllers/controller.produto.php",
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
                    $('.modal-create').fadeOut(0);
                    $('.close-modal-create').fadeOut(0);
                    $('.open-modal-create').fadeIn(0);
                    $('.relatorio-geral').fadeIn(0);
                    $('.pesquisar').fadeIn(0);
                    $('.modal-table').fadeIn(0);
                }
                if (data.novoproduto) {
                    var novoproduto = data.novoproduto;
                    $('.j-result-produtos').prepend("<tr id='" + novoproduto.idprodutos + "' class='animated zoomInDown'>" +
                            "<td>" + novoproduto.idprodutos + "</td>" +
                            "<td>" + novoproduto.descricao + "</td>" +
                            "<td>" + novoproduto.nome_forn + "</td>" +
                            "<td>" + novoproduto.nome_prod + "</td>" +
                            "<td>" + novoproduto.quant_estoque + "</td>" +
                            "<td align='right'>" +
                            "<button class='btn btn-success btn-xs open-modal-update' idprodutos='" + novoproduto.idprodutos + "'><i class='glyphicon glyphicon-edit'></i></button> " +
                            "</td>" +
                            "</tr>"
                            );
                    setTimeout(function () {
                        $("tr[id='" + novoproduto.idprodutos + "']:first").removeClass("animated zoomInDown");
                    }, 1000);
                }
            }
        });
        return false;
    });

});