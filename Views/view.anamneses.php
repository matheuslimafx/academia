<!--MENU:-->
<?php require REQUIRE_PATH . '/menu.php'; ?>
<!--FIM MENU-->

<div class="container">
    <h2>Anamneses</h2>
    <div id="fundo" class="well">

        <div class="col-md-12">
            <form action="" method="POST">
                <div class="form-group col-md-4">
                    <input type="text" name="pesquisa" placeholder="Pesquisar" class="form-control">
                </div>
                <div class="form-group col-md-1"> 
                    <button id="pesquisar" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </form>

            <button class="btn btn-primary" id="novo-anamnese"><i class="glyphicon glyphicon-plus"></i> Nova Anamnese</button>
            <button class="btn btn-danger" id="fechar-novo-anamnese"><i class="glyphicon glyphicon-remove"></i> Fechar Formulário</button>
            <a href="http://localhost/AcademiaPerformanceFit/5/Views/view.anamneses.relatorio.php" target="_blank"><button class="btn btn-warning"><i class="glyphicon glyphicon-print"></i> Relátorio</button></a>
        </div>

        <div class="form-group col-md-12 mensagens-retorno">
            <div class="alert alert-success">Cadastro realizado com sucesso!</div>
        </div>

        <div class="col-md-12 anamnese-div">
            <div class="container"><h5 class="obrigatorios">* Campos Obrigatórios</h5></div>
            <form action="" method="POST" class="form_anamnese">
                <input type="hidden" name="callback" value="anamnese">
                <div class="form-group col-md-6">
                    <br>
                    <label>* Aluno</label>
                    <select name="idalunos_cliente" class="form-control">
                        <option value="0">SELECIONE</option>
                        <?php
                        $ReadAlunos = new Read;
                        $ReadAlunos->ExeRead("alunos_cliente");
                        foreach ($ReadAlunos->getResult() as $e):
                            extract($e);
                            echo "<option value={$idalunos_cliente}>{$idalunos_cliente} - {$nome_aluno}</option>";
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <br>
                    <label>* Peso</label>
                    <input type="number" name="peso_anamnese" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <br>
                    <label>* Altura</label>
                    <input type="number" name="altura_anamnese" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <br>
                    <label>* IMC</label>
                    <input type="number" name="imc_anamnese" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Pescoço</label>
                    <input type="number" name="pescoco_anamnese" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Ombro</label>
                    <input type="number" name="ombro_anamnese" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Torax</label>
                    <input type="number" name="torax_anamnese" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Abdome</label>
                    <input type="number" name="abdome_anamnese" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Cintura</label>
                    <input type="number" name="cintura_anamnese" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Quadril</label>
                    <input type="number" name="quadril_anamnese" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Braço D.</label>
                    <input type="number" name="bd_anamnese" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Braço E.</label>
                    <input type="number" name="be_anamnese" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>B.E. Contraido</label>
                    <input type="number" name="bec_anamnese" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>B.D. Contraido</label>
                    <input type="number" name="bdc_anamnese" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Antebraço E.</label>
                    <input type="number" name="aec_anamnese" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Antebraço D.</label>
                    <input type="number" name="adc_anamnese" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Coxa Esquerda</label>
                    <input type="number" name="ce_anamnese" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Coxa Direita</label>
                    <input type="number" name="cd_anamnese" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Pamturilha E.</label>
                    <input type="number" name="pe_anamnese" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Panturilha D.</label>
                    <input type="number" name="pd_anamnese" class="form-control col-md-2">
                </div>
                <div class="form-group col-md-4">

                </div>
                <div class="form-group col-md-12">
                    <label>Observações</label>
                    <textarea name="obs_anamnese" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" name="cadastrar" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Cadastrar</button>
                </div>
            </form>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Matricula</th>
                    <th>Aluno</th>
                    <th>Ultima Atualização</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ReadAnamnese = new Read;
                $ReadAnamnese->ExeRead("anamneses");
                foreach ($ReadAnamnese->getResult() as $e):
                    extract($e);
                    echo "<tr>" .
                    "<td>{$idanamneses}</td>" .
                    "<td>{$idalunos_cliente}</td>" .
                    "<td></td>" .
                    "<td></td>" .
                    "<td>" .
                    " <a href='#'><button id='editar' class='btn btn-success btn-xs'><i class='glyphicon glyphicon-edit'></i></button></a>" .
                    " <a href='http://localhost/AcademiaPerformanceFit/5/Views/view.anamnese.relatorio.php' target='_blank'><button id='imprimir' class='btn btn-warning btn-xs'><i class='glyphicon glyphicon-print'></i></button></a>" .
                    " <a href='#'><button id='deletar' class='btn btn-danger btn-xs'><i class='glyphicon glyphicon-trash'></i></button></a>" .
                    "</td>" .
                    "</tr>";
                endforeach;
                ?>

            </tbody>
        </table>
    </div>
</div>
