<div class="col-md-8 col-md-offset-2">

    <div class="row text-center">
        <h3>Gerenciar serviços cadastrados no site</h3>
    </div>
    <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php } ?>
    <div id="result_edit">

    </div>
    <form method="post" action="<?php echo site_url('treinamento_painel/editar'); ?>">
        <div class="text-center">
            <a href="<?php echo site_url('acessoria_painel/servico_novo'); ?>" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
            <!--<button class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Editar</button>-->
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <!--<th class="text-center" style="width: 10%;">#</th>-->
                    <th class="text-center" style="width: 30%;">Ação</th>
                    <th class="text-center" style="width: 40%;">Serviço</th>
                    <th class="text-center" style="width: 40%;">Categoria</th>

                </tr>
            </thead>

            <tbody>
                <?php foreach ($servicos as $value) { ?>
                <tr>
                    <td class="text-center hidden-print" style="width: 30%;">
                        <a href="<?php echo site_url('acessoria_painel/servico_editar/' . $value->id); ?>" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
                        <a onclick="excluir(<?php echo $value->id; ?>);" style="cursor: pointer;" class="btn btn-danger" title="Excluir"><span class="glyphicon glyphicon-remove"></span> </a>
                    </td>
                    <td class="text-center" style="width: 40%;"><?php echo $value->nome; ?></td>
                    <td class="text-center" style="width: 40%;"><?php echo $value->categoria; ?></td>
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
                                            url: "<?php echo site_url('acessoria_painel/servico_excluir'); ?>",
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

