<!--MENU:-->
<?php require REQUIRE_PATH . '/menu.php'; ?>
<!--FIM MENU-->
<div class="container">

    <h2>Treinos</h2>
    <div>
        <div class="col-md-12" align="right">
            <form action="" method="POST">
                <div class="form-group col-md-4">
                    <input type="text" placeholder="Pesquisar" class="form-control pesquisar pesquisar-treino">
                </div>
            </form>
            <button type="button" class="btn btn-primary open-modal-create"><i class="glyphicon glyphicon-plus"></i> Novo Registro</button>
            <button type="button" class="btn btn-primary open-modal-agenda"><i class="glyphicon glyphicon-plus"></i> Agendar Treino</button>
            <button type="button" class="btn btn-danger close-modal-agenda"><i class="glyphicon glyphicon-remove"></i></button>
            <button type="button" class="btn btn-danger close-modal-create"><i class="glyphicon glyphicon-remove"></i></button>
            <button type="button" class="btn btn-danger close-modal-update"><i class="glyphicon glyphicon-remove"></i></button>
            <a class="relatorio-geral" href="http://localhost/academia/Views/view.treinos.relatorio.php" target="_blank"><button class="btn btn-warning"><i class="glyphicon glyphicon-print"></i> Relatório Geral</button></a>
        </div>

        <div class="alert alert-success">Cadastro Realizado com sucesso!</div>

        <!--FORMULÁRIO DE CADASTRO DE TREINOS-->
        <div class="col-md-12 modal-create">
            <form action="" method="POST" name="form_treino">
                <input type="hidden" name="callback" value="treino">
                <div class="container">
                    <h5 class="obrigatorios">* Campos obrigatórios</h5>
                </div>
                <div class="form-group col-md-6">
                    <label>* Nome</label>
                    <input type="text" name="nome_treino" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>* Sigla</label>
                    <input type="text" name="sigla_treino" class="form-control" maxlength="5" placeholder="ABCDE">
                </div>
                <div class="form-group col-md-3">
                    <label>* Exercicío</label>
                    <select name="idexercicio" class="form-control">
                        <option>SELECIONE</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>* Grupos Musculares</label>
                    <input type="text" name="grupos_muscular_treino" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>* Series</label>
                    <input type="text" name="series_treino" class="form-control" placeholder="00 X 00" required>
                </div>
                <div class="form-group col-md-3">
                    <label>* Equipamento</label>
                    <select name="idequipamentos" class="form-control">
                        <option>SELECIONE</option>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label>Observações</label>
                    <textarea name="obs_treino" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" name="" value="Cadastrar" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Cadastrar</button>
                </div>
            </form>
        </div>

        <!--FORMULÁRIO DE UPDATE DE TREINOS-->
        <div class="col-md-12 modal-update">
            <form action="" method="POST" name="form_treino">
                <input type="hidden" name="callback" value="treino">
                <div class="container">
                    <h5 class="obrigatorios">* Campos obrigatórios</h5>
                </div>
                <div class="form-group col-md-6">
                    <label>* Nome</label>
                    <input type="text" name="nome_treino" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>* Sigla</label>
                    <input type="text" name="sigla_treino" class="form-control" maxlength="5" placeholder="ABCDE">
                </div>
                <div class="form-group col-md-3">
                    <label>* Exercicío</label>
                    <select name="idexercicio" class="form-control">
                        <option>SELECIONE</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>* Grupos Musculares</label>
                    <input type="text" name="grupos_muscular_treino" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>* Series</label>
                    <input type="text" name="series_treino" class="form-control" placeholder="00 X 00" required>
                </div>
                <div class="form-group col-md-3">
                    <label>* Equipamento</label>
                    <select name="idequipamentos" class="form-control">
                        <option>SELECIONE</option>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label>Observações</label>
                    <textarea name="obs_treino" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" name="" value="Cadastrar" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Atualizar</button>
                </div>
            </form>
        </div>
        
        <div class="form-group col-md-12 modal-agenda">
            <form action="" method="POST" class="">
                <div class="container">
                    <h5 class="obrigatorios">* Campos obrigatórios</h5>
                </div>
                <div class="form-group col-md-6">
                    <label>* Aluno</label>
                    <select name="idalunos_cliente" class="form-control" required>
                        <option value="0">SELECIONE</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>* Professor</label>
                    <select name="idfuncionarios" class="form-control">
                        <option value="0">SELECIONE</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>* Treino</label>
                    <select name="idtreino" class="form-control" required>
                        <option value="0">SELECIONE</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>* Data</label>
                    <input type="date" name="data" class="form-control" required>
                </div>
                <div class="form-group col-md-2">
                    <label>* Horário</label>
                    <input type="time" name="horario" class="form-control" required>
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" name="" value="Agendar" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Agendar</button>
                </div>
            </form>
        </div>

        <table class="table table-striped modal-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Treino</th>
                    <th>Sigla</th>
                    <th>Exercicío</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="j-result-treinos">
                <?php
                $ReadTreinos = new Read;
                $ReadTreinos->FullRead("SELECT treinos.idtreino, treinos.nome_treino, treinos.sigla_treino, exercicios.descricao_exe FROM treinos INNER JOIN exercicios ON treinos.idexercicio = exercicios.idexercicios");
                foreach ($ReadTreinos->getResult() as $e):
                    extract($e);
                    echo
                    "<tr id='{$idtreino}'>" .
                    "<td>{$idtreino}</td>" .
                    "<td>{$nome_treino}</td>" .
                    "<td>{$sigla_treino}</td>" .
                    "<td>{$descricao_exe}</td>" .
                    "<td align='right'>" .
                    "<button class='btn btn-success btn-xs open-modal-update' idtreino='{$idtreino}'><i class='glyphicon glyphicon-edit'></i></button> " .
                    "<a href='http://localhost/academia/Views/view.treino.relatorio.php' target='_blank'><button class='btn btn-warning btn-xs open-imprimir'><i class='glyphicon glyphicon-print'></i></button></a> " .
                    "<button class='btn btn-danger btn-xs open-delete'><i class='glyphicon glyphicon-trash'></i></button>" .
                    "</td>" .
                    "</tr>";
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>

</div>
