//INICIAR JQUERY:
$(function () {
    //A FUNÇÃO ABAIXO EVITA QUE AO TECLAR ENTER O INPUT DE PESQUISA FAÇA UMA NOVA REQUISIÇÃO HTTP
    $('.pesquisar-fornecedor').on('keypress', function (e) {
        return e.which !== 13;
    });
    $(".pesquisar-fornecedor").keyup(function () {
        var termo = $(".pesquisar-fornecedor").val();
        if (termo === '') {
            termo = '0';
        }
        $.ajax({
            url: "Controllers/controller.fornecedor.php",
            data: termo,
            type: 'POST',
            dataType: 'json',
            beforeSend: function (xhr) {

            },
            success: function (data) {
                $('.j-result-fornecedores').html('');
                $(data).each(function (index, value) {
                    $('.j-result-fornecedores').append(
                            "<tr id='" + value.idfornecedores + "'>" +
                            "<td>" + value.idfornecedores + "</td>" +
                            "<td>" + value.nome_forn + "</td>" +
                            "<td>" + value.nome_fantasia_forn + "</td>" +
                            "<td>" + value.telefone_forn + "</td>" +
                            "<td>" +
                            "<td align='right'>" +
                            "<button class='btn btn-success btn-xs open-modal-update j-open-modal-update-fornecedor' idfornecedores='"+value.idfornecedores+"' idendereco_forn='"+value.idendereco_forn+"' ><i class='glyphicon glyphicon-edit'></i></button> " +
                            "</td>" +
                            "</tr>"
                            );
                });
            }
        });
    });

//    SELECIONAR O FORMULARIO AO SER SUBMETIDO USANDO UMA CLASSE PARA IDENTIFICAR O FORMULÁRIO:
    $(".j-form-create-fornecedor").submit(function () {
//        VARIAVEL FORM RECEBE O PROPRIO FORMULARIO USANDO O METODO DO JQUERY "THIS":
        var Form = $(this);
//        VARIAVEL ACTION RECEBE O VALOR DO CALLBACK QUE É UM INPUT ESCONDIDO NO FORMULARIO ESSE CALLBACK SERVE COMO GATILHO PARA CONDIÇÕES:
        var Action = Form.find('input[name="callback"]').val();
//        VARIAVEL DATA RECEBE UMA MATRIZ COM OS DADOS DO FORMULARIO (FORM) INDICE E VALOR:
        var Data = Form.serialize();

//        INICIAÇÃO DO AJAX - PARA ENVIAR E RECEBER DADOS:
        $.ajax({
//            URL É O CAMINHO QUE ESTÁ A CONTROLLER, ONDE SERÃO ENVIADOS OS DADOS DO FORMULARIO (FORM -> DATA):
            url: "Controllers/controller.fornecedor.php",
//            DATA SÃO OS DADOS QUE SERÃO ENVIADOS:
            data: Data,
//            TYPE É O MÉTODO USADO PARA O ENVIO DOS DADOS:
            type: 'POST',
//            DATATYPE É O TIPO DE DADOS TRAFÉGADOS:
            dataType: 'json',
//            BEFORE SEND É A FUNÇÃO QUE PERMITE EXECUTAR UM ALGORITMO DO JQUERY ANTES DOS DADOS SEREM ENVIADOS:
            beforeSend: function (xhr) {

            },
//            SUCCESS É A FUNÇÃO DO AJAX RESPONSÁVEL POR EXECUTAR ALGORITMOS DEPOIS QUE OS DADOS RETORNAM DA CONTROLLER, TAIS DADOS PODEM SER ACESSADOS PELA VARIAVEL "(data)":
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
                
                if(data.novoforn){
                    var novoForn = data.novoforn;
                    $('.j-result-fornecedores').prepend(
                            "<tr id='"+ novoForn.idfornecedores +"'>"+
                            "<td>"+ novoForn.idfornecedores +"</td>"+
                            "<td>"+ novoForn.nome_forn +"</td>"+
                            "<td>"+ novoForn.nome_fantasia_forn +"</td>"+
                            "<td>"+ novoForn.telefone_forn +"</td>"+
                            "<td align='right'>"+
                            "<button class='btn btn-success btn-xs open-modal-update j-open-modal-update-fornecedor' idfornecedores='"+novoForn.idfornecedores+"' idendereco_forn='"+novoForn.idendereco_forn+"' ><i class='glyphicon glyphicon-edit'></i></button> " +
                            "</td>"+
                            "</tr>"
                            );
                    setTimeout(function (){
                       $("tr[id='"+ novoForn.idfornecedores +"']:first").removeClass("animated zoomInDown"); 
                    }, 1000);
                }
            }
        });

//        RETURN É A FUNÇÃO PARA NÃO PERMITIR QUE O FORMULÁRIO GERE AÇÃO: 
        return false;
    });
    
    //FUNÇÃO PARA PREENCHER A DIV DE ATUALIZAÇÃO DE CADASTRO COM OS DADOS DE CADA FORNECEDOR:
    $('html').on('click', '.j-open-modal-update-fornecedor', function () {
        var button = $(this);
        var idfornecedores = $(button).attr('idfornecedores');
        var idendereco_forn = $(button).attr('idendereco_forn');
        var dados_edit = {callback: 'povoar-edit', idfornecedores: idfornecedores, idendereco_forn: idendereco_forn};
        $.ajax({
            url: "Controllers/controller.fornecedor.php",
            data: dados_edit,
            type: 'POST',
            dataType: 'json',
            beforeSend: function (xhr) {

            },
            success: function (data) {
                var Form = $('.j-form-update-fornecedor');
                $.each(data, function (key, value) {
                    Form.find("input[name='" + key + "'], select[name='" + key + "'], textarea[name='" + key + "']").val(value);
                });
            }
        });
    });
    
});