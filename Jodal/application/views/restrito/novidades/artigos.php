<h3 class="text-center">Novidades</h3>
<div class="text-center">

    <div class="row">
        <a href="<?php echo site_url('novidades_painel/artigo_novo'); ?>" id="btn_empresa" class="btn btn-success" aria-label="Left Align" title="Cadastrar Novidade">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Novo
        </a>

    </div>
    <div id="result_edit">

    </div>
    <div class="col-md-6 col-md-offset-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <!--<th class="text-center" style="width: 10%;">#</th>-->
                    <th class="text-center" style="width: 40%;">Ação</th>
                    <th class="text-center" style="width: 60%;">Nome</th>
                    <!--<th class="text-center" style="width: 20%;">Tipo</th>-->

                </tr>
            </thead>

            <tbody>
                <?php foreach ($artigos as $artig) { ?>

                    <tr>
                        <!--<td class="text-center" style="width: 10%;"><input type="radio" name="radio" required value="<?php // echo $serv->id;   ?>"></td>-->
                        <td class="text-center" style="width: 30%;">
                            <a href="<?php echo site_url('novidades_painel/artigo_editar/' . $artig->id); ?>" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
                            <a onclick="excluir(<?php echo $artig->id; ?>);" style="cursor: pointer;"class="btn btn-danger" title="Excluir"><span class="glyphicon glyphicon-remove"></span> </a>
                        </td>
                        <td class="text-center" style="width: 50%;"><?php echo $artig->nome; ?></td>
                        <!--<td class="text-center" style="width: 20%;"><?php //echo $artig->privado ? 'Privado' : 'Público';  ?></td>-->


                    </tr>

                <?php } ?>

            </tbody>

        </table>
    </div>

</div>
<script src="<?php echo base_url('js/bootbox.min.js'); ?>"></script>
<script type="text/javascript">


                                function excluir(id) {

                                    bootbox.confirm("Tem certeza que deseja excluir o Artigo?", function (result) {
                                        if (result) {
                                            $.ajax({
                                                type: "POST",
                                                url: "<?php echo site_url('novidades_painel/artigo_excluir'); ?>",
                                                data: {id: id},
                                                success: function (dados) {
                                                    if (dados.msg == true) {
                                                        $("#result_edit").html('<div class="alert alert-success" role="alert">Artigo excluído com sucesso!</div>');
                                                        location.reload();
                                                    } else {
                                                        $("#result_edit").html('<div class="alert alert-danger" role="alert">Erro ao excluir Artigo!</div>');
                                                    }
                                                },
                                                error: function () {
                                                    $("#result_edit").html('<div class="alert alert-danger" role="alert">Erro ao excluir Artigo!</div>');
                                                },
                                                dataType: 'json'

                                            });
                                        }

                                    });
                                }
                                ;

</script>