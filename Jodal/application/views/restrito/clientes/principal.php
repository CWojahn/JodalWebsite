<div class="col-md-8 col-md-offset-2">

    <div class="row text-center hidden-print">
        <h3>Gerenciamento de clientes</h3>
    </div>
    <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success alert-dismissible text-center" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php } ?>
    <div id="result_edit">

    </div>
    <!--<form method="post">-->
    <div class="row">
        <div class="text-center hidden-print">
            <a href="<?php echo site_url('clientes_painel/novo'); ?>" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Novo Cliente</a>
            <button class="btn btn-warning" onclick="window.print();"><span class="glyphicon glyphicon-print"></span> Imprimir</button>
        </div>
        <hr>
        <div id="custom-search-input" class="input-group col-md-8 col-sm-10 col-md-offset-2" style="float: left;">
            <input id="search" type="text" class="form-control" placeholder="Filtrar" />
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">
                    <i class="glyphicon glyphicon-search"></i>
                </button>
            </span>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <!--<th class="text-center" style="width: 10%;">#</th>-->
                    <th class="text-center hidden-print" style="width: 20%;">Ação</th>
                    <th class="text-center" style="width: 5%">#</th>
                    <th class="text-center" style="width: 25%;">CPF/CNPJ</th>
                    <th class="text-center" style="width: 25%;">Empresa</th>
                    <th class="text-center" style="width: 25%;">Telefone</th>

                </tr>
            </thead>

            <tbody>
                <?php
                for ($index = 0; $index < count($clientes); $index++) {
                    $cert = $clientes[$index];
                    ?>

                    <tr>
                        <!--<td class="text-center" style="width: 10%;"><input type="radio" name="radio" required value="<?php echo $cert->id; ?>"></td>-->
                        <td class="text-center hidden-print" style="width: 20%;">
                            <a href="<?php echo site_url('clientes_painel/editar/' . $cert->id); ?>" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
                            <a onclick="excluir(<?php echo $cert->id; ?>);" style="cursor: pointer;" class="btn btn-danger" title="Excluir"><span class="glyphicon glyphicon-remove"></span> </a>
                        </td>
                        <td class="text-center" style="width: 5%;"><strong><?php echo $index + 1; ?></strong></td>
                        <td class="text-center" style="width: 25%;"><?php echo $cert->cnpj; ?></td>
                        <td class="text-center" style="width: 25%;"><?php echo $cert->empresa; ?></td>
                        <td class="text-center" style="width: 25%;"><?php echo $cert->telefone; ?></td>

                    </tr>

<?php } ?>
            </tbody>

        </table>
        <!--</form>-->
    </div>
</div>
<script src="<?php echo base_url('js/bootbox.min.js'); ?>"></script>
<script type="text/javascript">

                                $('#search').keyup(function () {
                                    var current_query = $('#search').val().toLowerCase();
                                    if (current_query !== "") {
                                        $(".table > tbody > tr").hide();
                                        $(".table > tbody > tr").each(function () {
                                            var current_keyword = $(this).text().toLowerCase();
                                            if (current_keyword.indexOf(current_query) >= 0) {
                                                $(this).show();
                                            }
                                            ;
                                        });
                                    } else {
                                        $(".table > tbody > tr").show();
                                    }
                                });
                                function excluir(id) {

                                    bootbox.confirm("Tem certeza que deseja excluir o registro?", function (result) {
                                        if (result) {
                                            $.ajax({
                                                type: "POST",
                                                url: "<?php echo site_url('clientes_painel/excluir'); ?>",
                                                data: {id: id},
                                                success: function (dados) {
                                                    if (dados.msg == true) {
                                                        $("#result_edit").html('<div class="alert alert-success text-center" role="alert">Registro excluído com sucesso!</div>');
                                                        location.reload();
                                                    } else {
                                                        $("#result_edit").html('<div class="alert alert-danger text-center" role="alert">Erro ao excluir registro!</div>');
                                                    }
                                                },
                                                error: function () {
                                                    $("#result_edit").html('<div class="alert alert-danger text-center" role="alert">Erro ao excluir registro!</div>');
                                                },
                                                dataType: 'json'

                                            });
                                        }

                                    });
                                }
                                ;

</script>
