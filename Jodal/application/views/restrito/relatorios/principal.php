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
    <div class="row" style="margin-bottom:25px">
        <form id="form_filter_report" method="post">
            <div class="col-md-12 col-sm-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cliente">Selecione o Cliente</label>
                        <select class="form-control" id="cliente" name="cliente">
                            <option value="-1">Escolha um Cliente</option>
                            <?php foreach ($clientes as $client) { ?>
                                <option value="<?php echo $client->id ?>">
                                <?php echo $client->empresa; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="tipo_relatorio">Selecione um formulário</label>
                    <select class="form-control" id="tipo_relatorio" name="tipo_relatorio">
                        <option value="-1">Escolha um formulário</option>
                        <option value="0">Programa de Gestão e Risco</option>
                        <option value="1">Relatório de Inspeção de Segurança</option>
                        <option value="2">Análise Preliminar de Risco</option>
                        <option value="3">Documento de Segurança do Trabalho</option>
                    </select>
                </div>
                <div class="col-md-12 col-sm-12 text-center" style="margin-top:10px">
                    <a class="btn btn-success" id="buscar"><span class="glyphicon glyphicon-filter"></span> Buscar</a>
                    <a class="btn btn-default" onClick="clearfilter()"><span class="glyphicon glyphicon-erase"></span> Limpar Filtro</a>
                </div>
            </div>
        </form>
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
                    <th class="text-center" style="width: 20%;">Ação</th>
                    <th class="text-center" style="width: 5%;">Número</th>
                    <th class="text-center" style="width: 5%;">Data</th>
                    <th class="text-center" style="width: 20%;">Obra</th>
                    <th class="text-center" style="width: 5%;">Local</th>
                    <th class="text-center" style="width: 35%;">Cliente</th>
                    <th class="text-center" style="width: 10%;">Tipo de Relatório</th>


                </tr>
            </thead>

            <tbody id="filtrado">
            </tbody>

            <tbody id="sem_filtro">
                <?php setlocale(LC_ALL, 'pt_BR'); ?>
                <?php
                if (isset($relatorios)) {
                    foreach ($relatorios as $relatorio) {
                        ?>
                        <tr>
                            <td class="text-center" style="width: 20%;">
                                <a onclick="gerapdf(<?php echo $relatorio->id;?>, '<?php echo $relatorio->tipo;?>')" class="btn btn-success" title="Imprimir" target="_blank"><span class="glyphicon glyphicon-print"></span></a>
                                <a onclick="enviar(<?php echo $relatorio->id;?>, '<?php echo $relatorio->email;?>');" class="btn btn-success" title="Enviar" style="cursor: pointer"><span class="glyphicon glyphicon-envelope"></span></a>                                
                                <a onclick="excluir(<?php echo $relatorio->id; ?>);" style="cursor: pointer;" class="btn btn-danger" title="Excluir"><span class="glyphicon glyphicon-remove"></span> </a>
                            </td>
                            <td class="text-center" style="width: 5%;"><?php echo $relatorio->id; ?></td>
                            <td class="text-center" style="width: 5%;"><?php echo date("d/m/Y", strtotime($relatorio->data)); ?></td>
                            <td class="text-center" style="width: 20%;"><?php echo $relatorio->obra; ?></td>
                            <td class="text-center" style="width: 5%;"><?php echo $relatorio->local; ?></td>
                            <td class="text-center" style="width: 35%;"><?php echo $relatorio->empresa; ?></td>
                            <td class="text-center" style="width: 10%;"><?php echo $relatorio->tipo; ?></td>
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

        bootbox.prompt("Digite o e-mail para onde devemos enviar o relatório.", function (result) {
            console.log(result);
            if (result) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('relatorio_painel/enviar_email'); ?>",
                    data: {id: id, email_prompt: result},
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

    $('#buscar').on('click', function () {
        
        var tipo_relatorio = document.getElementById("tipo_relatorio").value;
        var cliente = document.getElementById("cliente").value;
        if(tipo_relatorio != -1 && cliente != -1){
            $('#form_filter_report').removeAttr('disabled');
            $.ajax(
                {
                url: "<?php echo site_url('relatorio_painel/filter') ?>",
                type: "POST",
                data: {id: cliente, tipo: tipo_relatorio},
                    //dataType: "json",
                success: function (dados)
                    {
                        console.log('ok');
                        document.getElementById("sem_filtro").style.display = "none";
                        $("#filtrado").html(dados);
                    },
                error: function (jqXhr, textStatus, errorThrown )
                    {
                        console.log(textStatus );
                    }
                }
            );
        }
    });


    function gerapdf(id, tipo){
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('relatorio_painel/gerar_relatorio') ?>",
            data: {id: id, tipo: tipo},
            dataType: 'json',
            success: function (dados) {
                console.log(dados);
                openpdf(dados);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.responseText);
                openpdf(xhr.responseText);
            }
        });
    };
    
    function openpdf(dados) {
        window.open("http://www.jodaltreinamentos.com/jodal/uploads/relatorios/pdf/" + dados, "_blank");
    };

    function clearfilter(){
        //e.preventDefault();
        //document.getElementById("filtrado").style.display = "none";//"none";
        //document.getElementById("sem_filtro").style.visibility = "initial";//"none";
        location.reload();
    }
</script>