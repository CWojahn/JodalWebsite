<div class="text-center">
    <h3>Editar Relatório PCMAT & PGST</h3>
    <?php if ($this->session->flashdata('unchecked')) { ?>
        <div class="alert alert-success alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>ATENÇÃO!</strong> Erro ao editar o relatório.
        </div>
    <?php } ?>
</div>
<form id="form_edit_pcmat" class="form-horizontal" method="post" action="<?php echo site_url('relatorio_painel/salvar_edit_pcmat'); ?>">
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
        <div class="form-group">
            <label for="obra" class="control-label col-md-4">Obra:</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="obra" name="obra" placeholder="Obra" value="<?php echo $relatorio->obra;?>">
            </div>
        </div>
        <div class="form-group">
            <label for="local" class="control-label col-md-4">LOCAL:</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="local" name="local" placeholder="Local" value="<?php echo $relatorio->local;?>">
            </div>
        </div>
        <div class="form-group">
            <label for="observacoes" class="control-label col-md-4">Observações:</label>
            <div class="col-md-8">
                <textarea class="form-control" id="obs" name="obs" placeholder="Observações da Obra" rows="3">
                    <?php echo $relatorio->observacoes;?>
                </textarea>
            </div>
        </div>        
        <div class="form-group">
            <label for="nometst" class="control-label col-md-4">Nome do TST:</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="nometst" name="nometst" placeholder="Nome do TST" value="<?php echo $relatorio->nometst;?>">
            </div>
        </div>
        <div class="form-group">
            <label for="data_rel" class="control-label col-md-4">Data:</label>
            <div class="col-md-8">
                <input type="date" class="form-control" id="data_rel" name="data_rel" placeholder="Data" value="<?php echo $relatorio->data_rel;?>">
            </div>
        </div>
        <div id="imagens1">
            <hr>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="text-align: center">Imagem</th>
                        <th style="text-align: center">Descrição</th>
                        <th style="text-align: center">Excluir</th>
                    </tr>
                </thead>
                <tbody id="imagensadicionadas">
                    <?php foreach ($imagens as $imagem) { ?>
                        <tr id="linha<?php echo $imagem->$ids; ?>">
                            <td>
                                <img style="width: auto; height: 100px;" src="<?php echo $imagem->image_path; ?>"/>
                                </td> 
                            <td>
                                <textarea class="form-control" id="descricao" name="descricao"
                                    placeholder="Descrição da Imagem" rows="4"><?php echo $imagem->descricao; ?></textarea>
                            </td>
                            <td style="text-align: center;"><button class="btn btn-danger"  id="delete" onclick="excluirImagem(<?php echo $imagem->$ids; ?>)"><span class="glyphicon glyphicon-remove"></span> Excluir</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
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


    function excluirImagem(id) {
        bootbox.confirm("Tem certeza que deseja excluir a imagem do relatório?", function (result) {
            if (result) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('relatorio_painel/excluir_imagempcmat') ?>",
                    data: {id: id},
                    dataType: 'json',
                    success: function (dados) {
                        if (dados.msg == true) {
                            location.reload();
                        } else {
                            alert('Erro ao excluir imagem!');
                        }
                    },
                    error: function () {
                        alert('Erro ao excluir imagem!');
                    }
                });
            }
        });
    };
</script>