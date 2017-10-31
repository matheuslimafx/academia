<!--INÍCIO DAS MENSAGENS:-->
<div class="resultado_login">
    Resultado
</div>
<!--FIM DAS MENSAGENS-->
<!--FORMULÁRIO DE LOGIN:-->
<div class="container">
    <h2>Academia Performance Fit</h2>
    <div class="well col-md-6">
        <form class="pf_form" action="" method="POST">
            <input type="hidden" name="callback" value="verificar_login">
            <div class="form-group">
                <label>E-mail</label><br>
                <input type="text" name="email_usuario" class="form-control" placeholder="E-mail">
            </div>
            <div class="form-group">
                <label>Senha</label><br>
                <input type="password" name="senha_usuario" class="form-control" placeholder="Senha">
            </div>
            <div class="form-group ">
                <button type="submit" class="btn btn-primary col-md-4" value="Entrar" name="Entrar">Entrar</button>
            </div>
            <div class="form-group">
                <div class="pf_load">
                    <img alt="" title="" src="Views/img/load.gif"/>
                </div>
            </div>
        </form>
    </div>  
</div>