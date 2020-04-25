

<hr>

<div class="row">

    <h3 class="text-center">DDS Nº <?php echo ($nro_relatorio); ?></h3>

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
                    <th colspan="5" class="text-center">DIÁRIO DIÁLOGO DE SEGURANÇA</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
