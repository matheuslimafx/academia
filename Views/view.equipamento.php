<!--MENU:-->
<?php require REQUIRE_PATH . '/menu.php'; ?>
<!--FIM MENU-->
<?php
$ReadFornecedor = new Read;
$ReadFornecedor->ExeRead("fornecedores");

$ReadTreino = new Read;
$ReadTreino->ExeRead("treinos");
?>
<div class="container">

    <h2>Equipamentos</h2>
    <div>
        <div class="col-md-12" align="right">
            <form action="" method="POST">
                <div class="form-group col-md-4">
                    <input type="text" placeholder="Pesquisar" class="form-control pesquisar-equipamento">
                </div>
            </form>

            <button class="btn btn-primary open-modal-create"><i class="glyphicon glyphicon-plus"></i> Novo Registro</button>
            <button class="btn btn-danger close-modal-create"><i class="glyphicon glyphicon-remove"></i></button>
            <button class="btn btn-danger close-modal-update"><i class="glyphicon glyphicon-remove"></i></button>
            <a class="relatorio-geral" href="http://localhost/academia/Views/view.equipamento.relatorio.php" target="_blank"><button class="btn btn-warning"><i class="glyphicon glyphicon-print"></i> Relátorio</button></a>
        </div>

        <div class="form-group col-md-12 mensagens-retorno">
            <div class='alert alert-success'>Cadastro realizado com sucesso!</div>
        </div>

        <!--FORMULÁRIO DE CADASTRO DE TREINOS-->
        <div class="col-md-12 modal-create">
            <div class="container"><h5 class="obrigatorios">* Campos Obrigatórios</h5></div>
            <form class="form_equipamento" action="" method="POST">
                <input type="hidden" name="callback" value="equipamento">
                <div class="form-group col-md-3">
                    <label>* Fornecedor</label>
                    <select class="form-control" name="idfornecedores" required>
                        <option>SELECIONE</option>
                        <?php
                        foreach ($ReadFornecedor->getResult() as $e):
                            extract($e);
                            echo "<option value='{$idfornecedores}'>{$idfornecedores} - {$nome_forn}</option>";
                        endforeach;
                        ?>  
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>* Treino</label>
                    <select class="form-control" name="idtreino_equip" required>
                        <option>SELECIONE</option>
                        <?php
                        foreach ($ReadTreino->getResult() as $e):
                            extract($e);
                            echo "<option value='{$idtreinos}'>{$idtreinos} - {$nome_treino}</option>";
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>* Nome</label>
                    <input type="text" name="nome_equip" class="form-control" required>
                </div>
                <div class="form-group col-md-2">
                    <label>* Data de entrada</label>
                    <input type="date" name="data_equip_entr" class="form-control" required>
                </div>
                <div class="form-group col-md-2">
                    <label>Data de Saida</label>
                    <input type="date" name="data_equip_saida" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Preço de entrada</label>
                    <input type="text" name="preco_equip_entr" class="form-control" id="moeda">
                </div>
                <div class="form-group col-md-2">
                    <label>Data de Manutenção</label>
                    <input type="date" name="data_manutencao_equip" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label>* Marca</label>
                    <input type="text" name="marca_equip" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Funcionalidade</label>
                    <input type="text" name="funcionalidade_equip" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Cadastrar</button>
                </div>
            </form>
        </div>   
        
         <!--FORMULÁRIO DE UPDATE DE TREINOS-->
        <div class="col-md-12 modal-update">
            <div class="container"><h5 class="obrigatorios">* Campos Obrigatórios</h5></div>
            <form class="form_equipamento" action="" method="POST">
                <input type="hidden" name="callback" value="equipamento">
                <div class="form-group col-md-3">
                    <label>* Fornecedor</label>
                    <select class="form-control" name="idfornecedores" required>
                        <option>SELECIONE</option>
                        <?php
                        foreach ($ReadFornecedor->getResult() as $e):
                            extract($e);
                            echo "<option value='{$idfornecedores}'>{$idfornecedores} - {$nome_forn}</option>";
                        endforeach;
                        ?>  
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>* Treino</label>
                    <select class="form-control" name="idtreino_equip" required>
                        <option>SELECIONE</option>
                        <?php
                        foreach ($ReadTreino->getResult() as $e):
                            extract($e);
                            echo "<option value='{$idtreinos}'>{$idtreinos} - {$nome_treino}</option>";
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>* Nome</label>
                    <input type="text" name="nome_equip" class="form-control" required>
                </div>
                <div class="form-group col-md-2">
                    <label>* Data de entrada</label>
                    <input type="date" name="data_equip_entr" class="form-control" required>
                </div>
                <div class="form-group col-md-2">
                    <label>Data de Saida</label>
                    <input type="date" name="data_equip_saida" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Preço de entrada</label>
                    <input type="text" name="preco_equip_entr" class="form-control" id="moeda">
                </div>
                <div class="form-group col-md-2">
                    <label>Data de Manutenção</label>
                    <input type="date" name="data_manutencao_equip" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label>* Marca</label>
                    <input type="text" name="marca_equip" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Funcionalidade</label>
                    <input type="text" name="funcionalidade_equip" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Cadastrar</button>
                </div>
            </form>
        </div>   

        <table class="table table-striped modal-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Marca</th>
                    <th>Fornecedor</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="j-result-equipamentos">
                <?php
                $ReadEquipamento = new Read;
                $ReadEquipamento->FullRead("SELECT equipamentos.idequipamentos, equipamentos.nome_equip, equipamentos.marca_equip, fornecedores.nome_forn "
                                          ."FROM equipamentos "
                                          ."LEFT JOIN fornecedores ON equipamentos.idfornecedores = fornecedores.idfornecedores;");
                foreach ($ReadEquipamento->getResult() as $e):
                    extract($e);
                    echo "<tr>" .
                    "<td>{$idequipamentos}</td>" .
                    "<td>{$nome_equip}</td>" .
                    "<td>{$marca_equip}</td>" .
                    "<td>{$nome_forn}</td>" .
                    "<td>" .
                    "<button class='btn btn-success btn-xs open-modal-update'><i class='glyphicon glyphicon-edit'></i></button> " .
                    "</td>" .
                    "</tr>";
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>

</div>


