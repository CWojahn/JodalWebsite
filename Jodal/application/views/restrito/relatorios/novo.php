
<div class="text-center">
    <h3>Gerar novo Relatório</h3>
    <?php if ($this->session->flashdata('unchecked')) { ?>
        <div class="alert alert-success alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>ATENÇÃO!</strong> Erro ao cadastrar novo certificado, verifique o número do certificado.
        </div>
    <?php } ?>
</div>
<div class="row">
    <form id="form_relatorio" method="post">
        <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="cliente">Selecione o Cliente</label>
                    <select class="form-control" id="cliente" name="cliente">
                        <option value="-1">Escolha um Cliente</option>
                        <?php foreach ($clientes as $client) { ?>
                            <option value="<?php echo $client->id ?>"><?php echo $client->empresa; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="tipo_relatorio">Selecione um formulário</label>
                    <select class="form-control" id="tipo_relatorio" name="tipo_relatorio">
                        <option value="-1">Escolha um formulário</option>
                        <option value="0">Programa de Gestão e Risco</option>
                        <option value="1">Relatório de Inspeção de Segurança</option>
                        <option value="2">Análise Preliminar de Risco</option>
                        <option value="3">Documento de Segurança do Trabalho</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 text-center">
            <a href="javascript:history.back()" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</a>
        </div>
    </form>
</div>
<div class="row" id="result">

</div>

<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script src="<?php echo base_url('js/bootstrap-maxlength.min.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery.maskedinput.min.js'); ?>"></script>
<script src="<?php echo base_url('js/bootbox.min.js'); ?>"></script>
<script src="<?php echo base_url('js/funcoes_de_conversao.js'); ?>"></script>
<script>

    $('#tipo_relatorio').on('change', function () {
        var tipo_relatorio = this.value;
        var cliente = document.getElementById("cliente").value
        $('#relatorio_form').removeAttr('disabled');
        if (tipo_relatorio != -1) {
            $.ajax(
                {
                url: "<?php echo site_url('relatorio_painel/carregar_header') ?>",
                type: "POST",
                data: {id: cliente, tipo: tipo_relatorio},
                  //dataType: "json",
                success: function (dados)
                    {
                        console.log('ok');
                        $("#result").html(dados);
                    },
                error: function (jqXhr, textStatus, errorThrown )
                    {
                        console.log(textStatus );
                    }
                }
            );
        }
    });

    var array_rel = [];
    var total_rel;
    $("#relatorio_form").submit(function (e) {
        e.preventDefault();
        $("#btn_add").addClass('disabled');
        var input = $("<input>").attr("type", "hidden").attr("name", "count_rel").val(array_rel.length);
        jQuery(this).append(input);
        var postData = jQuery(this).serialize();

        $.ajax(
                {
                    url: "<?php echo site_url('relatorio_painel/gerar_relatorio') ?>",
                    type: "POST",
                    data: postData,
                    dataType: "json",
                    success: function (dados)
                    {
                        if (dados.msg == true) {
                            var aux = {id_relatorio: dados.id_relatorio};

                            array_rel.push(aux);
                            total_rel = total_rel + parseFloat(dados.total);
                            console.log(array_rel);
                            $("#table_rel").append(dados.page);
                            $('html,body').animate({scrollTop: $("#result").offset().top}, 'slow');
                            //console.log(dados.total);
                            $("#btn_add").removeClass('disabled');
                        } else {
                            bootbox.alert('É necessário preencher todos os campos');
                            $("#btn_add").removeClass('disabled');
                        }
                    },
                    error: function ()
                    {
                        $("#btn_add").removeClass('disabled');
                        alert('Erro ao incluir novo relatorio!');
                    }
                });
    });


</script>
