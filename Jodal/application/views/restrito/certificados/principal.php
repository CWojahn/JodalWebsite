<div class="col-md-8 col-md-offset-2">

    <div class="row text-center hidden-print">
        <h3>Gerenciar certificados cadastrados no site</h3>
    </div>
    <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php } ?>
    <div id="result_edit">

    </div>
    <div class="text-center hidden-print">
        <a href="<?php echo site_url('certificado_painel/novo'); ?>" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
        <button class="btn btn-warning" onclick="window.print();"><span class="glyphicon glyphicon-print"></span> Imprimir</button>
        <!--<button class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Editar</button>-->
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <!--<th class="text-center" style="width: 10%;">#</th>-->
                <th class="text-center hidden-print" style="width: 20%;">Ação</th>
                <th class="text-center" style="width: 5%">#</th>
                <th class="text-center" style="width: 10%;">Número</th>
                <th class="text-center" style="width: 30%;">Aluno</th>
                <th class="text-center" style="width: 35%;">Treinamento</th>

            </tr>
        </thead>

        <tbody>
            <?php
            for ($index = 0; $index < count($certificados); $index++) {
                $cert = $certificados[$index];
                ?>

                <tr>
                    <!--<td class="text-center" style="width: 10%;"><input type="radio" name="radio" required value="<?php echo $cert->id; ?>"></td>-->
                    <td class="text-center hidden-print" style="width: 20%;">
                        <a href="<?php echo site_url('certificado_painel/editar/' . $cert->id); ?>" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
                        <a onclick="excluir(<?php echo $cert->id; ?>);" style="cursor: pointer;" class="btn btn-danger" title="Excluir"><span class="glyphicon glyphicon-remove"></span> </a>
                    </td>
                    <td class="text-center" style="width: 5%;"><strong><?php echo $index + 1; ?></strong></td>
                    <td class="text-center" style="width: 10%;"><?php echo $cert->id; ?></td>
                    <td class="text-center" style="width: 30%;"><?php echo $cert->aluno_nome; ?></td>
                    <td class="text-center" style="width: 35%;"><?php echo strip_tags($cert->nome_pt); ?></td>

                </tr>

            <?php } ?>
        </tbody>

    </table>
</div>
<script src="<?php echo base_url('js/bootbox.min.js'); ?>"></script>
<script type="text/javascript">


                        function excluir(id) {

                            bootbox.confirm("Tem certeza que deseja excluir o registro?", function (result) {
                                if (result) {
                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo site_url('certificado_painel/excluir'); ?>",
                                        data: {id: id},
                                        success: function (dados) {
                                            if (dados.msg == true) {
                                                $("#result_edit").html('<div class="alert alert-success" role="alert">Registro excluído com sucesso!</div>');
                                                location.reload();
                                            } else {
                                                $("#result_edit").html('<div class="alert alert-danger" role="alert">Erro ao excluir registro!</div>');
                                            }
                                        },
                                        error: function () {
                                            $("#result_edit").html('<div class="alert alert-danger" role="alert">Erro ao excluir registro!</div>');
                                        },
                                        dataType: 'json'

                                    });
                                }

                            });
                        }
                        ;

</script>
