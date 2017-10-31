<!--MENU:-->
<?php require REQUIRE_PATH . '/menu.php'; ?>
<!--FIM-->
<div class="container">
    <h2>Produtos</h2>
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
            <button class="btn btn-primary" id="novo-produto"><i class="glyphicon glyphicon-plus"></i> Novo Produto</button>
            <button class="btn btn-danger" id="fechar-produto"><i class="glyphicon glyphicon-remove"></i> Fechar Formulário</button>
            <a href="http://localhost/AcademiaPerformanceFit/5/Views/view.produtos.relatorio.php" target="_blank"><button class="btn btn-warning"><i class="glyphicon glyphicon-print"></i> Relatório</button></a>
        </div>
    
    <div class="col-md-12 produto-div">
        <form action="" method="">
            <div class="form-group col-md-6">
                <label>Nome</label>
                <input type="text" name="nome_prod" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label>Categoria</label>
                <select class="form-control" name="idcate_prod">
                    <option></option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>Fornecedor</label>
                <select class="form-control" name="idfornecedores">
                    <option></option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>Marca</label>
                <input type="text" name="marca_prod" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label>Fabricante</label>
                <input type="text" name="fabricante_prod" class="form-control">
            </div>
            <div class="form-group col-md-2">
                <label>Peso</label>
                <input type="text" name="peso_prod" class="form-control" id="peso">
            </div>
            <div class="form-group col-md-2">
                <label>Cor</label>
                <input type="text" name="cor_prod" class="form-control">
            </div>
            <div class="form-group col-md-2">
                <label>Tamanho</label>
                <select class="form-control" name="tamanho_prod">
                    <option></option>
                    <option>PP</option>
                    <option>P</option>
                    <option>M</option>
                    <option>G</option>
                    <option>GG</option>
                    <option>EG</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label>Número</label>
                <input type="text" name="numero_prod" class="form-control" maxlength="3">
            </div>
            <div class="form-group col-md-2">
                <label>Data Entrada</label>
                <input type="date" name="dt_entr_prod" class="form-control">
            </div>
            <div class="form-group col-md-2">
                <label>Data Saida</label>
                <input type="date" name="dt_saida_prod" class="form-control">
            </div>
            <div class="form-group col-md-2">
                <label>Data de Validade</label>
                <input type="date" name="validade_prod" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label>Contra indicações</label>
                <input type="text" name="con_indicacao_prod" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label>Observações</label>
                <textarea name="obs_prod" class="form-control"></textarea>
            </div>
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    </div>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Categoria</th>
                    <th>Fornecedor</th>
                    <th>Nome</th>
                    <th>Estoque</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ReadProd = new Read;
                $ReadProd->ExeRead("produtos");
                foreach ($ReadProd->getResult() as $e):
                    extract($e);
                    echo "<tr>" .
                    "<td>{$idprodutos}</td>" .
                    "<td>{$idcate_produto}</td>" .
                    "<td>{$idfornecedores}</td>" .
                    "<td>{$nome_prod}</td>" .
                    "<td>DEFINIR</td>" .
                    "<td>" .
                    " <a href='#'><button id='editar' class='btn btn-success btn-xs'><i class='glyphicon glyphicon-edit'></i></button></a>" .
                    "</td>" .
                    "</tr>";
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>


