
<div class="text-center">
    <div id="result_edit">

    </div>
    
    <?php if ($this->session->flashdata('error')) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php } ?>
    
    <a href="<?php echo site_url('user_painel/novo');?>" id="btn_novo" class="btn btn-default btn-lg" aria-label="Left Align" title="Novo Usuário">
        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
    </a>
    
</div>

<div id="body_categ">
    <h3 class="text-center">Usuários Cadastrados</h3>
    <ul class="list-group col-md-offset-4 col-md-4">
        <?php foreach ($usuarios as $usuario) { ?>
        <li class="list-group-item"><a title="Excluir usuário" onclick="excluir(<?php echo $usuario->id; ?>);" style="cursor: pointer;"class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a> <?php echo $usuario->username; ?></li>

        <?php } ?>

    </ul>

</div>

<script src="<?php echo base_url('js/bootbox.min.js'); ?>"></script>
<script type="text/javascript">


                            function excluir(id) {

                                bootbox.confirm("Tem certeza que deseja excluir o usuário?", function (result) {
                                    if (result) {
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo site_url('user_painel/excluir'); ?>",
                                            data: {id: id},
                                            success: function (dados) {
                                                if (dados.msg == true) {
                                                    $("#result_edit").html('<div class="alert alert-success" role="alert">Usuário excluído com sucesso!</div>');
                                                    location.reload();
                                                } else {
                                                    $("#result_edit").html('<div class="alert alert-danger" role="alert">Erro ao excluir usuário!</div>');
                                                }
                                            },
                                            error: function () {
                                                $("#result_edit").html('<div class="alert alert-danger" role="alert">Erro ao excluir usuário!</div>');
                                            },
                                            dataType: 'json'

                                        });
                                    }

                                });
                            }
                            ;

</script>
