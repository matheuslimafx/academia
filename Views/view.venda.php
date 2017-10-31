<!--MENU:-->
<?php require REQUIRE_PATH . '/menu.php'; ?>
<!--FIM MENU-->
<div class="container">
    <h2>Vendas</h2>
    <div>
        <div class="col-md-12">
            <form action="" method="">
                <div class="form-group col-md-4">
                    <input type="text" name="pesquisa" class="form-control venda-pesquisa" placeholder="Pesquisar">
                </div>
            </form>
            <button type="button" class="btn btn-primary" id="nova-venda"><i class="glyphicon glyphicon-plus"></i> Nova Venda</button>
            <button type="button" class="btn btn-danger" id="fechar-venda"><i class="glyphicon glyphicon-remove"></i> Fechar Formulário</button>
            <a class="venda-relatorio" href="http://localhost/AcademiaPerformanceFit/5/Views/view.vendas.relatorio.php" target="_blank"><button type="" class="btn btn-warning"><i class="glyphicon glyphicon-print"></i> Relátorio</button></a>
        </div>

        <div class="alert alert-success mensagens-retorno">Venda realizada com sucesso!</div>

        <div class="col-md-12 venda-div">
            <form action="" method="POST">
                <input type="hidden" name="callback" value="vendas">
                <div class="form-group col-md-3">
                    <label>* Produto</label>
                    <select name="idprodutos" class="form-control">
                        <option>SELECIONE</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label>* Cliente</label>
                    <select name="idalunos_cliente" class="form-control">
                        <option>SELECIONE</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label>Data de Venda</label>
                    <input type="date" name="data_venda" class="form-control">
                </div>

                <div class="form-group col-md-3">
                    <label>* Quantidade</label>
                    <input type="number" name="qt_vendas" class="form-control" required>
                </div>

                <div class="form-group col-md-3">
                    <label>Valor Total</label>
                    <input type="text" name="valor_vendas" class="form-control" placeholder="R$" disabled>
                </div>

                <div class="form-group col-md-12">
                    <button name="" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-shopping-cart"></i> Vender</button>
                </div>
            </form>
        </div>
        <div class="venda-lista">
            <table class="table table-striped">
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
                <tbody>
                    <?php
                    $ReadVenda = new Read;
                    $ReadVenda->ExeRead("vendas");
                    foreach ($ReadVenda->getResult() as $e):
                        extract($e);
                        echo "<tr>" .
                        "<td>{$idvendas}</td>" .
                        "<td>{$idprodutos}</td>" .
                        "<td>{$idalunos_cliente}</td>" .
                        "<td>{$data_venda}</td>" .
                        "<td>R$ {$valor_vendas}</td>" .
                        "<td>{$qt_vendas}</td>" .
                        "<td>" .
                        "<a href='http://localhost/AcademiaPerformanceFit/5/Views/view.venda.relatorio.php' target='_blank'><button id='imprimir' class='btn btn-warning btn-xs'><i class='glyphicon glyphicon-print'></i></button></a>" .
                        "</td>" .
                        "</tr>";
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>