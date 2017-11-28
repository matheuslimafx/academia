<!--MENU:-->
<?php
session_start();
var_dump($_SESSION);
if (!$_SESSION['logado']):
    session_destroy();
    header('Location: view.login');
endif;
require REQUIRE_PATH . '/menu.php';
?>
<!--FIM MENU-->
<div class="container">

    <div class="row">
        <h2>Vendas</h2>
        <div class="col-md-12" align="right">
            <form action="" method="POST">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control pesquisar pesquisar-venda" placeholder="Pesquisar por ID e Cliente">
                </div>
            </form>
            <button type="button" class="btn btn-primary open-modal-create"><i class="glyphicon glyphicon-plus"></i> Nova Venda</button>
            <button type="button" class="btn btn-danger close-modal-create"><i class="glyphicon glyphicon-remove"></i></button>
            <a class="relatorio-geral" href="http://localhost/academia/Views/view.vendas.relatorio.php" target="_blank"><button type="" class="btn btn-warning"><i class="glyphicon glyphicon-print"></i> Relátorio Geral</button></a>
        </div>
    </div>

    <div class="col-md-12 modal-create">
        <h5 class="obrigatorios">* Campos Obrigatórios</h5>
        <form class="j-form-carrinho-venda" action="" method="POST">
            <input type="hidden" name="callback" value="adicionar-carrinho">
            <div class="form-group col-md-3">
                <label>* Produto</label>
                <select id="idprodutos" name="idprodutos" class="form-control" required>
                    <option selected disabled>SELECIONE</option>
                    <?php
                    $LerProdutos = new Read;
                    $LerProdutos->FullRead("SELECT produtos.idprodutos, produtos.nome_prod FROM produtos");
                    foreach ($LerProdutos->getResult() as $e):
                        extract($e);
                        echo "<option value='{$idprodutos}'>{$idprodutos} - {$nome_prod}</option>";
                    endforeach;
                    ?>
                </select>
            </div>
            <input type="hidden" id="idestoques" name="idestoques" value=""/>
            <input type="hidden" id="quant_estoque" name="quant_estoque" value="" disabled/>

            <div class="form-group col-md-3">
                <label>* Quantidade</label>
                <input type="number" min="1" name="qt_vendas" class="form-control" onkeypress="if (!isNaN(String.fromCharCode(window.event.keyCode)))
                            return true;
                        else
                            return false;" readonly required>
            </div>

            <div class="form-group col-md-3">
                <label>Valor do Produto</label>
                <input type="number" name="valor_prod" class="form-control moeda" placeholder="R$" required readonly="readonly">
            </div>

            <div class="form-group col-md-3">
                <label>Valor Total</label>
                <input type="number" name="valor_vendas" class="form-control moeda" placeholder="R$" required readonly="readonly">
            </div>

            <div class="form-group col-md-12">
                <button name="" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-shopping-cart"></i> Add no Carrinho</button>
            </div>
        </form>

        <form class="j-form-create-venda col-md-12" type="POST" action="" style="margin-top: 50px;">
            <input type="hidden" name="callback" value="cadastrar-venda" class="form-control"/>
            <input type="hidden" name="data_venda" value="<?php echo date("Y-m-d h:i:s"); ?>" class="form-control"/>
            <input type="hidden" name="idusuario" value="<?php echo $_SESSION['idusuario']; ?>" class="form-control" />
            <div class="col-md-6">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Produto</th>
                            <th>Qtd</th>
                            <th>Total R$</th>
                        </tr>
                    </thead>
                    <tbody class="j-carrinho-lista">
                    </tbody>
                </table>
                <h2>Total: <span id="total_carrinho"></span></h2>
            </div>
            <div class="form-group col-md-3">
                <label>* Cliente</label>
                <select name="idalunos_cliente" class="form-control" required>
                    <option selected disabled>SELECIONE</option>
                    <?php
                    $LerClientes = new Read;
                    $LerClientes->FullRead("SELECT alunos_cliente.idalunos_cliente, alunos_cliente.nome_aluno FROM alunos_cliente");
                    if ($LerClientes->getResult()):
                        foreach ($LerClientes->getResult() as $i):
                            extract($i);
                            echo "<option value='{$idalunos_cliente}'>{$idalunos_cliente} - {$nome_aluno}</option>";
                        endforeach;
                    endif;
                    ?>
                </select>
            </div>
            <div class="form-group col-md-12">
                <a id="cancelar-venda" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Cancelar Venda</a>&nbsp;&nbsp;&nbsp;
                <button name="" type="submit" class="btn btn-success"><i class="glyphicon glyphicon-circle-arrow-right"></i> Finalizar Venda</button>
            </div>
        </form>

    </div>
</div>   

<div class="container">
    <div class="row venda-lista">
        <table class="table table-striped modal-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produto</th>
                    <th>Cliente</th>
                    <th>Data da Venda</th>
                    <th>Valor da Venda</th>
                    <th>Quantidade de produtos</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="j-result-vendas">
                <?php
//                $ReadVenda = new Read;
//                $ReadVenda->FullRead("SELECT vendas.idvendas, vendas.data_venda, vendas.valor_vendas, vendas.qt_vendas, " .
//                        "produtos.nome_prod, " .
//                        "alunos_cliente.nome_aluno " .
//                        "FROM vendas " .
//                        "INNER JOIN produtos ON  vendas.idprodutos = produtos.idprodutos " .
//                        "INNER JOIN alunos_cliente ON vendas.idalunos_cliente = alunos_cliente.idalunos_cliente");
//                foreach ($ReadVenda->getResult() as $e):
//                    extract($e);
//                    echo
//                    "<tr id='{$idvendas}'>" .
//                    "<td>{$idvendas}</td>" .
//                    "<td>{$nome_prod}</td>" .
//                    "<td>{$nome_aluno}</td>" .
//                    "<td>{$data_venda}</td>" .
//                    "<td>R$ {$valor_vendas}</td>" .
//                    "<td>{$qt_vendas}</td>" .
//                    "<td align='right'>" .
//                    "<a href='http://localhost/academia/Views/view.venda.relatorio.php?idvendas={$idvendas}' target='_blank'><button class='btn btn-warning btn-xs open-imprimir'><i class='glyphicon glyphicon-print'></i></button></a>" .
//                    "</td>" .
//                    "</tr>";
//                endforeach;
//                
                ?>
            </tbody>
        </table>
    </div>
</div>