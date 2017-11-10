//INICIAR JQUERY:
$(function () {

    //A FUNÇÃO ABAIXO EVITA QUE AO TECLAR ENTER O INPUT DE PESQUISA FAÇA UMA NOVA REQUISIÇÃO HTTP
    $('.pesquisar-mensalidade').on('keypress', function (e) {
        return e.which !== 13;
    });
    //FUNÇÃO RESPONSÁVEL POR FAZER CONSULTAS DE ACORDO COM PESQUISAS DO USUÁRIO:
    $(".pesquisar-mensalidade").keyup(function (){
       var termo = $(".pesquisar-mensalidade").val();
       if(termo === ''){
           termo = '0';
       }
       $.ajax({
          url: "Controllers/controller.mensalidade.php",
          data: termo,
          type: 'POST',
          dataType: 'json',
          beforeSend: function (xhr){
              
          },
          success: function (data){
              $('.j-result-mens-pagas').html('');
              $(data).each(function (index, value){
                 $('.j-result-mens-pagas').append(
                         "<tr id='"+ value.idmensalidades + "'>"+
                         "<td>"+ value.idalunos_cliente +"</td>"+
                         "<td>"+ value.nome_aluno +"</td>"+
                         "<td>"+ value.valor_mensalidades +"</td>"+
                         "<td>"+ value.data_mensalidades +"</td>"+
                         "<td>"+ value.status_mensalidades +"</td>"+
                         "<td align='right'>"+
                         "<button class='btn btn-success btn-xs open-modal-update' idmensalidades='"+ value.idmensalidades +"'><i class='glyphicon glyphicon-edit'></i></button></a> " +
                         "<button class='btn btn-primary btn-xs'><i class='glyphicon glyphicon-shopping-cart'></i> Gerar Pagamento</button></a>" +
                         "</td>"+
                         "</tr>"
                         ); 
              });
          }
       });
    });
    
    
    
    
//    SELECIONAR O FORMULARIO AO SER SUBMETIDO USANDO UMA CLASSE PARA IDENTIFICAR O FORMULÁRIO:
    $(".form_mensalidade").submit(function () {
//        VARIAVEL FORM RECEBE O PROPRIO FORMULARIO USANDO O METODO DO JQUERY "THIS":
        var Form = $(this);
//        VARIAVEL ACTION RECEBE O VALOR DO CALLBACK QUE É UM INPUT ESCONDIDO NO FORMULARIO ESSE CALLBACK SERVE COMO GATILHO PARA CONDIÇÕES:
        var Action = Form.find('input[name="callback"]').val();
//        VARIAVEL DATA RECEBE UMA MATRIZ COM OS DADOS DO FORMULARIO (FORM) INDICE E VALOR:
        var Data = Form.serialize();

//        INICIAÇÃO DO AJAX - PARA ENVIAR E RECEBER DADOS:
        $.ajax({
//            URL É O CAMINHO QUE ESTÁ A CONTROLLER, ONDE SERÃO ENVIADOS OS DADOS DO FORMULARIO (FORM -> DATA):
            url: "Controllers/controller.mensalidade.php",
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

//                NESSA PARTE É INTERESSANTE EXECUTAR AÇÕES DE ACORDO COM OS RESULTADOS VINDOS DA CONTROLER UTILIZANDO CONDIÇÕES:
                //alert('voltou');

                if (data.sucesso) {
                    $('.alert-success').fadeIn();
                }
                if (data.clear) {
                    Form.trigger('reset');
                }
            }
        });

//        RETURN É A FUNÇÃO PARA NÃO PERMITIR QUE O FORMULÁRIO GERE AÇÃO: 
        return false;
    });

//    SELECIONAR CIDADE DE ACORDO COM O ESTADO:


});