

<hr>

<div class="row">

    <h3 class="text-center">RELATÓRIO Nº <?php echo ($nro_relatorio) . '/' . date('y', strtotime($data)) . ' - ' . date('d/m/Y', strtotime($data)) . ' - ' . $sel_cliente->empresa; ?></h3>

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
        <table class="table table-striped">
            <thead>
                <tr>
                    <th colspan="5" class="text-center">RESUMO DO ORÇAMENTO</th>
                </tr>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">TREINAMENTO</th>

                    <th class="text-center">Nº Alunos</th>

                    <th class="text-center">VALOR POR ALUNO(R$)</th>

                    <th class="text-center">#</th>

                    <th class="text-center">TOTAL</th>

                </tr>

            </thead>

            <tfoot>

                <?php setlocale(LC_ALL, 'pt_BR'); ?>

                <tr class="success">

                    <td></td>

                    <td></td>

                    <td></td>

                    <td><strong>TOTAL</strong></td>

                    <td></td>

                    <td id="table_total" style="font-weight: bold"><span></span></td>

                </tr>

            </tfoot>

            <tbody id="table_orc">



            </tbody>

        </table>

        <textarea id="orc_obs" name="orc_obs" class="form-control" rows="3" placeholder="Digite aqui observações gerais do orçamento"></textarea>

    </div>

</div>



<div class="row">

    <div class="col-md-12 col-sm-12 text-center">

        <button id="btn_save" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>

        <!--<button class="btn btn-success disabled" id="btn_add"><span class="glyphicon glyphicon-plus"></span> Add treinamento</button>

        <a href="#" class="btn btn-warning"><span class="glyphicon glyphicon-print"></span> Imprimir</a>-->

    </div>

</div>

<script>

    $('#btn_save').click(function () {

        //console.log('Valor total: ' + total_orc);

        //console.log(array_orc);

        $("#btn_save").addClass('disabled');

        var json_obj = JSON.stringify(array_orc);

        $.ajax(

                {

                    url: "<?php echo site_url('cotacao_painel/salvar_orcamento') ?>",

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

</script>