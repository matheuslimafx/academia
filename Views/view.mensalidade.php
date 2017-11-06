<!--MENU:-->
<?php require REQUIRE_PATH . '/menu.php'; ?>
<!--FIM MENU-->


<div class="container">
    <h2>Mensalidades</h2>
    <div>
        <div class="col-md-12" align='right'>
            <form action="" method="">
                <div class="form-group col-md-4">
                    <input type="text" placeholder="Pesquisar" class="form-control pesquisar pesquisar-mensalidade">
                </div>
                <div class="form-group col-md-3">
                    <select name="seleciona_mensalidade" class="form-control modal-select" onchange="$('.divs').hide();$('#' + this.value).show();">
                        <option value="pagas">Mensalidades Pagas</option>
                        <option value="nao_pagas">Mensalidades Pendentes</option>
                        <option value="todas">Todas Mensalidades</option>
                    </select>
                </div>
            </form>
            <button type="button" class="btn btn-primary open-modal-create"><i class="glyphicon glyphicon-plus"></i> Novo Registro</button>
            <button type="button" class="btn btn-danger close-modal-create"><i class="glyphicon glyphicon-remove"></i></button>
            <button type="button" class="btn btn-danger close-modal-update"><i class="glyphicon glyphicon-remove"></i></button>
            <a class="relatorio-geral" href="http://localhost/academia/Views/view.mensalidades.relatorio.php" target="_blank"><button class="btn btn-warning"><i class="glyphicon glyphicon-print"></i> Relátorio</button></a>
        </div>

        <div class="alert alert-success mensagens-alerta">Cadastro Realizado com sucesso!</div>

        <!--FORMULÁRIO DE CADASTRO DE MENSALIDADE-->
        <div class="col-md-12 modal-create">
            <form class="form-mensalidade" action="" method="POST">
                <input type="hidden" name="callback" value="create-mensalidade">
                <div class="form-group col-md-6">
                    <br>
                    <label>Aluno</label>
                    <select name="idalunos_cliente" class="form-control">
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
                    <label>Data de Pagamento</label>
                    <input type="date" name="data_mens_pag" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <br>
                    <label>Valor</label>
                    <input type="text" name="valor_mensalidades" class="form-control" placeholder="R$" id="moeda">
                </div>
                <div class="form-group col-md-3">
                    <label>Status</label>
                    <select name="status_mensalidades" class="form-control">
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

        <!--FORMULÁRIO DE UPDATE DE MENSALIDADE-->
        <div class="col-md-12 modal-update">
            <form class="form-mensalidade" action="" method="POST">
                <input type="hidden" name="callback" value="update-mensalidade">
                <div class="form-group col-md-6">
                    <br>
                    <label>Aluno</label>
                    <select name="idalunos_cliente" class="form-control">
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
                    <label>Data de Pagamento</label>
                    <input type="date" name="data_mens_pag" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <br>
                    <label>Valor</label>
                    <input type="text" name="valor_mensalidades" class="form-control" placeholder="R$" id="moeda">
                </div>
                <div class="form-group col-md-3">
                    <label>Status</label>
                    <select name="status_mensalidades" class="form-control">
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


        <!--Mensalidades Pagas-->
        <div class="divs" id="pagas">
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
                <tbody>
                    <?php
                    $ReadMensalidadePaga = new Read;
                    $ReadMensalidadePaga->ExeRead("mensalidades", "WHERE status_mensalidades = :status_mensalidades", "status_mensalidades=Em dia");
                    foreach ($ReadMensalidadePaga->getResult() as $e):
                        extract($e);
                        echo 
                        "<tr id='{$idmensalidades}'>" .
                        "<td>{$idmensalidades}</td>" .
                        "<td>{$idalunos_cliente}</td>" .
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
        <!--Mensalidades não Pagas-->
        <div class="divs" id="nao_pagas">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Matricula</th>
                        <th>Aluno</th>
                        <th>Valor da Mensalidade</th>
                        <th>Vencimento</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ReadMensalidadePend = new Read;
                    $ReadMensalidadePend->ExeRead("mensalidades", "WHERE status_mensalidades = :status_mensalidades", "status_mensalidades=Pendente");
                    foreach ($ReadMensalidadePend->getResult() as $e):
                        extract($e);
                        echo
                        "<tr id='{$idmensalidades}'>" .
                        "<td>{$idmensalidades}</td>" .
                        "<td>{$idalunos_cliente}</td>" .
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
        <!--Todas Mensalidades-->
        <div class="divs" id="todas">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Matricula</th>
                        <th>Aluno</th>
                        <th>Valor da Mensalidade</th>
                        <th>Vencimento</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ReadMensalidadeTodas = new Read;
                    $ReadMensalidadeTodas->ExeRead("mensalidades");
                    foreach ($ReadMensalidadeTodas->getResult() as $e):
                        extract($e);
                        echo
                        "<tr id='{$idmensalidades}'>" .
                        "<td>{$idmensalidades}</td>" .
                        "<td>{$idalunos_cliente}</td>" .
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
    </div>
</div>
