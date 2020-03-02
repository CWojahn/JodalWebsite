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

<form class = "form-row">
    <div class="row">
        <div class ="form-group col-md-6">
            <label for="obra">Obra</label>
            <input type="text" id="obra" name="obra" class ="form-control">
        </div>
        <div class ="form-group col-md-6">
            <label for="local">Local</label>
            <input type="text" id="local" name="local" class ="form-control">
        </div>
        
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="obs">Observações</label>
            <textarea class="form-control" id="obs" name="obs"
                placeholder="Observações da Obra" rows="4"></textarea>
        </div>
        <div class="form-group col-md-6">
            <label for="nome_tst">Nome do TST</label>
            <input type="text" id="nome_tst" name="nome_tst" class ="form-control">
            <label for="data_rel">Data</label>
            <input type="date" id="data_rel" name="data_rel" class ="form-control">
        </div>
    </div>
</form>
<form class="form-row" id="form_nova_imagem" style="margin-bottom: 15px;">     
    <div class ="form-group col-md-4">
        <label for="imagem">Imagem</label>
        <input type="file" id="imagem" name="imagem"
        onchange="PreviewImage_pt();" accept="image/*" capture="camera" class="form-control-file">
    </div>
    <div class="form-group col-md-2">
        <img id="uploadPreview_pt" style="width: 150px; height: 125px;" />
    </div>
    <div class="form-group col-md-4">
        <label for="descricao">Descrição</label>
        <textarea class="form-control" id="descricao" name="descricao"
        placeholder="Descrição da Imagem" rows="4"></textarea> 
    </div>
    <div class="col-md-12 col-sm-12 text-center">
        <button class="btn btn-success" data-loading-text="Incluindo..." id="btn_upload" type="submit"><span class="glyphicon glyphicon-plus"></span> Acrescentar Imagem</button>
    </div>
</form>

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
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 text-center">
        <button id="btn_save" class="btn btn-success" onclick="SalvarRelatorio()"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar Relatório</button>
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

    $(document).ready(function(){
        $('#form_nova_imagem').submit(function(e){
            e.preventDefault(); 
            $.ajax({
                url:'<?php echo site_url('relatorio_painel/do_upload') ?>',
                type:"post",
                data:new FormData(this),
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success: function(dados){
                    $('#imagensadicionadas').append(dados);
                    $("#imagem").val(null)
                    $("#descricao").val(null)
                    //$('#uploadPreview_pt').removeAttr('src')
                    $('#uploadPreview_pt').hide();
                }
            });
        });
    });

    function excluir(id){
        document.getElementById("linha"+id).remove();     
    };

    function PreviewImage_pt() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("imagem").files[0]);

        oFReader.onload = function (oFREvent) {
            $('#uploadPreview_pt').show();
            document.getElementById("uploadPreview_pt").src = oFREvent.target.result;
        };
    };



    function teste(){
        let tabledata = new Array();
            $("#imagensadicionadas tr").each(function (row,tr) {
                tabledata[row]= {
                    'imagemsrc' : $(this).find("td").eq(0).find("img").attr('src'),
                    'descricao' :  $(this).find("td").eq(1).find("textarea").val()
                }
            });
        console.log(tabledata);
    };


    function SalvarRelatorio(){
        
        $.ajax(
                {
                    url: "<?php echo site_url('relatorio_painel/salvar') ?>",
                    type: "POST",
                    data: {cliente: document.getElementById("cliente").value, obra: document.getElementById("obra").value, data: document.getElementById("data_rel").value, local: document.getElementById("local").value, tst: document.getElementById("nome_tst").value, obs: document.getElementById("obs").value},
                    datatype: "json",
                    async:false,
                    success: function(dados){
                        salvarPcmat(dados);
                    },
                    error: function(){
                        alert('erro');
                    }
                }
        );
    };

function salvarPcmat(dados) {
    let countrows =0;
    let count =0;
    $("#imagensadicionadas tr").each(function (row,tr) {
        $.ajax(               
            {
                url: "<?php echo site_url('relatorio_painel/salvarImagensPcmat') ?>",
                type: "POST",
                data: {image_path : $(this).find("td").eq(0).find("img").attr('src'),
                    observacao :  $(this).find("td").eq(1).find("textarea").val(), 
                    id_relatorio : dados},
                datatype: "json",
                async:false,
                success: function(dados){
                    console.log('Imagem ' + row + ' foi cadastrada');
                    count = count+1;
                },
                error: function(){
                    alert('erro');
                }
        });
        countrows = countrows +1;
    });

    if (count == countrows) {
        alert('Todas as imagens foram cadastradas com sucesso.');
    }
};

</script>