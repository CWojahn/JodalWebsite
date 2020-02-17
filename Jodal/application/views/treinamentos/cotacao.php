<div class="row text-center">
    <h2>Dados da Empresa</h2>
</div>

<div class="row col-md-offset-2">
    <div class="col-md-10 col-sm-10 text-center" id="result">

    </div>     
</div>
<div class="row col-md-offset-2">


    <form class="form-horizontal" id="form_cotacao" method="post" >
        <div class="form-group">
            <label for="empresa" class="col-sm-5 col-md-4 control-label">Nome da Empresa</label>
            <div class="col-sm-5 col-md-4">
                <input type="text" class="form-control input-jodal" id="empresa" name="empresa" placeholder="Digite aqui">
            </div>
        </div>
        <div class="form-group">
            <label for="responsavel" class="col-sm-5 col-md-4 control-label">Responsável</label>
            <div class="col-sm-5 col-md-4">
                <input type="text" class="form-control input-jodal" id="responsavel" name="responsavel" placeholder="Digite aqui">
            </div>
        </div>
        <div class="form-group">
            <label for="endereco" class="col-sm-5 col-md-4 control-label">Endereço</label>
            <div class="col-sm-5 col-md-4">
                <input type="text" class="form-control input-jodal" id="endereco" name="endereco" placeholder="Digite aqui">
            </div>
        </div>
        <div class="form-group">
            <label for="telefone" class="col-sm-5 col-md-4 control-label">Telefone</label>
            <div class="col-sm-5 col-md-4">
                <input type="tel" class="form-control input-jodal" id="telefone" name="telefone" placeholder="Digite aqui">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-5 col-md-4 control-label">Email</label>
            <div class="col-sm-5 col-md-4">
                <input type="email" class="form-control input-jodal" id="email" name="email" placeholder="Digite aqui">
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-9 text-center">
                <h2>Dados do Curso</h2>
            </div>
        </div>
        <div class="form-group">
            <label for="curso" class="col-sm-5 col-md-4 control-label">Curso</label>
            <div class="col-sm-5 col-md-4">
                <select id="curso" name="curso" class="form-control input-jodal text-center text-uppercase">

                    <?php
                    if ($idioma == 'pt') {

                        if (!isset($treinamento_detail)) {
                            ?>
                            <option value="-1" selected="">Selecione um treinamento</option>
                            <?php foreach ($all_treinamentos as $treinamento) {
                                ?>
                                <option value="<?php echo $treinamento->id; ?>"><?php echo $treinamento->nome_pt; ?></option>

                                <?php
                            }
                        } else {
                            ?>
                            <?php foreach ($all_treinamentos as $treinamento) { ?>
                                <option value="<?php echo $treinamento->id; ?>" <?php echo $treinamento_detail->id == $treinamento->id ? 'selected' : ''; ?>><?php echo $treinamento->nome_pt; ?></option>
                                <?php
                            }
                        }
                    } else {
                        if (!isset($treinamento_detail)) {
                            ?>
                            <option value="-1" selected="">Select Training</option>
                            <?php foreach ($all_treinamentos as $treinamento) {
                                ?>
                                <option value="<?php echo $treinamento->id; ?>"><?php echo $treinamento->nome_en; ?></option>

                                <?php
                            }
                        } else {
                            ?>
                            <?php foreach ($all_treinamentos as $treinamento) { ?>
                                <option value="<?php echo $treinamento->id; ?>" <?php echo $treinamento_detail->id == $treinamento->id ? 'selected' : ''; ?>><?php echo $treinamento->nome_en; ?></option>
                            <?php
                            }
                        }
                    }
                    ?>

                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="alunos" class="col-sm-5 col-md-4 control-label">Número de Alunos</label>
            <div class="col-sm-5 col-md-4">
                <input type="text" class="form-control input-jodal" id="alunos" name="alunos" placeholder="Digite aqui">
            </div>
        </div>
        <div class="form-group">
            <label for="resp_curso" class="col-sm-5 col-md-4 control-label">Responsável</label>
            <div class="col-sm-5 col-md-4">
                <input type="text" class="form-control input-jodal" id="resp_curso" name="resp_curso" placeholder="Digite aqui">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-10 text-center">
                <button type="submit" class="btn btn-jodal">Enviar</button>
            </div>
        </div>
    </form>
</div>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script>
// just for the demos, avoids form submit

    $("#form_cotacao").validate({
        rules: {
            empresa: {
                required: true
            },
            responsavel: {
                required: true
            },
            endereco: {
                required: true
            },
            telefone: {
                required: true
            },
            email: {
                required: true
            },
            curso: {
                required: true
            },
            alunos: {
                required: true
            },
            resp_curso: {
                required: true
            }
        },
        messages: {
            empresa: {
                required: 'É obrigatório incluir o nome da empresa'
            },
            responsavel: {
                required: 'É obrigatório incluir o nome do responsável'
            },
            endereco: {
                required: 'É obrigatório incluir o endereço'
            },
            telefone: {
                required: 'É obrigatório incluir o telefone da empresa'
            },
            email: {
                required: 'É obrigatório incluir um email para contato'
            },
            curso: {
                required: 'É obrigatório incluir um curso de interesse'
            },
            alunos: {
                required: 'É obrigatório incluir a quantidade de alunos'
            },
            resp_curso: {
                required: 'É obrigatório incluir o responsável'
            }
        }

    });
</script>

<script type="text/javascript">
    $("#form_cotacao").submit(function (e) {
        e.preventDefault();
        var postData = jQuery(this).serialize();

        $.ajax(
                {
                    url: "<?php echo site_url('treinamentos/submit_cotacao') ?>",
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
    });
</script>