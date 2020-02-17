<div class="col-md-6 col-md-offset-3">

    <div class="row text-center">
        <h3>Gerenciar Material de Apoio no site</h3>
    </div>
    <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php } ?>
    <div id="result_edit">

    </div>
    <form method="post" action="<?php echo site_url('material_painel/editar'); ?>">
        <div class="text-center">
            <a href="<?php echo site_url('material_painel/novo'); ?>" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
            
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center" style="width: 40%;">#</th>
                    <th class="text-center" style="width: 60%;">Empresa</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($materiais as $parceiro) { ?>
                <tr>
                    <td class="text-center" style="width: 40%;">
                        <a href="<?php echo site_url('material_painel/editar/' . $parceiro->id); ?>" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
                        <a onclick="excluir(<?php echo $parceiro->id;?>);" style="cursor: pointer;" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> </a>
                    </td>
                    <td class="text-center" style="width: 60%;"><?php echo $parceiro->nome;?></td>
                    

                </tr>
                <?php } ?>


            </tbody>

        </table>
    </form>
</div>
<script src="<?php echo base_url('js/bootbox.min.js'); ?>"></script>
<script type="text/javascript">


                        function excluir(id) {

                            bootbox.confirm("Tem certeza que deseja excluir a empresa?", function (result) {
                                if (result) {
                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo site_url('material_painel/excluir'); ?>",
                                        data: {id: id},
                                        success: function (dados) {
                                            if (dados.msg == true) {
                                                $("#result_edit").html('<div class="alert alert-success" role="alert">Material excluído com sucesso!</div>');
                                                location.reload();
                                            } else {
                                                $("#result_edit").html('<div class="alert alert-danger" role="alert">Erro ao excluir material!</div>');
                                            }
                                        },
                                        error: function () {
                                            $("#result_edit").html('<div class="alert alert-danger" role="alert">Erro ao excluir material!</div>');
                                        },
                                        dataType: 'json'

                                    });
                                }

                            });
                        }
                        ;

</script>
