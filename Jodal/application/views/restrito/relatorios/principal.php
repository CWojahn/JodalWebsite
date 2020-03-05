<div class="col-md-10 col-md-offset-1">

    <div class="row text-center">
        <h3>Gerenciamento de relatórios</h3>
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
            <a href="<?php echo site_url('relatorio_painel/novo'); ?>" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Novo Relatório</a>
            <!--<button class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Editar</button>-->
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <!--<th class="text-center" style="width: 10%;">#</th>-->
                    <th class="text-center" style="width: 15%;">Ação</th>
                    <th class="text-center" style="width: 5%;">Número</th>
                    <th class="text-center" style="width: 5%;">Data</th>
                    <th class="text-center" style="width: 20%;">Obra</th>
                    <th class="text-center" style="width: 5%;">Local</th>
                    <th class="text-center" style="width: 35%;">Cliente</th>
                    <th class="text-center" style="width: 15%;">Tipo de Relatório</th>


                </tr>
            </thead>

            <tbody>
                <?php setlocale(LC_ALL, 'pt_BR'); ?>
                <?php
                if (isset($relatorios)) {
                    foreach ($relatorios as $relatorio) {
                        ?>
                        <tr>
                            <td class="text-center" style="width: 15%;">
                                <a onclick="gerapdf(<?php echo $relatorio->id;?>, <?php echo $relatorio->tipo;?>)" class="btn btn-success" title="Imprimir" target="_blank"><span class="glyphicon glyphicon-print"></span></a>
                                <a onclick="enviar(<?php echo $relatorio->id;?>, '<?php echo $relatorio->email;?>');" class="btn btn-success" title="Enviar" style="cursor: pointer"><span class="glyphicon glyphicon-envelope"></span></a>
                                <?php if ($relatorio->tipo == 'PCMAT & PGST') { ?>
                                        <a href="<?php echo site_url('relatorio_painel/editar_pcmat/' . $relatorio->id); ?>" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
                                <?php  }elseif ($relatorio->tipo == 'RIS') { ?>
                                        <a href="<?php echo site_url('relatorio_painel/editar_ris/' . $relatorio->id); ?>" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
                                <?php  }elseif ($relatorio->tipo == 'APR') { ?>
                                        <a href="<?php echo site_url('relatorio_painel/editar_apr/' . $relatorio->id); ?>" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
                                <?php  }elseif ($relatorio->tipo == 'DST') { ?>
                                        <a href="<?php echo site_url('relatorio_painel/editar_dst/' . $relatorio->id); ?>" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
                                <?php   } ?>
                                <a onclick="excluir(<?php echo $relatorio->id; ?>);" style="cursor: pointer;" class="btn btn-danger" title="Excluir"><span class="glyphicon glyphicon-remove"></span> </a>
                            </td>
                            <td class="text-center" style="width: 5%;"><?php echo $relatorio->id; ?></td>
                            <td class="text-center" style="width: 5%;"><?php echo date("d/m/Y", strtotime($relatorio->data)); ?></td>
                            <td class="text-center" style="width: 20%;"><?php echo $relatorio->obra; ?></td>
                            <td class="text-center" style="width: 5%;"><?php echo $relatorio->local; ?></td>
                            <td class="text-center" style="width: 35%;"><?php echo $relatorio->empresa; ?></td>
                            <td class="text-center" style="width: 15%;"><?php echo $relatorio->tipo; ?></td>

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
                    url: "<?php echo site_url('relatorio_painel/excluir') ?>",
                    data: {id: id},
                    dataType: 'json',
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
                    }
                });
            }
            else{
                console.log('as');
            }
        });
    };

    function enviar(id, email) {

        bootbox.confirm("Enviar relatório por email para <b>" + email + '</b>?<br><i>Obs.: Caso o email esteja errado, altere no cadastro do cliente</i>', function (result) {
            if (result) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('relatorio_painel/enviar_email'); ?>",
                    data: {id: id},
                    success: function (dados) {
                        if (dados.msg == true) {
                            $("#result_edit").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Email enviado com sucesso!</div>');
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

<script>
    function gerapdf(id, tipo){
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('relatorio_painel/gerar_relatorio') ?>",
            data: {id: id, tipo: tipo},
            dataType: 'json',
            success: function (dados) {
                openpdf(dados);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                openpdf(xhr.responseText);
            }
        });
    };
    
    function openpdf(dados) {
        window.open("http://www.jodaltreinamentos.com/jodal/uploads/relatorios/pdf/" + dados, "_blank");
    };
</script>