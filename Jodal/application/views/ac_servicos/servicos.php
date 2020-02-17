<div class="container-fluid" style="margin-top: 10px;">
    <div class="row">
        <img src="<?php echo base_url('uploads/acessoria/categoria/' . $categoria->banner); ?>" style="width: 100%;">
        <div class="div-img"><?php echo $categoria->nome; ?></div>
    </div>
</div>
<div class="container" style="background-color: #FFF; min-height: 400px;">
    <div class="col-md-3 col-sm-4" style="margin-top: 30px;">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default" >
                <div class="panel-heading" role="tab" id="headingOne" style="color: #FFF;background-color: #003232">
                    <h4 class="panel-title text-center">
                        <strong>MENU</strong>

                    </h4>
                </div>
            </div>
            <div class="panel panel-default" >
                <div class="panel-heading" role="tab" id="headingOne" style="background-color: #CCC">
                    <h4 class="panel-title text-center">
                        <a role="button" href="<?php echo site_url('acessoria/servicos'); ?>">
                            <strong>Todos os Serviços</strong>
                        </a>
                    </h4>
                </div>
            </div>
            <?php foreach ($menu as $itemMenu) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne" style="background-color: #CCC">
                        <h4 class="panel-title text-center">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo 'collapse' . $itemMenu->categoria->id; ?>" aria-expanded="true" aria-controls="collapseOne">
                                <strong><?php echo $itemMenu->categoria->nome; ?></strong>
                            </a>
                        </h4>
                    </div>
                    <div id="<?php echo 'collapse' . $itemMenu->categoria->id; ?>" class="panel-collapse collapse <?php echo isset($itemMenu->servicos) ? ($itemMenu->categoria->id == $categoria->id ? 'in' : '') : ''; ?>" role="tabpanel" aria-labelledby="headingOne">
                        <div class="list-group">
                            <a class="list-group-item text-center" href="<?php echo site_url('acessoria/categoria/' . $itemMenu->categoria->id) ?>">Todos serviços</a>

                            <?php foreach ($itemMenu->servicos as $subCateg) { ?>

                                <a class="list-group-item text-center" href="<?php echo site_url('acessoria/servico/' . $subCateg->id); ?>"><?php echo $subCateg->nome; ?></a>

                            <?php } ?>
                        </div>

                    </div>
                </div>
            <?php } ?>

        </div>
    </div>

    <div class="col-md-9 col-sm-8" style="margin-top: 30px;">

        <div class="col-md-12 col-sm-12 text-center" id="result">

        </div>

        <?php if (count($servicos) > 0) { ?>
            <?php foreach ($servicos as $serv) { ?>

                <?php if ($serv->estilo == 1) { ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="thumbnail">
                            <a href="<?php echo site_url('acessoria/servico/' . $serv->id) ?>">
                                <img class="img-rounded" data-src="holder.js/300x300" alt="..." src="<?php echo base_url('uploads/acessoria/servico/' . $serv->selo); ?>" style="height: 170px; width: 170px;">
                            </a>
                            <div class="caption">
                                <h3 class="text-center"  style="height: 72px; word-wrap: break-word;">
                                    <?php echo $serv->nome;
                                    ?></h3>


                                <p class="text-center" style="height: 105px;"><?php
                                    echo $serv->desc_curta
                                    ?></p>
                                <p>
                                <div style="text-align: center;display: block; ">
                                    <a href="<?php echo site_url('acessoria/servico/' . $serv->id) ?>" class="btn btn-jodal" role="button" >SAIBA +</a>
                                    <!--<a href="<?php //echo site_url('produtos/cotacao/' . $serv->id)                                      ?>" class="btn btn-primee-quote" role="button" >Cotar</a>-->
                                    <button class="btn btn-jodal" title="Cotar" data-toggle="modal" data-target="#Modal_edit" data-id="<?php echo $serv->id; ?>" data-categ="<?php
                                    echo $serv->nome;
                                    ?>">COTAR</button>
                                </div>
                                </p>
                            </div>

                        </div>
                    </div>

                <?php } else {
                    ?>
                    <div class = "col-md-4 col-sm-6">
                        <div class = "thumbnail">
                            <a href = "<?php echo site_url('acessoria/servico/' . $serv->id) ?>">
                                <img data-src = "holder.js/300x300" alt = "..." src = "<?php echo base_url('uploads/acessoria/servico/' . $serv->selo); ?>" style = "height: 170px; width: 170px;">
                            </a>
                            <div class = "caption">
                                <h3 class = "text-center" style = "height: 72px;"><?php
                                    echo $serv->nome;
                                    ?></h3>


                                <p class="text-center" style="height: 105px;"><?php
                                    echo $serv->desc_curta
                                    ?></p>
                                <p>
                                <div style="text-align: center;display: block; ">
                                    <a href="<?php echo site_url('acessoria/servico/' . $serv->id) ?>" class="btn btn-jodal" role="button" >SAIBA +</a>
                                    <!--<a href="<?php //echo site_url('produtos/cotacao/' . $serv->id)                                      ?>" class="btn btn-primee-quote" role="button" >Cotar</a>-->

                                </div>
                                </p>
                            </div>

                        </div>
                    </div>

                    <?php
                }
            }
        } else {
            ?>
            <div class="col-md-12 text-center">Não há produtos cadastrados.</div>
        <?php } ?>
    </div>
    <?php if (isset($pagination)) { ?>
        <div class="row">
            <div class="col-md-12 text-center">
                <?php echo $pagination; ?>
            </div>
        </div>
    <?php } ?>
