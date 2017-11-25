$(function(){
    
    //FUNÇÃO RESPONSÁVEL POR RECONHECER O ID DO ESTOQUE AO QUAL O PRODUTO SELECIONADO FAZ PARTE:
    $(".j-form-create-venda").on("change", "#idprodutos", function(){
        var idprodutos = $("#idprodutos").val();
        var callback = "buscar-estoque-produto";
        $.post("Controllers/controller.venda.php", {idprodutos: idprodutos, callback: callback}, function(data){
            var idestoques = data.idestoques;
            var quant_estoque = data.quant_estoque;
            var valor_prod = data.valor_prod;
            $(".j-form-create-venda").find("input[name='idestoques']").val(idestoques);
            $(".j-form-create-venda").find("input[name='quant_estoque']").val(quant_estoque);
            $(".j-form-create-venda").find("input[name='valor_prod']").val(valor_prod);
            $(".j-form-create-venda").find("input[name='qt_vendas']").val('');
            $(".j-form-create-venda").find("input[name='valor_vendas']").val('');
        }, 'json');
    });
    
    //FUNÇÃO RESPONSÁVEL POR VERIFICAR SE A QUANTIDADE DO PRODUTO A SER VENDIDO É IGUAL OU MENOR A QUANTIDADE EM ESTOQUE. 
    //ESSA FUNÇÃO TAMBÉM ATUALIZA O PREÇO FINAL DA VENDA DE ACORDO COM A QUANTIDADE CONFIGURADA NA VENDA.
    $(".j-form-create-venda").on("keyup", "input[name='qt_vendas']", function(){
        var form = $(".j-form-create-venda");
        var qt_vendas = form.find("input[name='qt_vendas']").val();
        var quant_estoque = form.find("input[name='quant_estoque']").val();
        var total = quant_estoque - qt_vendas;
        var valor_vendas = parseInt(qt_vendas) * parseFloat(form.find("input[name='valor_prod']").val());
   
        if(total <= -1){
            alert("Você não possui essa quantidade de produtos em Estoque, Atualmente o estoque possui: " + quant_estoque + " unidade(s) desse produto.");
            $(".j-form-create-venda").find("input[name='qt_vendas']").val('');
            form.find("input[name='valor_vendas']").val('');
        }else if(qt_vendas < 1){
            alert("A Quantidade digitada é inválida");
            $(".j-form-create-venda").find("input[name='qt_vendas']").val('');
            form.find("input[name='valor_vendas']").val('');
        }else{
            form.find("input[name='valor_vendas']").val(valor_vendas);
        }  
        
    });
    
    //FUNÇÃO RESPONSÁVEL POR CADASTRAR UMA NOVA VENDA NO BANCO DE DADOS:
    $(".j-form-create-venda").submit(function () {
        //VARIVEL FORM RECEBE O PROPRIO FORMULÁRIO USANDO O METODO DO JQUERY "THIS":
        var Form = $(this);
        //VARIAVEL ACTION RECEBE O VALOR DO CALLBACK QUE É UM INPUT ESCONDIDO NO FORMULÁRIO ESSE CALLBACK SERVE COMO GATILHO PARA CONDIÇÕES:
        var Action = Form.find('input[name="callback"]').val();
        //VARIAVEL DATA RECEBE UMA MATRIZ COM OS DADOS DO FORMULÁRIO (FORM) INDICE E VALOR:
        var Data = Form.serialize();
        console.log(Data);

        //INICIAÇÃO DO AJAX - PARA ENVIAR E RECEBER DADOS:
        $.ajax({
            //URL É O CAMINHO QUE ESTÁ A CONTROLLER, ONDE SERÃO ENVIADOS OS DADOS DO FORMULÁRIO (FORM -> DATA):
            url: "Controllers/controller.venda.php",
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
                if (data.trigger) {
                    alert(data.trigger);
                }
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
                if (data.novavenda) {
                    var novavenda = data.novavenda;
                    $('.j-result-vendas').prepend(
                            "<tr id='" + novavenda.idvendas + "' class='animated zoomInDown'>" +
                            "<td>" + novavenda.idvendas + "</td>" +
                            "<td>" + novavenda.nome_prod + "</td>" +
                            "<td>" + novavenda.nome_aluno + "</td>" +
                            "<td>" + novavenda.data_venda + "</td>" +
                            "<td>R$ " + novavenda.valor_vendas + "</td>" +
                            "<td>" + novavenda.qt_vendas + "</td>" +
                            "<td align='right'>" +
                            "<a href='http://localhost/academia/Views/view.venda.relatorio.php?idvendas=" + novavenda.idvendas + "' target='_blank'><button class='btn btn-warning btn-xs open-imprimir'><i class='glyphicon glyphicon-print'></i></button></a>" +
                            "</td>" +
                            "</tr>"
                            );
                    setTimeout(function () {
                        $("tr[id='" + novavenda.idvendas + "']:first").removeClass("animated zoomInDown");
                    }, 1000);
                }
            }
        });

        //RETURN É A FUNÇÃO PARA NÃO PERMITIR QUE O FORMULÁRIO GERE AÇÃO:
        return false;
    });
    
});