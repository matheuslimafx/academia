<!--MENU:-->
<?php require REQUIRE_PATH . '/menu.php'; ?>
<!--FIM MENU-->
<div class="container">
    <h2>Usuários</h2>
    <div>
        <div class="col-md-12" align="right">
            <form action="" method="POST">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control pesquisar" placeholder="Pesquisar">
                </div>
            </form>
            <button type="button" class="btn btn-primary open-modal-create"><i class="glyphicon glyphicon-user"></i> Novo Registro</button>
            <button type="button" class="btn btn-danger close-modal-create"><i class="glyphicon glyphicon-remove"></i></button>
            <button type="button" class="btn btn-danger close-modal-update"><i class="glyphicon glyphicon-remove"></i></button>
            <a class="relatorio-geral" href="http://localhost/academia/Views/view.usuarios.relatorio.php" target="_blank"><button type="" class="btn btn-warning"><i class="glyphicon glyphicon-print"></i> Relátorio</button></a>
        </div>

        <div class="alert alert-success mensagens-retorno">Cadastro Realizado com sucesso!</div>
        
        <!--MODAL DE CREATE DO USUÁRIO-->
        <div class="col-md-12 modal-create">
            <form action="" method="POST" class="form-usuario">
                <input type="hidden" name="callback" value="usuarios">
                <div class="form-group col-md-6">
                    <br>
                    <label>Funcionário</label>
                    <select name="idfuncionarios" class="form-control">
                        <option>SELECIONE</option>
                        <?php
                        $ReadFun = new Read;
                        $ReadFun->ExeRead("funcionarios");
                        foreach ($ReadFun->getResult() as $e):
                            extract($e);
                            echo "<option value='{$idfuncionarios}'>{$idfuncionarios} - {$nome_func}</option>";
                        endforeach;
                        ?> 
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <br>
                    <label>E-mail</label>
                    <input type="email" name="email_usuario" class="form-control" placeholder="email@exemplo.com.br">
                </div>
                <div class="form-group col-md-3">
                    <label>Senha</label>
                    <input type="password" name="senha_usuario" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Confirme a Senha</label>
                    <input type="password" name="senha_usuario" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Perfil</label>
                    <select name="perfil_usuario" class="form-control">
                        <option value=0>SELECIONE</option>
                        <option value="admin">Administrador</option>
                        <option value="professor">Professor</option>
                    </select>
                </div>
                
                <div class="form-group col-md-12">
                    <button name="" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Cadastrar</button>
                </div>               
            </form>
        </div>
        
        <!--MODAL DE UPDATE DO USUÁRIO-->
        <div class="col-md-12 modal-update">
            <form action="" method="POST" class="form-usuario">
                <input type="hidden" name="callback" value="usuarios">
                <div class="form-group col-md-6">
                    <br>
                    <label>Funcionário</label>
                    <select name="idfuncionarios" class="form-control">
                        <option>SELECIONE</option>
                        <?php
                        $ReadFun = new Read;
                        $ReadFun->ExeRead("funcionarios");
                        foreach ($ReadFun->getResult() as $e):
                            extract($e);
                            echo "<option value='{$idfuncionarios}'>{$idfuncionarios} - {$nome_func}</option>";
                        endforeach;
                        ?> 
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <br>
                    <label>E-mail</label>
                    <input type="email" name="email_usuario" class="form-control" placeholder="email@exemplo.com.br">
                </div>
                <div class="form-group col-md-3">
                    <label>Senha</label>
                    <input type="password" name="senha_usuario" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Confirme a Senha</label>
                    <input type="password" name="senha_usuario" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Perfil</label>
                    <select name="perfil_usuario" class="form-control">
                        <option value=0>SELECIONE</option>
                        <option value="admin">Administrador</option>
                        <option value="professor">Professor</option>
                    </select>
                </div>
                
                <div class="form-group col-md-12">
                    <button name="" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Cadastrar</button>
                </div>               
            </form>
        </div>
        
        <table class="table table-striped modal-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>E-mail</th>
                    <th>Perfil</th>
                    <th>Funcionário</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ReadUsuario = new Read;
                $ReadUsuario->ExeRead("usuario");
                foreach ($ReadUsuario->getResult() as $e):
                    extract($e);
                    echo
                    "<tr id='{$idusuario}'>" .
                    "<td>{$idusuario}</td>" .
                    "<td>{$email_usuario}</td>" .
                    "<td>{$perfil_usuario}</td>" .
                    "<td>{$idfuncionarios}</td>" .
                    "<td align='right'>".
                    "<button class='btn btn-success btn-xs open-modal-update'><i class='glyphicon glyphicon-edit'></i></button> " .
                    "<button class='btn btn-danger btn-xs open-delete'><i class='glyphicon glyphicon-trash'></i></button>" .
                    "</td>".
                    "</tr>";
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>