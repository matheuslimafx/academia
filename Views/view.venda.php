<!--MENU:-->
<?php require REQUIRE_PATH . '/menu.php'; ?>
<!--FIM MENU-->
<div class="container">
    <h2>Vendas</h2>
    <div>
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

        <div class="form-group col-md-12 mensagens-retorno">
            <div class='alert alert-success'>
                <a href="#" class="close" data-dismiss="alert" arua-label="close">x</a>
                Cadastro realizado com sucesso!
            </div>
        </div>

        <div class="col-md-12 modal-create">
            <div class="container"><h5 class="obrigatorios">* Campos Obrigatórios</h5></div>
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
                    <input type="text" name="valor_vendas" class="form-control moeda" placeholder="R$">
                </div>

                <div class="form-group col-md-12">
                    <button name="" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-shopping-cart"></i> Vender</button>
                </div>
            </form>
        </div>
        <div class="venda-lista">
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
                <tbody>
                    <?php
                    $ReadVenda = new Read;
                    $ReadVenda->FullRead("SELECT vendas.idvendas, vendas.data_venda, vendas.valor_vendas, vendas.qt_vendas, " .
                            "produtos.nome_prod, " .
                            "alunos_cliente.nome_aluno " .
                            "FROM vendas " .
                            "INNER JOIN produtos ON  vendas.idprodutos = produtos.idprodutos " .
                            "INNER JOIN alunos_cliente ON vendas.idalunos_cliente = alunos_cliente.idalunos_cliente");
                    foreach ($ReadVenda->getResult() as $e):
                        extract($e);
                        echo
                        "<tr id='{$idvendas}'>" .
                        "<td>{$idvendas}</td>" .
                        "<td>{$nome_prod}</td>" .
                        "<td>{$nome_aluno}</td>" .
                        "<td>{$data_venda}</td>" .
                        "<td>R$ {$valor_vendas}</td>" .
                        "<td>{$qt_vendas}</td>" .
                        "<td align='right'>" .
                        "<a href='http://localhost/academia/Views/view.venda.relatorio.php?idvendas={$idvendas}' target='_blank'><button class='btn btn-warning btn-xs open-imprimir'><i class='glyphicon glyphicon-print'></i></button></a>" .
                        "</td>" .
                        "</tr>";
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>