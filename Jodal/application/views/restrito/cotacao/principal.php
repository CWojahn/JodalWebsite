<div class="col-md-10 col-md-offset-1">

    <div class="row text-center">
        <h3>Gerenciamento de cotações</h3>
    </div>
    <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php } ?>
    <div id="result_edit">

    </div>
    <form method="post">
        <div class="text-center">
            <a href="<?php echo site_url('cotacao_painel/novo'); ?>" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Novo Orçamento</a>
            <!--<button class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Editar</button>-->
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <!--<th class="text-center" style="width: 10%;">#</th>-->
                    <th class="text-center" style="width: 25%;">Ação</th>
                    <th class="text-center" style="width: 10%;">Número</th>
                    <th class="text-center" style="width: 10%;">Data</th>
                    <th class="text-center" style="width: 30%;">Empresa</th>
                    <th class="text-center" style="width: 25%;">Valor</th>


                </tr>
            </thead>

            <tbody>
                <?php setlocale(LC_ALL, 'pt_BR'); ?>
                <?php
                if (isset($orcamentos)) {

                    foreach ($orcamentos as $cert) {
                        ?>

                        <tr>
                            <!--<td class="text-center" style="width: 10%;"><input type="radio" name="radio" required value="<?php echo $cert->id; ?>"></td>-->
                            <td class="text-center" style="width: 25%;">
                                <a href="<?php echo base_url('uploads/orcamentos/' . $cert->path_pdf); ?>" class="btn btn-success" title="Imprimir" target="_blank"><span class="glyphicon glyphicon-print"></span></a>
                                <!--<a onclick="enviar(<?php //echo $cert->id;  ?>, '<?php //echo $cert->email;  ?>');" class="btn btn-success" title="Enviar" style="cursor: pointer"><span class="glyphicon glyphicon-envelope"></span></a>
                                <!--<a href="<?php // echo site_url('cotacao_painel/editar/' . $cert->id);  ?>" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>-->
                                <a onclick="excluir(<?php echo $cert->id; ?>);" style="cursor: pointer;" class="btn btn-danger" title="Excluir"><span class="glyphicon glyphicon-remove"></span> </a>
                            </td>
                            <td class="text-center" style="width: 10%;"><?php echo $cert->id; ?></td>
                            <td class="text-center" style="width: 10%;"><?php echo date("d/m/Y", strtotime($cert->data)); ?></td>
                            <td class="text-center" style="width: 30%;"><?php echo $cert->empresa; ?></td>
                            <td class="text-center" style="width: 25%;"><?php echo money_format("%.2n", $cert->valor_total); ?></td>


                        </tr>

                        <?php
                    }
                }
                ?>
            </tbody>

        </table>
    </form>
</div>
<script src="<?php echo base_url('js/bootbox.min.js'); ?>"></script>
<script type="text/javascript">


                                    function excluir(id) {

                                        bootbox.confirm("Tem certeza que deseja excluir o registro?", function (result) {
                                            if (result) {
                                                $.ajax({
                                                    type: "POST",
                                                    url: "<?php echo site_url('cotacao_painel/excluir'); ?>",
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

                                    function enviar(id, email) {

                                        bootbox.confirm("Enviar orçamento por email para <b>" + email + '</b>?<br><i>Obs.: Caso o email esteja errado, altere no cadastro do cliente</i>', function (result) {
                                            if (result) {
                                                $.ajax({
                                                    type: "POST",
                                                    url: "<?php echo site_url('cotacao_painel/enviar_email'); ?>",
                                                    data: {id: id},
                                                    success: function (dados) {
                                                        if (dados.msg == true) {
                                                            $("#result_edit").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Email enviado com sucesso!</div>');
                                                            //location.reload();
                                                        } else {
                                                            $("#result_edit").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Erro ao enviar email, verifique se o email de destino é válido.</div>');
                                                        }
                                                    },
                                                    error: function () {
                                                        $("#result_edit").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Erro inesperado ao enviar email, entre em contato com o administrador do site.</div>');
                                                    },
                                                    dataType: 'json'

                                                });
                                            }

                                        });
                                    }
                                    ;

</script>
