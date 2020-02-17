<div class="container-fluid" style="border-top: 10px solid #003232; margin-top: 30px;">
    
</div>
<div class="container" style="background-color: #FFF; min-height: 400px; ">
    <div class="row">
        <div class="col-md-6 text-center">
            <h3>Entre em contato conosco!</h3>
            <p>Fone: <?php echo $empresa->telefone; ?></p>
            <p><?php echo $empresa->endereco; ?>.</p>
            <p>Cep: 98280-000, Panambi-RS.</p>
            <br>
            <p>E-mail:</p>
            <p><?php echo mailto($empresa->email, $empresa->email); ?></p>
            <!--<br>
            <p>Vendas:</p>
            <p><?php // echo mailto('josenei@zampronio.com.br', 'josenei@zampronio.com.br');   ?></p>
            <p>(55) 9923-2952</p>
            <br>
            <p>Assistência Técnica</p>
            <p><?php // echo mailto('assistente.comercial@zampronio.com.br', 'assistente.comercial@zampronio.com.br');   ?></p>
            <p>(55) 9674-3672</p>
            
            <p>E-mail:</p>
            <p><?php // echo mailto('vendas@zampronio.com.br', 'vendas@zampronio.com.br');   ?></p>
            <p><?php // echo mailto('engenharia@zampronio.com.br', 'engenharia@zampronio.com.br');   ?></p>
            <p><?php // echo mailto('financeiro@zampronio.com.br', 'financeiro@zampronio.com.br');   ?></p>-->
        </div>
        <div class="col-md-6 text-center">

            <h3>Preencha o formulário de contato</h3>
            <div id="result">

            </div>           

            <form class="form-horizontal" id="form_contato" method="post">
                <div class="form-group">
                    <label for="empresa" class="col-sm-5 col-md-4 control-label">Nome da Empresa</label>
                    <div class="col-sm-5 col-md-7">
                        <input type="text" class="form-control input-jodal" id="empresa" name="empresa" placeholder="Digite aqui">
                    </div>
                </div>
                <div class="form-group">
                    <label for="responsavel" class="col-sm-5 col-md-4 control-label">Responsável</label>
                    <div class="col-sm-5 col-md-7">
                        <input type="text" class="form-control input-jodal" id="responsavel" name="responsavel" placeholder="Digite aqui">
                    </div>
                </div>
                <div class="form-group">
                    <label for="telefone" class="col-sm-5 col-md-4 control-label">Telefone</label>
                    <div class="col-sm-5 col-md-6">
                        <input type="text" class="form-control input-jodal" id="telefone" name="telefone" placeholder="Digite aqui">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-5 col-md-4 control-label">Email</label>
                    <div class="col-sm-5 col-md-7">
                        <input type="email" class="form-control input-jodal" id="email" name="email" placeholder="Digite aqui">
                    </div>
                </div>
                <div class="form-group">
                    <label for="mensagem" class="col-sm-5 col-md-4 control-label">Mensagem</label>
                    <div class="col-sm-5 col-md-7">
                        <textarea class="form-control textarea-jodal" id="mensagem" name="mensagem" placeholder="Digite aqui" rows="5"> </textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10 text-center">
                        <button type="submit" class="btn btn-jodal">ENVIAR</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script>

            $("#form_contato").validate({
            rules: {
                empresa: {
            required: true
            },
                responsavel: {
            required: true
            },
                telefone: {
            required: true
            },
                email: {
            required: true
        },
            mensagem: {
                required: true
            }
        },
            messages: {
            empresa: {
                required: 'Digite o nome da empresa'
            },
            responsavel: {
                required: 'Digite o nome do responsável'
            },
            telefone: {
                required: 'Digite o telefone de contato'
            },
            email: {
                required: 'Digite o email de contato'
            },
        mensagem: {
            required: 'Digite a informação ou sua dúvida'
            }
            },
        submitHandler: function (form) {
                    //form.preventDefault();
                        var postData = $(form).serialize();

            $.ajax(
                        {
                        url: "<?php echo site_url('contato/enviar') ?>",
                        type: "POST",
                                                data: postData,
                                                    dataType: "json",
                        success: function (dados)
                                                        {
                                                        if (dados.sucesso == true) {
                                console.log('true');
                                                        $("#result").html('<div class="alert alert-success" role="alert">' + dados.msg + '</div>');
                                                        } else {
                                console.log('false');
                                                $("#result").html('<div class="alert alert-danger" role="alert">' + dados.msg + '</div>');
                                                }
                                                    },
                                                error: function ()
                                            {
                            console.log('ERROR');
                        }
                    });
        }

    });
</script>