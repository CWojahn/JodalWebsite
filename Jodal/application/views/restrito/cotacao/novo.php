<div class="text-center">
    <h3>Gerar novo Orçamento</h3>
    <?php if ($this->session->flashdata('unchecked')) { ?>
        <div class="alert alert-success alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>ATENÇÃO!</strong> Erro ao cadastrar novo certificado, verifique o número do certificado.
        </div>
    <?php } ?>
</div>
<div class="row">
    <form id="form_orcamento" method="post">
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
                    <label for="treinamento">Selecione o Treinamento</label>
                    <select class="form-control" id="treinamento" name="treinamento" disabled="">
                        <option value="-1">Escolha um treinamento</option>
                        <?php foreach ($treinamentos as $treinam) { ?>
                            <option value="<?php echo $treinam->id ?>"><?php echo $treinam->nome_pt; ?></option>
                        <?php } ?>

                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="alunos">Número de alunos</label>
                    <input class="form-control text-center" id="alunos" name="alunos" disabled="">
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 text-center">
            <button class="btn btn-success" data-loading-text="Incluindo..." id="btn_add"><span class="glyphicon glyphicon-plus"></span> Acrescentar</button>
            <!--<button class="btn btn-success disabled" id="btn_add"><span class="glyphicon glyphicon-plus"></span> Add treinamento</button>-->
            <a href="javascript:history.back()" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</a>
        </div>
    </form>
</div>
<div class="row text-center" id="result">

</div>

<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script src="<?php echo base_url('js/bootstrap-maxlength.min.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery.maskedinput.min.js'); ?>"></script>
<script src="<?php echo base_url('js/bootbox.min.js'); ?>"></script>
<script src="<?php echo base_url('js/funcoes_de_conversao.js'); ?>"></script>
<script>
// just for the demos, avoids form submit
    /*$('#treinamento').on('change', function () {
     alert(this.value); // or $(this).val()
     });*/

    $('#cliente').on('change', function () {
        //alert(this.value); // or $(this).val()
        var cliente = this.value;
        $('#treinamento').removeAttr('disabled');
        $('#alunos').removeAttr('disabled');
        if (cliente != -1) {
            $.ajax(
                    {
                        url: "<?php echo site_url('cotacao_painel/carregar_header') ?>",
                        type: "POST",
                        data: {id: cliente},
                        //dataType: "json",
                        success: function (dados)
                        {
                            total_orc = 0.0;
                            array_orc = [];
                            $("#result").html(dados);
                            //console.log(dados);


                        },
                        error: function ()
                        {
                            console.log('ERROR');
                        }
                    });
        }

    });
    var array_orc = [];
    var total_orc;
    $("#form_orcamento").submit(function (e) {
        e.preventDefault();
        $("#btn_add").addClass('disabled');
        var input = $("<input>").attr("type", "hidden").attr("name", "count_orc").val(array_orc.length);
        jQuery(this).append(input);
        var postData = jQuery(this).serialize();

        $.ajax(
                {
                    url: "<?php echo site_url('cotacao_painel/gerar_cotacao') ?>",
                    type: "POST",
                    data: postData,
                    dataType: "json",
                    success: function (dados)
                    {
                        if (dados.msg == true) {
                            var aux = {id_treinamento: dados.id_treinamento, valor: dados.total, alunos: dados.alunos};

                            array_orc.push(aux);
                            total_orc = total_orc + parseFloat(dados.total);
                            console.log(array_orc);
                            $("#result_selos").append(dados.header);
                            $("#table_orc").append(dados.page);
                            $("#table_total").html(converteFloatMoeda(total_orc));
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
                        alert('Erro ao incluir novo orçamento!');
                    }
                });
    });

    function updateOrc(nro_orc, id_trein) {
        //console.log('Nro: ' + nro_orc);
        //console.log('id: ' + id_trein);
        var aux_total = 0;
        
        for(var aux in array_orc){
            //console.log('Aux: ' + array_orc[aux].id_treinamento);
            if(id_trein == array_orc[aux].id_treinamento){
                //console.log('Antes: '+array_orc[aux].valor);
                var nro_alunos = $("#nalunos_"+nro_orc).html();
                var valor_aluno = $("#valor_"+nro_orc).html();
                var total = parseInt(nro_alunos) * parseFloat(valor_aluno);
                
                $("#total_"+nro_orc).html('<strong>'+converteFloatMoeda(total)+'</strong>');
                array_orc[aux].valor = ''+total;
                //console.log(array_orc);
            }
            aux_total = aux_total + parseFloat(array_orc[aux].valor);
        }
        //console.log('Total: ' + aux_total);
        total_orc = aux_total;
        $("#table_total").html(converteFloatMoeda(total_orc));
    };
</script>