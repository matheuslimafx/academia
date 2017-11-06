<!--MENU:-->
<?php require REQUIRE_PATH . '/menu.php'; ?>
<!--FIM MENU-->
<div class="container">

    <h2>Treinos</h2>
    <div>
        <div class="col-md-12" align="right">
            <form action="" method="POST">
                <div class="form-group col-md-4">
                    <input type="text" placeholder="Pesquisar" class="form-control pesquisar">
                </div>
            </form>
            <button type="button" class="btn btn-primary open-modal-create"><i class="glyphicon glyphicon-plus"></i> Novo Registro</button>
            <button type="button" class="btn btn-danger close-modal-create"><i class="glyphicon glyphicon-remove"></i></button>
            <button type="button" class="btn btn-danger close-modal-update"><i class="glyphicon glyphicon-remove"></i></button>
            <a class="relatorio-geral" href="http://localhost/academia/Views/view.treinos.relatorio.php" target="_blank"><button class="btn btn-warning"><i class="glyphicon glyphicon-print"></i> Relatório</button></a>
        </div>

        <div class="alert alert-success">Cadastro Realizado com sucesso!</div>

        <!--FORMULÁRIO DE CADASTRO DE TREINOS-->
        <div class="col-md-12 modal-create">
            <form action="" method="POST" name="form_treino">
                <input type="hidden" name="callback" value="treino">
                <div class="form-group col-md-6">
                    <br><br>
                    <label>Nome do Treino</label>
                    <input type="text" name="treino_nome" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <br><br>
                    <label>Aluno</label>
                    <select class="form-control" name="idalunos_cliente">
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
                    <br><br>
                    <label>Professor</label>
                    <select class="form-control" name="idfuncionarios">
                        <?php
                        $ReadFun = new Read;
                        $ReadFun->ExeRead("funcionarios", "WHERE cargo_func = :cargo_func", "cargo_func=Professor");
                        foreach ($ReadFun->getResult() as $e):
                            extract($e);
                            echo "<option value='{$idfuncionarios}'>{$idfuncionarios} - {$nome_func}</option>";
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Nome do Exercício</label>
                    <select name="exercicio" class="form-control">
                        <option>SELECIONE</option>
                        <option>TEste 1</option>
                        <option>Teste 2</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Grupo Muscular</label>
                    <input type="text" name="grp_musc_treino" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Número de Series</label>
                    <input type="text" name="num_series_treino" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Turno</label>
                    <select name="turno_treino" class="form-control">
                        <option>Matutino</option>
                        <option>Vespertino</option>
                        <option>Noturno</option>
                        <option>Qualquer</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Equipamento</label>
                    <select name="idequipamento" class="form-control">
                        <?php
                        $ReadEquipamento = new Read;
                        $ReadEquipamento->ExeRead("equipamentos");
                        foreach ($ReadEquipamento->getResult() as $e):
                            extract($e);
                            echo "<option value='{$idequipamentos}'>{$idequipamentos} - {$nome_equip}</option>";
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-9">
                    <label>Dias da Semana</label><br>
                    <div class="checkbox-inline">
                        <input type="checkbox" name="domingo_treino" value=1> Domingo
                    </div>
                    <div class="checkbox-inline">
                        <input type="checkbox" name="segunda_treino" value=2> Segunda-Feira
                    </div>
                    <div class="checkbox-inline">
                        <input type="checkbox" name="terca_treino" value=3> Terça-Feira
                    </div>
                    <div class="checkbox-inline">
                        <input type="checkbox" name="quarta_treino" value=4> Quarta-Feira
                    </div>
                    <br>
                    <div class="checkbox-inline">
                        <input type="checkbox" name="quinta_treino" value=5> Quinta-Feira
                    </div>
                    <div class="checkbox-inline">
                        <input type="checkbox" name="sexta_treino" value=6> Sexta-Feira
                    </div>
                    <div class="checkbox-inline">
                        <input type="checkbox" name="sabado_treino" value=7> Sabado
                    </div>
                </div>
                <br>
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
                <div class="form-group col-md-6">
                    <br><br>
                    <label>Nome do Treino</label>
                    <input type="text" name="treino_nome" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <br><br>
                    <label>Aluno</label>
                    <select class="form-control" name="idalunos_cliente">
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
                    <br><br>
                    <label>Professor</label>
                    <select class="form-control" name="idfuncionarios">
                        <?php
                        $ReadFun = new Read;
                        $ReadFun->ExeRead("funcionarios", "WHERE cargo_func = :cargo_func", "cargo_func=Professor");
                        foreach ($ReadFun->getResult() as $e):
                            extract($e);
                            echo "<option value='{$idfuncionarios}'>{$idfuncionarios} - {$nome_func}</option>";
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Nome do Exercício</label>
                    <select name="exercicio" class="form-control">
                        <option>SELECIONE</option>
                        <option>TEste 1</option>
                        <option>Teste 2</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Grupo Muscular</label>
                    <input type="text" name="grp_musc_treino" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Número de Series</label>
                    <input type="text" name="num_series_treino" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Turno</label>
                    <select name="turno_treino" class="form-control">
                        <option>Matutino</option>
                        <option>Vespertino</option>
                        <option>Noturno</option>
                        <option>Qualquer</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Equipamento</label>
                    <select name="idequipamento" class="form-control">
                        <?php
                        $ReadEquipamento = new Read;
                        $ReadEquipamento->ExeRead("equipamentos");
                        foreach ($ReadEquipamento->getResult() as $e):
                            extract($e);
                            echo "<option value='{$idequipamentos}'>{$idequipamentos} - {$nome_equip}</option>";
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-9">
                    <label>Dias da Semana</label><br>
                    <div class="checkbox-inline">
                        <input type="checkbox" name="domingo_treino" value=1> Domingo
                    </div>
                    <div class="checkbox-inline">
                        <input type="checkbox" name="segunda_treino" value=2> Segunda-Feira
                    </div>
                    <div class="checkbox-inline">
                        <input type="checkbox" name="terca_treino" value=3> Terça-Feira
                    </div>
                    <div class="checkbox-inline">
                        <input type="checkbox" name="quarta_treino" value=4> Quarta-Feira
                    </div>
                    <br>
                    <div class="checkbox-inline">
                        <input type="checkbox" name="quinta_treino" value=5> Quinta-Feira
                    </div>
                    <div class="checkbox-inline">
                        <input type="checkbox" name="sexta_treino" value=6> Sexta-Feira
                    </div>
                    <div class="checkbox-inline">
                        <input type="checkbox" name="sabado_treino" value=7> Sabado
                    </div>
                </div>
                <br>
                <div class="form-group col-md-12">
                    <label>Observações</label>
                    <textarea name="obs_treino" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" name="" value="Cadastrar" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Cadastrar</button>
                </div>
            </form>
        </div>

        <table class="table table-striped modal-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Turno</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ReadTreinos = new Read;
                $ReadTreinos->ExeRead("treinos");
                foreach ($ReadTreinos->getResult() as $e):
                    extract($e);
                    echo
                    "<tr id='{$idtreinos}'>" .
                    "<td>{$idtreinos}</td>" .
                    "<td>{$nome_treino}</td>" .
                    "<td>{$turno_treino}</td>" .
                    "<td align='right'>" .
                    "<button class='btn btn-success btn-xs open-modal-update'><i class='glyphicon glyphicon-edit'></i></button> " .
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
