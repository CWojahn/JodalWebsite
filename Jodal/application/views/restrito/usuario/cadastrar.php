
<form class="form-horizontal" method="POST" id="form_user" action="<?php echo site_url('user_painel/submit') ?>">
    <div class="form-group">
        <label class="col-md-offset-3 col-md-2 control-label" for="username">Nome do usuário</label>
        <div class="col-md-4" >
            <input type="text" class="form-control" id="username" name="username" placeholder="Insira o nome do Usuário">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-offset-3 col-md-2 control-label" for="senha">Senha</label>
        <div class="col-md-3" >
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Insira a senha">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-offset-3 col-md-2 control-label" for="senha1">Confirme a senha</label>
        <div class="col-md-3" >
            <input type="password" class="form-control" id="senha1" name="senha1" placeholder="Repita a senha">
        </div>
    </div>
    <div class="col-md-2 col-md-offset-5">
        <button type="submit" class="btn btn-success center"><span class="glyphicon glyphicon-save"></span> Salvar</button>
    </div>
</form>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script type="text/javascript">
    $('#form_user').validate({
        rules: {
            username: {
                required: true,
                minlength: 3
            },
            senha: {
                required: true
            },
            senha1: {
                required: true,
                equalTo: "#senha"
            }
            
        },
        messages: {
            username: {
                required: "O campo nome é obrigatório.",
                minlength: "O campo nome deve conter no mínimo 3 caracteres."
            },
            senha: {
                required: "O campo senha é obrigatório."
            },
            senha1: {
                required: "O campo confirmação de senha é obrigatório.",
                equalTo: "O campo confirmação de senha deve ser identico ao campo senha."
            }
            
        }

    });
</script>
