<!--MENU:-->
<?php require REQUIRE_PATH . '/menu.php'; ?>
<?php
$ReadEstado = new Read;
$ReadEstado->ExeRead("estado");
$ReadCidade = new Read;
$ReadCidade->ExeRead("cidade", "WHERE idestado = :iestado", "iestado=9");
?>
<!--FIM MENU-->
<div class="container">
    <h2>Alunos</h2>
    <div>
        <div class="col-md-12">
            <form action="" method="POST">
                <div class="form-group col-md-4">
                    <input id="pesquisa" type="text" name="pesquisa" placeholder="Pesquisar" class="form-control">
                </div>
            </form>

            <button class="btn btn-primary" id="novo-aluno"><i class="glyphicon glyphicon-user"></i> Novo Aluno</button>
            <button class="btn btn-danger" id="fechar-aluno"><i class="glyphicon glyphicon-remove"></i> Fechar Formulário</button>
            <button class="btn btn-danger" id="fechar-aluno-editar"><i class="glyphicon glyphicon-remove"></i> Fechar Formulário</button>
            <a href="http://localhost/academia/Views/view.alunos.relatorio.php" id="relatorio-aluno" target="_blank"><button class="btn btn-warning"><i class="glyphicon glyphicon-print"></i> Relátorio</button></a>
        </div>

        <div class="form-group col-md-12 mensagens-retorno">
            <div class='alert alert-success'>Cadastro realizado com sucesso!</div>
        </div>

        <!--Formulário de Cadastro de Aluno-->
        <div class="col-md-12 aluno-div">
            <div class="container">
                <h5 class="obrigatorios">* Campos obrigatórios</h5>
            </div>
            <form action="" method="POST" class="form_aluno">
                <input type="hidden" name="callback" value="aluno">
                <div class="form-group col-md-6">
                    <br>
                    <label>* Nome</label>
                    <input type="text" name="nome_aluno" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                    <br>
                    <label>* CPF</label>
                    <input type="text" name="cpf_aluno" class="form-control" id="cpf" required>
                </div>
                <div class="form-group col-md-3">
                    <br>
                    <label>* RG</label>
                    <input type="text" name="rg_aluno" class="form-control" maxlength="7" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Nome da Mãe</label>
                    <input type="text" name="nome_mae" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label>Nome do Pai</label>
                    <input type="text" name="nome_pai" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label>* E-mail</label>
                    <input type="email" name="email_aluno" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                    <label>Telefone Celular</label>
                    <input type="text" name="celular_aluno" class="form-control" id="telefoneC">
                </div>
                <div class="form-group col-md-3">
                    <label>Telefone Residencial</label>
                    <input type="text" name="residencial_aluno" class="form-control" id="telefoneR">
                </div>
                <div class="form-group col-md-2">
                    <label>* Dt. Nascimento</label>
                    <input type="date" name="data_nascimento_aluno" class="form-control" required>
                </div>
                <div class="form-group col-md-2">
                    <label>Status</label>
                    <select name="status_aluno" class="form-control">
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Estado</label>
                    <select name="idestado" class="form-control">
                        <?php
                        foreach ($ReadEstado->getResult() as $i):
                            extract($i);
                            echo "<option value='{$idestado}'>{$uf}</option>";
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <label>Cidade</label>
                    <select name="idcidade" class="form-control">
                        <?php
                        foreach ($ReadCidade->getResult() as $i):
                            extract($i);
                            echo "<option value='{$idcidade}'>{$desc_cidade}</option>";
                        endforeach;
                        ?>
                        <option></option>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label>Complemento</label>
                    <input type="text" name="complementos_aluno" class="form-control">
                </div>

                <div class="form-group col-md-12">
                    <label>Obs.</label>
                    <textarea type="text" name="obs_aluno" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Cadastrar</button>
                </div>
            </form>
        </div>
        
        <!--Formulário para Editar-->
        <div class="col-md-12 aluno-editar-div">
            <form action="" method="POST" class="form_aluno">
                <input type="hidden" name="callback" value="aluno">
                <div class="form-group col-md-6">
                    <br>
                    <label>* Nome</label>
                    <input type="text" name="nome_aluno" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                    <br>
                    <label>* CPF</label>
                    <input type="text" name="cpf_aluno" class="form-control" id="cpf" required>
                </div>
                <div class="form-group col-md-3">
                    <br>
                    <label>* RG</label>
                    <input type="text" name="rg_aluno" class="form-control" maxlength="7" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Nome da Mãe</label>
                    <input type="text" name="nome_mae" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label>Nome do Pai</label>
                    <input type="text" name="nome_pai" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label>* E-mail</label>
                    <input type="email" name="email_aluno" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                    <label>Telefone Celular</label>
                    <input type="text" name="celular_aluno" class="form-control" id="telefoneC">
                </div>
                <div class="form-group col-md-3">
                    <label>Telefone Residencial</label>
                    <input type="text" name="residencial_aluno" class="form-control" id="telefoneR">
                </div>
                <div class="form-group col-md-2">
                    <label>* Dt. Nascimento</label>
                    <input type="date" name="data_nascimento_aluno" class="form-control" required>
                </div>
                <div class="form-group col-md-2">
                    <label>Status</label>
                    <select name="status_aluno" class="form-control">
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Estado</label>
                    <select name="idestado" class="form-control">
                        <?php
                        foreach ($ReadEstado->getResult() as $i):
                            extract($i);
                            echo "<option value='{$idestado}'>{$uf}</option>";
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <label>Cidade</label>
                    <select name="idcidade" class="form-control">
                        <?php
                        foreach ($ReadCidade->getResult() as $i):
                            extract($i);
                            echo "<option value='{$idcidade}'>{$desc_cidade}</option>";
                        endforeach;
                        ?>
                        <option></option>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label>Complemento</label>
                    <input type="text" name="complementos_aluno" class="form-control">
                </div>

                <div class="form-group col-md-12">
                    <label>Obs.</label>
                    <textarea type="text" name="obs_aluno" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Salvar</button>
                </div>
            </form>
        </div>
        
        <!--Tabela com os registros de Alunos no banco de dados-->
        <table class="table table-striped table-aluno">
            <thead>
                <tr>
                    <th>Matricula</th>
                    <th>Nome</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="j-result-alunos">
                <?php
                $ReadAlunos = new Read;
                $ReadAlunos->ExeRead("alunos_cliente");
                foreach ($ReadAlunos->getResult() as $e):
                    extract($e);
                    echo "<tr>" .
                    "<td>{$idalunos_cliente}</td>" .
                    "<td>{$nome_aluno}</td>" .
                    " <td>{$status_aluno}</td>" .
                    "<td>".
                        "<button id='aluno-editar' class='btn btn-success btn-xs jedit-aluno'><i class='glyphicon glyphicon-edit'></i></button> ".
                        "<a href='http://localhost/academia/Views/view.aluno.relatorio.php' target='_blank'><button id='imprimir' class='btn btn-warning btn-xs'><i class='glyphicon glyphicon-print'></i></button></a> ".
                    "</td>" .
                    "</tr>";
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>

