<div class="text-center">
    <?php if ($this->session->flashdata('error')) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php } ?>
</div>
<div class="text-center">
    <h3>Dados do Relatório</h3>
</div>
<form class="col-md-12 col-sm-12 text-center">
    <div >
    <div class="form-row">
        <label for="obra">Obra</label>
        <input type="text" id="obra" name="obra" class ="form-control">
    </div>
    <div class="form-row">
        <label for="local">Local</label>
        <input type="text" id="local" name="local" class ="form-control">
    </div>
    <textarea class="form-control" id="obs" name="obs"
            placeholder="Observações da Obra" rows="3"></textarea>
            </div>
</form>

<form id="form_nova_imagem" method="post" action="<?php echo site_url('relatorio_painel/salvarImagens'); ?>" enctype="multipart/form-data" >
    <div class="form-row" style="margin-bottom: 10px;">
        <label for="imagem">Imagem</label>
        <input type="file" id="imagem" name="imagem"
            onchange="PreviewImage_pt();" accept="image/*" capture="camera" class="form-control-file">
        <label for="descricao">Descrição</label>
        <textarea class="form-control" id="descricao" name="descricao"
            placeholder="Descrição da Imagem" rows="4"></textarea> 
    </div>
    <button class="btn btn-success" data-loading-text="Incluindo..." id="btn_add"><span class="glyphicon glyphicon-plus"></span> Acrescentar Imagem</button>
</form>

<table>
    <tbody id="table_relatorio">
        <thead>
            <tr>
                <th class="text-center">Imagem</th>
                <th class="text-center">Descrição</th>
            </tr>
        </thead>
        <tbody id="table_images">



        </tbody>


    </tbody>
</table>
<div class="row">
    <div class="col-md-offset-3 col-md-6" id="result_imagens">
        <!-- <img id="uploadPreview_pt" style="width: 150px; height: 125px;" /> -->
        
    </div>
</div>

<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script>
// just for the demos, avoids form submit

                $("#form_nova_imagem").validate({
                    rules: {
                        imagem: {
                            required: true
                        },
                        descricao: {
                            required: true
                        }
                    },
                    messages: {
                        imagem: {
                            required: 'É obrigatório incluir uma imagem.'
                        },
                        descricao: {
                            required: 'É obrigatório uma descrição da imagem.'
                        }
                    }

                });
</script>

<script type="text/javascript">
    var array_rel = [];
    $("#form_nova_imagem").submit(function (e) {
        console.log(document.getElementById("imagem").files[0]);
        e.preventDefault();
        $("#btn_add").addClass('disabled');        
        $.ajax(
                {
                    url: "<?php echo site_url('relatorio_painel/acrescentar_imagem') ?>",
                    type: "POST",
                    data: {imagem: document.getElementById("imagem").files[0].name, 
                        descricao: document.getElementById("descricao").value},
                    
                    dataType: "json",                    
                    success: function (dados)
                    {
                        
                        if (dados.msg == true) {
                            var aux = {imagem: dados.image_path, descricao: dados.descricao};
                            array_rel.push(aux);
                            console.log(array_rel);
                            $("#table_images").append(dados.page);
                            //$('html,body').animate({scrollTop: $("#result").offset().top}, 'slow');
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
                        alert('Erro ao incluir nova imagem!');
                    }
                });
    });


    function PreviewImage_pt() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("imagem").files[0]);

        // oFReader.onload = function (oFREvent) {
        //     document.getElementById("uploadPreview_pt").src = oFREvent.target.result;
        //};
    }
    ;
</script>
