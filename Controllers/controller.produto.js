//INICIAR JQUERY:
$(function (){
    //A FUNÇÃO ABAIXO EVITA QUE AO TECLAR ENTER O INPUT DE PESQUISA FAÇA UMA NOVA REQUISIÇÃO HTTP
    $('.pesquisar-produto').on('keypress', function (e) {
        return e.which !== 13;
    });
    //FUNÇÃO RESPONSÁVEL POR FAZER CONSULTAS DE ACORDO COM PESQUISAS DO PRODUTO:
    $('.pesquisar-produto').keyup(function (){
       var termo = $('.pesquisar-produto').val();
       if(termo === ''){
           termo = '0';
       }
       $.ajax({
          url: "Controllers/controller.produto.php",
          data: termo,
          type: 'POST',
          dataType: 'json',
          beforeSend: function (xhr){
              
          },
          success: function (data){
              $('.j-result-produtos').html('');
              $(data).each(function (index, value){
                 $('.j-result-produtos').append(
                         "<tr id='"+ value.idprodutos + "'>"+
                         "<td>"+ value.idprodutos +"</td>"+
                         "<td>"+ value.descricao + "</td>"+
                         "<td>"+ value.nome_forn + "</td>"+
                         "<td>"+ value.nome_prod + "</td>"+
                         "<td>"+ value.quant_estoque +"</td>"+
                         "<td align='right'>"+
                         "<button class='btn btn-success btn-xs open-modal-update' idprodutos='"+ value.idprodutos +"'><i class='glyphicon glyphicon-edit'></i></button> "+
                         "</td>"+
                          "</tr>"
                          ); 
              });
          }
       });
    });
});

