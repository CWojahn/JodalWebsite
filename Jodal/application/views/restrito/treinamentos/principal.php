<div class="col-md-6 col-md-offset-3">

    <div class="row text-center">
        <h3>Gerenciar treinamentos cadastros no site</h3>
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
            <a href="<?php echo site_url('treinamento_painel/novo'); ?>" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
            <!--<button class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Editar</button>-->
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <!--<th class="text-center" style="width: 10%;">#</th>-->
                    <th class="text-center" style="width: 30%;">Ação</th>
                    <th class="text-center" style="width: 50%;">Treinamento</th>
                    <th class="text-center" style="width: 20%;">Idioma</th>
                    
                </tr>
            </thead>

            <tbody>
                <?php foreach ($treinamentos as $treinam) { ?>

                    <tr>
                        <!--<td class="text-center" style="width: 10%;"><input type="radio" name="radio" required value="<?php echo $treinam->id; ?>"></td>-->
                        <td class="text-center" style="width: 30%;">
                            <a href="<?php echo site_url('treinamento_painel/editar/'. $treinam->id); ?>" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
                            <a onclick="excluir(<?php echo $treinam->id; ?>);" style="cursor: pointer;"class="btn btn-danger" title="Excluir"><span class="glyphicon glyphicon-remove"></span> </a>
                        </td>
                        <td class="text-center" style="width: 50%;"><?php echo $treinam->nome_pt; ?></td>
                        <td class="text-center" style="width: 20%;"><?php
                            if ($treinam->versao_pt && !$treinam->versao_en) {
                                echo 'pt';
                            } else if (!$treinam->versao_pt && $treinam->versao_en) {
                                echo 'en';
                            } else if ($treinam->versao_pt && $treinam->versao_en) {
                                echo 'pt e en';
                            }
                            ?></td>
                        

                    </tr>

<?php } ?>

            </tbody>

        </table>
    </form>
</div>
<script src="<?php echo base_url('js/bootbox.min.js'); ?>"></script>
<script type="text/javascript">


                            function excluir(id) {

                                bootbox.confirm("Tem certeza que deseja excluir o treinamento?", function (result) {
                                    if (result) {
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo site_url('treinamento_painel/excluir'); ?>",
                                            data: {id: id},
                                            success: function (dados) {
                                                if (dados.msg == true) {
                                                    $("#result_edit").html('<div class="alert alert-success" role="alert">Treinamento excluído com sucesso!</div>');
                                                    location.reload();
                                                } else {
                                                    $("#result_edit").html('<div class="alert alert-danger" role="alert">Erro ao excluir treinamento!</div>');
                                                }
                                            },
                                            error: function () {
                                                $("#result_edit").html('<div class="alert alert-danger" role="alert">Erro ao excluir treinamento!</div>');
                                            },
                                            dataType: 'json'

                                        });
                                    }

                                });
                            }
                            ;

</script>
