<div class="text-center">
    <h3>Editar Análise Preliminar de Risco - APR</h3>
    <?php if ($this->session->flashdata('unchecked')) { ?>
        <div class="alert alert-success alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>ATENÇÃO!</strong> Erro ao editar o relatório.
        </div>
    <?php } ?>
</div>
<!-- class="form-horizontal"  -->
<form id="form_edit_apr" method="post" action="<?php echo site_url('relatorio_painel/salvar_edit_pcmat'); ?>">
<div class="form-row">
    <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8">
        <div class="col-md-12">
            <div class="form-group">
                <label for="idrel" class="control-label col-md-4">Código:</label>
                <div class="col-md-8">
                    <input readonly type="text" class="form-control" id="idrel" name="idrel" value="<?php echo $relatorio->id;?>">
                </div>
            </div>
            <div class="form-group">
                <label for="cliente">Selecione o Cliente</label>
                <select class="form-control" id="cliente" name="cliente">
                    <option value="<?php echo $relatorio->id_cliente ?>"><?php echo $relatorio->empresa ?></option>
                    <?php foreach ($clientes as $client) { ?>
                        <option value="<?php echo $client->id ?>"><?php echo $client->empresa; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="obra" class="control-label col-md-4">Função:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="obra" name="obra" placeholder="Função" value="<?php echo $relatorio->obra;?>">
                </div>
            </div>
            <div class="form-group">
                <label for="local" class="control-label col-md-4">Unidade:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="local" name="local" placeholder="Unidade" value="<?php echo $relatorio->local;?>">
                </div>
            </div>
            <div class="form-group">
                <label for="observacoes" class="control-label col-md-4">Área:</label>
                <div class="col-md-8">
                    <textarea class="form-control" id="obs" name="obs" placeholder="Observações da Obra" rows="3"><?php echo $relatorio->observacoes;?>
                    </textarea>
                </div>
            </div>        
            <div class="form-group">
                <label for="nometst" class="control-label col-md-4">TST:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="nometst" name="nometst" placeholder="Nome do TST" value="<?php echo $relatorio->tst_name;?>">
                </div>
            </div>
            <div class="form-group">
                <label for="data_rel" class="control-label col-md-4">Data:</label>
                <div class="col-md-8">
                    <input type="date" class="form-control" id="data_rel" name="data_rel" placeholder="Data" value="<?php echo $relatorio->data;?>">
                </div>
            </div>
            <div class="form-group">
                <label for="rev" class="control-label col-md-4">REV:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="rev" name="rev" placeholder="Rev." value="<?php echo $array_info->rev;?>">
                </div>
            </div>
            <div class="form-group">
                <label for="aprov_area" class="control-label col-md-4">Aprovador da Área:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="aprov_area" name="aprov_area" placeholder="Aprovador da Área" value="<?php echo $array_info->aprov_area;?>">
                </div>
            </div>
            <div class="form-group">
                <label for="aprov_seg" class="control-label col-md-4">Aprovador da Segurança:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="aprov_seg" name="aprov_seg" placeholder="Aprovador da Segurança" value="<?php echo $array_info->aprov_seg;?>">
                </div>
            </div>
            
        </div>
    </div>
    <div class="form-row col-md-12">
            <div style="text-align:center;" class="form-group col-md-3">
                <label for="atividades">Atividades:</label>
                <!-- <div class="col-md-8"> -->
                <textarea class="form-control" id="atividades" name="atividades" placeholder="Etapas das Tarefas" rows="14"><?php echo $array_info->atividades;?>
                    </textarea>
                <!-- </div> -->
            </div>
            <div style="text-align:center;" class="form-group col-md-3">
                <label for="riscos">Riscos:</label>
                <!-- <div class="col-md-8"> -->
                <textarea class="form-control" id="riscos" name="riscos" placeholder="O que poderá sair errado" rows="14"><?php echo $array_info->riscos;?>
                    </textarea>
                <!-- </div> -->
            </div>
            <div style="text-align:center;" class="form-group col-md-6">
                <label for="medidas">Medidas Preventivas / Recomendações:</label>
                <!-- <div class="col-md-8"> -->
                <textarea class="form-control" id="medidas" name="medidas" placeholder="O que poderá sair errado" rows="14"><?php echo $array_info->medidas;?>
                    </textarea>
                <!-- </div> -->
            </div>
    </div>
    <div class="col-md-12 col-sm-12 text-center">
        <button class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Salvar</button>
        <a href="javascript:history.back()" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</a>
    </div>
    
</form>


<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script src="<?php echo base_url('js/bootstrap-maxlength.min.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery.maskedinput.min.js'); ?>"></script>
<script src="<?php echo base_url('js/bootbox.min.js'); ?>"></script>

<script>
// just for the demos, avoids form submit

    $("#form_edit_cliente").validate({
        rules: {
            cliente: {
                required: true
            },
            obra: {
                required: true
            },
            local: {
                required: true
            },
            data: {
                required: true
            },
            nometst: {
                required: true
            }
        },
        messages: {
            cliente: {
                required: 'É obrigatório incluir o cliente'
            },
            obra: {
                required: 'É obrigatório incluir o nome da obra'
            },
            local: {
                required: 'É obrigatório incluir o local da obra'
            },
            data: {
                required: 'É obrigatório incluir a data do relatório'
            },
            nometst: {
                required: 'É obrigatório definir o responável do relatório'
            }
        }
    });
</script>

<script>
    var array_rel = [];

     $("#form_edit_apr").submit(function (e) {
        e.preventDefault();
        var input = $("<input>").attr("type", "hidden").attr("name", "count_rel").val(array_rel.length);
        jQuery(this).append(input);
        var postData = jQuery(this).serialize();
        $.ajax(
                {
                    url: "<?php echo site_url('relatorio_painel/salvar_edit_pcmat') ?>",
                    type: "POST",
                    data: postData,
                    dataType: "json",
                    success: function (dados)
                    {
                        console.log(dados);
                        if (dados.msg == true) {
                            salvareditApr(postData);
                        } else {
                            bootbox.alert('É necessário preencher todos os campos');
                        }
                    },
                    error: function ()
                    {
                        alert('Erro ao editar este relatorio!');
                    }
                });
    });
</script>

<script>
    var array_rel = [];

     function salvareditApr(postData){
        $.ajax(
            {
                url: "<?php echo site_url('relatorio_painel/salvar_edit_apr') ?>",
                type: "POST",
                data: postData,
                dataType: "json",
                success: function (dados)
                {
                    console.log(dados);
                    if (dados.msg == true) {
                        bootbox.alert('Relatório editado com sucesso', function(){
                        history.back();
                        });
                    } else {
                        bootbox.alert('É necessário preencher todos os campos');
                    }
                },
                error: function (xhr)
                {
                    console.log(xhr.responseText);
                }
            });
    };
</script>