</div>

<!-- Modal -->
<div class="modal fade" id="Modal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cotação de Produto</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" id="form_cotacao" method="post" >
                    <input type="text" id="id_prod" name="id_prod" hidden="">
                    <div class="form-group">
                        <label for="produto" class="col-sm-5 col-md-4 control-label">Produto</label>
                        <div class="col-sm-7 col-md-7">
                            <p class="form-control-static" id="produto" style="font-weight: bold"></p>
                           <!-- <input type="text" class="form-control input-primee" id="produto" name="produto" placeholder="Digite aqui">-->
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nome" class="col-sm-5 col-md-4 control-label">Nome</label>
                        <div class="col-sm-5 col-md-5">
                            <input type="text" class="form-control input-primee" id="nome" name="nome" placeholder="Digite aqui">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefone" class="col-sm-5 col-md-4 control-label">Telefone</label>
                        <div class="col-sm-5 col-md-5">
                            <input type="tel" class="form-control input-primee" id="telefone" name="telefone" placeholder="Digite aqui">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-5 col-md-4 control-label">Email</label>
                        <div class="col-sm-5 col-md-5">
                            <input type="email" class="form-control input-primee" id="email" name="email" placeholder="Digite aqui">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="endereco" class="col-sm-5 col-md-4 control-label">Endereço</label>
                        <div class="col-sm-5 col-md-5">
                            <input type="text" class="form-control input-primee" id="endereco" name="endereco" placeholder="Digite aqui">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mensagem" class="col-sm-5 col-md-4 control-label">Mensagem</label>
                        <div class="col-sm-5 col-md-5">
                            <textarea class="form-control textarea-primee" id="mensagem" name="mensagem" placeholder="Digite aqui" rows="5"> </textarea>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primee-quote" data-dismiss="modal">FECHAR</button>
                <button type="button" class="btn btn-primee-more" id="edit_submit">ENVIAR</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#edit_submit").click(function () {
        //e.preventDefault();
        //var postData = $('#form_cotacao').serialize();

        $.ajax(
                {
                    url: "<?php echo site_url('acessoria/submit_cotacao') ?>",
                    type: "POST",
                    data: $('#form_cotacao').serialize(),
                    dataType: "json",
                    success: function (dados)
                    {
                        if (dados.sucesso == true) {
                            console.log('true');
                            $("#result").html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" + dados.msg + "</div>");
                            $("#Modal_edit").modal('hide'); //hide popup 
                        } else {
                            console.log('false');
                            $("#result").html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" + dados.msg + "</div>");
                            $("#Modal_edit").modal('hide'); //hide popup 
                        }
                    },
                    error: function ()
                    {
                        console.log('ERROR');

                    }
                });
    });
</script>
<script type="text/javascript">

    $('#Modal_edit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var categ = button.data('categ'); // Extract info from data-* attributes
        var id_categ = button.data('id');
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        //modal.find('.modal-title').text('New message to ' + categ)
        modal.find('#id_prod').val(id_categ);
        modal.find('#produto').html(categ);

    });


</script>