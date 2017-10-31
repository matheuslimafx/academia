<!--MENU:-->
<?php require REQUIRE_PATH . '/menu.php'; ?>
<!--FIM MENU-->
<div class="container">
    <h2>Fornecedores</h2>
    <div id="fundo" class="well">
        <div class="col-md-12">
            <form action="" method="POST">
                <div class="form-group col-md-3">
                    <input type="text" name="pesquisar" class="form-control" placeholder="Pesquisar">
                </div>
                <div class="form-group col-md-1"> 
                    <button id="pesquisar" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </form>
            <button class="btn btn-primary" id="novo-fornecedor"><i class="glyphicon glyphicon-user"></i> Novo</button>
            <button class="btn btn-danger" id="fechar-fornecedor"><i class="glyphicon glyphicon-remove"></i> Fechar</button>
            <a href="http://localhost/AcademiaPerformanceFit/5/Views/view.fornecedor.relatorio.php" target="_blank"><button class="btn btn-warning"><i class="glyphicon glyphicon-print"></i> Relatório</button></a>
        </div>

        <div class="form-group col-md-12 mensagens-retorno">
            <div class='alert alert-success'>Cadastro realizado com sucesso!</div>
        </div>

        <div class="col-md-12 fornecedor-div">
            <div class="container">
                <h5 class="obrigatorios">* Campos obrigatórios</h5>
            </div>
            <form>
                <div class="form-group col-md-3">
                    <label>* Nome</label>
                    <input type="text" name="nome_forn" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                    <label>* CNPJ / CPF</label>
                    <input type="text" name="cnpj_cpf_forn" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                    <label>* Nome Fantasia</label>
                    <input type="text" name="nome_fantasia" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                    <label>* E-mail</label>
                    <input type="email" name="email_forn" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                    <label>* Telefone</label>
                    <input type="text" name="telefone_forn" class="form-control" id="telefoneC" required>
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Cadastrar</button>
                </div>
            </form>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Nome Fantasia</th>
                    <th>Telefone</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ReadForn = new Read;
                $ReadForn->ExeRead("fornecedores");
                foreach ($ReadForn->getResult() as $e):
                    extract($e);
                    echo "<tr>" .
                    "<td>{$idfornecedores}</td>" .
                    "<td>{$nome_forn}</td>" .
                    "<td>{$nome_fantasia_forn}</td>" .
                    "<td>{$telefone_forn}</td>" .
                    "<td>" .
                    " <a href='#'><button id='editar' class='btn btn-success btn-xs'><i class='glyphicon glyphicon-edit'></i></button></a>" .
                    " <a href='#'><button id='deletar' class='btn btn-danger btn-xs'><i class='glyphicon glyphicon-trash'></i></button></a>" .
                    "</td>" .
                    "</tr>";
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>

