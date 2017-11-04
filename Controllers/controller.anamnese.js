//INICIAR JQUERY:
$(function(){
    
    //FUNÇÃO RESPONSAVEL POR FAZER CONSULTAS DE ACORDO COM A PESQUISA DO USUÁRIO
    $(".pesquisar").keyup(function (){
       var termo = $(".pesquisar").val();
       if (termo === ''){
           termo = '0';
       }
       $.ajax({
           url: "Controllers/controller.anamnese.php",
           data: termo,
           type: 'POST',
           dataType: 'json',
           beforeSend: function (xhr){
               
           },
           success: function (data){
               $('.j-result-anamneses').html('');
               $(data).each(function (index, value){
                  $('.j-result-anamneses').append(
                          "<tr id='"+value.idanamneses+"'>"+
                          "<td>"+ value.idalunos_cliente + "</td>"+
                          "<td>"+ value.nome_aluno + "</td>"+
                          "<td align='right'>"+
                          "<button class='btn btn-success btn-xs open-modal-update'><i class='glyphicon glyphicon-edit'></i></button> "+
                          "<a href='http://localhost/academia/Views/view.anamnese.relatorio.php' target='_blank'><button class='btn btn-warning btn-xs open-imprimir'><i class='glyphicon glyphicon-print'></i></button></a> "+
                          "<button class='btn btn-danger btn-xs open-delete'><i class='glyphicon glyphicon-trash'></i></button>"+
                          "</td>"+
                          "</tr>"
                          ); 
               });
           }
       });
    });
    
    
   //SELECIONAR O FORMULÁRIO AO SER SUBMETIDO USANDO UMA CLASSE PARA IDENTIFICAR O FORMULÁRIO:
   $(".form_anamnese").submit(function(){
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
          beforeSend: function(xhr){
              //PODE-SE NESSA PARTE MOSTRAR E RETIRAR POR EXEMPLO ELEMENTOS DO HTML:
              alert("enviou");
          },
          
          //SUCCESS É A FUNÇÃO DO AJAX RESPONSÁVEL POR EXECUTAR ALGORITMOS DEPOIS QUE OS DADOS RETORNAM DA CONTROLLER, TAIS DADOS PODEM SER ACESSADOS PELA VARIAVEL "(data)":
          success: function(data){
              //NESSA PARTE É INTERRESANTE EXECUTAR AÇÕES DE ACORDO COM OS RESULTADOS VINDOS DA CONTROLLER UTILIZANSO CONDIÇÕES
              alert("voltou");
              
              if(data.sucesso){
                  $('.alert-success').fadeIn();
              }
              if(data.clear){
                  Form.trigger('reset');
              }
          }
       });
       
       //RETURN É A FUNÇÃO PARA NÃO PERMITIR QUE O FORMULÁRIO GERE AÇÃO:
       return false;
   });
   
});


