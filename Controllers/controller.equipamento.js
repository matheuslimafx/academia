//INICIAR JQUERY:
$(function () {
//A FUNÇÃO ABAIXO EVITA QUE AO TECLAR ENTER O INPUT DE PESQUISA FAÇA UMA NOVA REQUISIÇÃO HTTP
    $('.pesquisar-equipamento').on('keypress', function (e) {
        return e.which !== 13;
    });
//FUNÇÃO RESPONSAVEL POR FAZER CONSULTAS DE ACORDO COM A PESQUISA DO USUÁRIO    
    $(".pesquisar-equipamento").keyup(function (){
       var termo = $(".pesquisar-equipamento").val();
       if(termo === ''){
           termo = '0';
       }
       $.ajax({
          url: "Controllers/controller.equipamento.php",
          data: termo,
          type: 'POST',
          dataType: 'json',
          beforeSend: function (xhr){
              
          },
          success: function (data){
              $('.j-result-equipamentos').html('');
              $(data).each(function (index, value){
                 $('.j-result-equipamentos').append(
                    "<tr id='" + value.idequipamentos + "' class='animated zoomInDown'>" +
                    "<td>"+ value.idequipamentos +"</td>"+
                    "<td>" + value.nome_equip + "</td>" +
                    "<td>" + value.marca_equip + "</td>" +
                    "<td>" + value.nome_forn + "</td>"+
                    "<td align='right'>"+
                    "<button class='btn btn-success btn-xs open-modal-update'><i class='glyphicon glyphicon-edit'></i></button>"+
                    "</td>"+
                    "</tr>"
                    ); 
              });
          }
       });
    });
    
//    SELECIONAR O FORMULARIO AO SER SUBMETIDO USANDO UMA CLASSE PARA IDENTIFICAR O FORMULÁRIO:
    $(".j-form-create-equipamento").submit(function () {
//        VARIAVEL FORM RECEBE O PROPRIO FORMULARIO USANDO O METODO DO JQUERY "THIS":
        var Form = $(this);
//        VARIAVEL ACTION RECEBE O VALOR DO CALLBACK QUE É UM INPUT ESCONDIDO NO FORMULARIO ESSE CALLBACK SERVE COMO GATILHO PARA CONDIÇÕES:
        var Action = Form.find('input[name="callback"]').val();
//        VARIAVEL DATA RECEBE UMA MATRIZ COM OS DADOS DO FORMULARIO (FORM) INDICE E VALOR:
        var Data = Form.serialize();

//        INICIAÇÃO DO AJAX - PARA ENVIAR E RECEBER DADOS:
        $.ajax({
//            URL É O CAMINHO QUE ESTÁ A CONTROLLER, ONDE SERÃO ENVIADOS OS DADOS DO FORMULARIO (FORM -> DATA):
            url: "Controllers/controller.equipamento.php",
//            DATA SÃO OS DADOS QUE SERÃO ENVIADOS:
            data: Data,
//            TYPE É O MÉTODO USADO PARA O ENVIO DOS DADOS:
            type: 'POST',
//            DATATYPE É O TIPO DE DADOS TRAFÉGADOS:
            dataType: 'json',

//            BEFORE SEND É A FUNÇÃO QUE PERMITE EXECUTAR UM ALGORITMO DO JQUERY ANTES DOS DADOS SEREM ENVIADOS:
            beforeSend: function (xhr) {
//                PODE-SE NESSA PARTE MOSTRAR E RETIRAR POR EXEMPLO ELEMENTOS DO HTML:
                //alert('enviou');
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
                
                if(data.novoequip){
                    var novoEquip = data.novoequip;
                    $('.j-result-equipamentos').prepend(
                            "<tr id='"+ novoEquip.idequipamentos +"' class='animated zoomInDown'>"+
                            "<td>"+ novoEquip.idequipamentos +"</td>"+
                            "<td>"+ novoEquip.nome_equip +"</td>"+
                            "<td>"+ novoEquip.marca_equip +"</td>"+
                            "<td>"+ novoEquip.nome_forn +"</td>"+
                            "<td align='right'>"+
                            "<button class='btn btn-success btn-xs open-modal-update' idequipamentos='"+ novoEquip.idequipamentos +"'><i class='glyphicon glyphicon-edit'></i></button> "+
                            "</td>"+
                            "</tr>"
                            );
                    setTimeout(function (){
                       $("tr[id='"+ novoEquip.idequipamentos +"']:first").removeClass("animated zoomInDown"); 
                    }, 1000);
                }
            }
        });

//        RETURN É A FUNÇÃO PARA NÃO PERMITIR QUE O FORMULÁRIO GERE AÇÃO: 
        return false;
    });
    
//    SELECIONAR CIDADE DE ACORDO COM O ESTADO:

    
});