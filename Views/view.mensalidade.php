<!--MENU:-->
<?php require REQUIRE_PATH . '/menu.php'; ?>
<!--FIM MENU-->
<div class="container">
    <h2>Mensalidades</h2>
        <div class="col-md-12" align='right'>
            <form action="" method="POST">
                <div class="form-group col-md-4">
                    <input type="text" placeholder="Pesquisar" class="form-control pesquisar pesquisar-mensalidade">
                </div>
            </form>
            <button type="button" class="btn btn-primary open-modal-create"><i class="glyphicon glyphicon-plus"></i> Novo Registro</button>
            <button type="button" class="btn btn-danger close-modal-create"><i class="glyphicon glyphicon-remove"></i></button>
            <button type="button" class="btn btn-danger close-modal-update"><i class="glyphicon glyphicon-remove"></i></button>
            <a class="relatorio-geral" href="http://localhost/academia/Views/view.mensalidades.relatorio.php" target="_blank"><button class="btn btn-warning"><i class="glyphicon glyphicon-print"></i> Relátorio</button></a>
        </div>

        <div class="form-group col-md-12 mensagens-retorno">
            <div class='alert alert-success'>
                <a href="#" class="close" data-dismiss="alert" arua-label="close">x</a>
                Cadastro realizado com sucesso!
            </div>
        </div>

        <!--FORMULÁRIO DE CADASTRO DE MENSALIDADE-->
        <div class="col-md-12 modal-create">
            <div class="container"><h5 class="obrigatorios">* Campos obrigatórios</h5></div>
            <form class="form-mensalidade form-create j-form-create-mensalidade" action="" method="POST">
                <input type="hidden" name="callback" value="create-mensalidade">
                <div class="form-group col-md-6">
                    <br>
                    <label>* Aluno</label>
                    <select name="idalunos_cliente" class="form-control" required>
                        <option>SELECIONE</option>
                        <?php
                        $ReadAlunos = new Read;
                        $ReadAlunos->ExeRead("alunos_cliente");
                        foreach ($ReadAlunos->getResult() as $e):
                            extract($e);
                            echo "<option value='{$idalunos_cliente}'>{$idalunos_cliente} - {$nome_aluno}</option>";
                        endforeach;
                        ?>

                    </select>
                </div>
                <div class="form-group col-md-3">
                    <br>
                    <label>* Data de Pagamento</label>
                    <input type="date" name="data_mens_pag" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                    <br>
                    <label>* Valor</label>
                    <input type="text" name="valor_mensalidades" class="form-control" placeholder="R$" id="moeda" required>
                </div>
                <div class="form-group col-md-3">
                    <label>* Status</label>
                    <select name="status_mensalidades" class="form-control" required>
                        <option value=0>SELECIONE</option>
                        <option value="Em dia">Em dia</option>
                        <option value="Pendente">Pendente</option>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label>Observações</label>
                    <textarea name="obs_mensalidades" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-12">
                    <button name="Cadastrar" class="btn btn-primary form-enviar"><i class="glyphicon glyphicon-floppy-disk"></i> Cadastrar</button>
                </div>
            </form>
        </div>

        <!--FORMULÁRIO DE UPDATE DE MENSALIDADE-->
        <div class="col-md-12 modal-update">
            <form class="form-mensalidade" action="" method="POST">
                <input type="hidden" name="callback" value="update-mensalidade">
                <div class="container">
                    <h5 class="obrigatorios">* Campos obrigatórios</h5>
                </div>
                <div class="form-group col-md-6">
                    <br>
                    <label>* Aluno</label>
                    <select name="idalunos_cliente" class="form-control" required>
                        <option>SELECIONE</option>
                        <?php
                        $ReadAlunos = new Read;
                        $ReadAlunos->ExeRead("alunos_cliente");
                        foreach ($ReadAlunos->getResult() as $e):
                            extract($e);
                            echo "<option value='{$idalunos_cliente}'>{$idalunos_cliente} - {$nome_aluno}</option>";
                        endforeach;
                        ?>

                    </select>
                </div>
                <div class="form-group col-md-3">
                    <br>
                    <label>* Data de Pagamento</label>
                    <input type="date" name="data_mens_pag" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                    <br>
                    <label>* Valor</label>
                    <input type="text" name="valor_mensalidades" class="form-control" placeholder="R$" id="moeda" required>
                </div>
                <div class="form-group col-md-3">
                    <label>* Status</label>
                    <select name="status_mensalidades" class="form-control" required>
                        <option value=0>SELECIONE</option>
                        <option value="Em dia">Em dia</option>
                        <option value="Pendente">Pendente</option>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label>Observações</label>
                    <textarea name="obs_mensalidades" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-12">
                    <button name="Cadastrar" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Cadastrar</button>
                </div>
            </form>
        </div>
        <table class="table table-striped modal-table">
            <thead>
                <tr>
                    <th>Matricula</th>
                    <th>Aluno</th>
                    <th>Valor da Mensalidade</th>
                    <th>Vencimento</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="j-result-menssalidades">
                <?php
                $ReadMensalidadePaga = new Read;
                $ReadMensalidadePaga->FullRead("SELECT mensalidades.idmensalidades, mensalidades.valor_mensalidades, mensalidades.data_mens_pag, mensalidades.status_mensalidades, alunos_cliente.idalunos_cliente, alunos_cliente.nome_aluno " .
                        "FROM mensalidades " .
                        "LEFT JOIN alunos_cliente ON mensalidades.idmensalidades = alunos_cliente.idalunos_cliente");
                foreach ($ReadMensalidadePaga->getResult() as $e):
                    extract($e);
                    echo
                    "<tr id='{$idmensalidades}'>" .
                    "<td>{$idalunos_cliente}</td>" .
                    "<td>{$nome_aluno}</td>" .
                    "<td>R$ {$valor_mensalidades}</td>" .
                    "<td>{$data_mens_pag}</td>" .
                    "<td>{$status_mensalidades}</td>" .
                    "<td align='right'>" .
                    "<button class='btn btn-success btn-xs open-modal-update'><i class='glyphicon glyphicon-edit'></i></button></a> " .
                    "<button class='btn btn-primary btn-xs'><i class='glyphicon glyphicon-shopping-cart'></i> Gerar Pagamento</button></a>" .
                    "</td>" .
                    "</tr>";
                endforeach;
                ?>
            </tbody>
        </table>
</div>
