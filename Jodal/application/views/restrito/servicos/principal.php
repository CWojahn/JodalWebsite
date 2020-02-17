<div class="col-md-6 col-md-offset-3">

    <div class="row text-center">
        <h3>Gerenciar serviços no site</h3>
    </div>
    <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php } ?>
    <div id="result_edit">

    </div>
    <form method="post" action="<?php echo site_url('servicos_painel/editar'); ?>">
        <div class="text-center">
            <a href="<?php echo site_url('servicos_painel/novo'); ?>" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
            <button class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Editar</button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center" style="width: 20%;">#</th>
                    <th class="text-center" style="width: 60%;">Nome</th>
                    <th class="text-center" style="width: 20%;">Excluir</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($servicos as $servico) { ?>
                    <tr>
                        <td class="text-center" style="width: 20%;"><input type="radio" name="radio" required value="<?php echo $servico->id;?>"></td>
                        <td class="text-center" style="width: 60%;"><?php echo $servico->nome;?></td>
                        <td class="text-center" style="width: 20%;"><a onclick="excluir(<?php echo $servico->id;?>)" style="cursor: pointer;" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></td>

                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </form>
</div>
<script src="<?php echo base_url('js/bootbox.min.js'); ?>"></script>
<script type="text/javascript">


                            function excluir(id) {

                                bootbox.confirm("Tem certeza que deseja excluir o serviço?", function (result) {
                                    if (result) {
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo site_url('servicos_painel/excluir'); ?>",
                                            data: {id: id},
                                            success: function (dados) {
                                                if (dados.msg == true) {
                                                    $("#result_edit").html('<div class="alert alert-success" role="alert">Serviço excluído com sucesso!</div>');
                                                    location.reload();
                                                } else {
                                                    $("#result_edit").html('<div class="alert alert-danger" role="alert">Erro ao excluir serviço!</div>');
                                                }
                                            },
                                            error: function () {
                                                $("#result_edit").html('<div class="alert alert-danger" role="alert">Erro ao excluir serviço!</div>');
                                            },
                                            dataType: 'json'

                                        });
                                    }

                                });
                            }
                            ;

</script>
