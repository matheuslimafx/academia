<!--MENU:-->
<?php require REQUIRE_PATH . '/menu.php'; ?>
<!--FIM MENU-->


<div class="container">
    <h2>Mensalidades</h2>
    <div id="fundo" class="well">
        <div class="col-md-12">
            <form action="" method="">
                <div class="form-group col-md-3">
                    <select name="seleciona_mensalidade" class="form-control" onchange="$('.divs').hide();$('#' + this.value).show();">
                        <option value="pagas">Mensalidades Pagas</option>
                        <option value="nao_pagas">Mensalidades Pendentes</option>
                        <option value="todas">Todas Mensalidades</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <input type="text" name="pesquisa" placeholder="Pesquisar" class="form-control">
                </div>
                <div class="form-group col-md-1"> 
                    <button id="pesquisar" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </form>
            <button type="button" class="btn btn-primary" id="nova-mensalidade"><i class="glyphicon glyphicon-plus"></i> Nova Mensalidade</button>
            <button type="button" class="btn btn-danger"id="fechar-mensalidade"><i class="glyphicon glyphicon-remove"></i> Fechar Formulário</button>
            <a href="http://localhost/AcademiaPerformanceFit/5/Views/view.mensalidades.relatorio.php" target="_blank"><button class="btn btn-warning"><i class="glyphicon glyphicon-print"></i> Relátorio</button></a>
        </div>

        <div class="alert alert-success mensagens-alerta">Cadastro Realizado com sucesso!</div>

        <!--FORMULÁRIO DE CADASTRO DE MENSALIDADE-->
        <div class="col-md-12 mensalidade-div">
            <form class="form-mensalidade" action="" method="POST">
                <input type="hidden" name="callback" value="mensalidade">
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
            <table class="table table-striped">
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
                        echo "<tr>" .
                        "<td>{$idmensalidades}</td>" .
                        "<td>{$idalunos_cliente}</td>" .
                        "<td>R$ {$valor_mensalidades}</td>" .
                        "<td>{$data_mens_pag}</td>" .
                        "<td>{$status_mensalidades}</td>" .
                        "<td>" .
                        "<a href='#'><button id='editar' class='btn btn-success btn-xs'><i class='glyphicon glyphicon-edit'></i></button></a> " .
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
                        echo "<tr>" .
                        "<td>{$idmensalidades}</td>" .
                        "<td>{$idalunos_cliente}</td>" .
                        "<td>R$ {$valor_mensalidades}</td>" .
                        "<td>{$data_mens_pag}</td>" .
                        "<td>{$status_mensalidades}</td>" .
                        "<td>" .
                        "<button type='button' class='btn btn-success btn-xs' data-toggle='modal' data-target='#modal_mensalidade_update'>Editar</button>" .
                        " <a href='#' onclick='return confirm('Tem certeza que deseja gera o pagamento?')'><button class='btn btn-danger btn-xs'>Gerar Pagamento</button></a>" .
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
                        echo "<tr>" .
                        "<td>{$idmensalidades}</td>" .
                        "<td>{$idalunos_cliente}</td>" .
                        "<td>R$ {$valor_mensalidades}</td>" .
                        "<td>{$data_mens_pag}</td>" .
                        "<td>{$status_mensalidades}</td>" .
                        "<td>" .
                        "<button type='button' class='btn btn-success btn-xs' data-toggle='modal' data-target='#modal_mensalidade_update'>Editar</button>" .
                        " <a href='#' onclick='return confirm('Tem certeza que deseja gera o pagamento?')'><button class='btn btn-danger btn-xs'>Gerar Pagamento</button></a>" .
                        "</td>" .
                        "</tr>";
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>

        <!--Modal do formulário da Mensalidade-->
        <div class="modal fade" id="modal_mensalidade_form" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2 class="modal-title">Cadastro de Mensalidade</h2>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" class="form_usuario">
                            <input type="hidden" name="callback" value="mensalidade">
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
                                <button name="Cadastrar" class="btn btn-primary">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group col-md-12">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
