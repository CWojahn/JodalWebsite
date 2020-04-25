

<hr>

<div class="row">

    <h3 class="text-center">RELATÓRIO PGR Nº <?php echo ($nro_relatorio); ?></h3>

    <div class="col-md-offset-3 col-md-6">

        <div class="panel panel-default">

            <div class="panel-heading">

                <strong>CLIENTE</strong>

            </div>

            <div class="panel-body text-center">

                <p class="text-uppercase" style="font-weight: bold"><?php echo $sel_cliente->empresa . '. ' . $sel_cliente->razao_social . '. Fone: ' . $sel_cliente->telefone; ?></p>

                <p class="text-uppercase" style="font-weight: bold"><?php echo $sel_cliente->cnpj . ' - ' . $sel_cliente->responsavel; ?></p>

                <p class="text-uppercase" style="font-weight: bold"><?php echo $sel_cliente->endereco . ' - ' . $sel_cliente->bairro . ' - ' . $sel_cliente->cidade . ' - ' . $sel_cliente->cep; ?></p>

                <p class="" style="font-weight: bold"><?php echo $sel_cliente->site . ' - ' . $sel_cliente->email; ?></p>

            </div>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-offset-2 col-md-8">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th colspan="5" class="text-center">PROGRAMA GESTÃO DE RISCO</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- <div class="row">
    <div class="col-md-12 col-sm-12 text-center">
        <button id="btn_save" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>
    </div>
</div> -->

<!-- <script>

    $('#btn_save').click(function () {

        //console.log('Valor total: ' + total_orc);

        //console.log(array_orc);

        $("#btn_save").addClass('disabled');

        var json_obj = JSON.stringify(array_orc);

        $.ajax(

                {

                    url: "<?php echo site_url('relatorio_painel/salvar') ?>",

                    type: "POST",

                    data: {json_orc: json_obj, cliente: $("#cliente").val(), total: total_orc, observacao: $("#orc_obs").val()},

                    //dataType: "json",

                    success: function (dados)

                    {

                        //console.log(dados);

                        //console.log(dados.total);

                        // similar behavior as an HTTP redirect

                        $("#btn_save").removeClass('disabled');

                        if (dados == true) {

                            window.location.replace("http://www.jodaltreinamentos.com/jodal/cotacao_painel");

                        } else {

                            alert('Erro inesperado ao gerar orçamento!');

                        }





                    },

                    error: function ()

                    {

                        $("#btn_save").removeClass('disabled');

                        alert('Erro ao salvar orçamento');

                        console.log('ERROR');

                    }

                });

    });

</script> -->