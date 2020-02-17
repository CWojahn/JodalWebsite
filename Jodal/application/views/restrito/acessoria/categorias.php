<div class="col-md-6 col-md-offset-3">

    <div class="row text-center">
        <h3>Gerenciar Categorias</h3>
    </div>
    <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php } ?>
    <div id="result_edit">

    </div>

    <div class="text-center">
        <a href="<?php echo site_url('acessoria_painel/categoria_novo') ?>" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
        <!--<button class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Editar</button>-->
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <!--<th class="text-center" style="width: 10%;">#</th>-->
                <th class="text-center" style="width: 30%;">Ação</th>
                <th class="text-center" style="width: 70%;">Categoria</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($categorias as $value) { ?>
                <tr>
                    <td class="text-center hidden-print" style="width: 30%;">
                        <a href="<?php echo site_url('acessoria_painel/categoria_editar/' . $value->id); ?>" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
                        <a onclick="excluir(<?php echo $value->id; ?>);" style="cursor: pointer;" class="btn btn-danger" title="Excluir"><span class="glyphicon glyphicon-remove"></span> </a>
                    </td>
                    <td class="text-center" style="width: 70%;"><?php echo $value->nome; ?></td>
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
                                        url: "<?php echo site_url('acessoria_painel/categ_excluir'); ?>",
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


                        function PreviewImage(elem) {
                            var oFReader = new FileReader();
                            oFReader.readAsDataURL(elem.files[0]);

                            oFReader.onload = function (oFREvent) {
                                document.getElementById(elem.id + "_img").src = oFREvent.target.result;
                            };
                        }
                        ;

                        $("#submit").click(function () {
                            $.ajax({
                                type: "POST", dataType: 'json',
                                url: "<?php echo site_url('acessoria_painel/categoria_novo'); ?>", //process to mail
                                data: $('#form_nova').serialize(),
                                success: function (msg) {
                                    //$("#thanks").html(msg) //hide button and show thank you
                                    console.log(msg.result);
                                    if (msg.result == true) {
                                        $("#result_categ").html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Novo tipo de produto cadastrado com sucesso!</div>");
                                        $("#myModal").modal('hide'); //hide popup 
                                        location.reload();
                                    } else {
                                        $("#result_categ").html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Erro ao cadastrar nova categoria, verifique se o nome não existe.</div>");
                                        $("#myModal").modal('hide'); //hide popup 
                                    }
                                },
                                error: function () {
                                    $("#result_categ").html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Erro inesperado ao cadastrar nova categoria.</div>");
                                    $("#myModal").modal('hide'); //hide popup 
                                }
                            });
                        });
</script>