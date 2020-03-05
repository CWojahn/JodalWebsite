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
  <form class="form-row">
        <div class ="form-group col-md-6">
            <label for="obra">Setor Especifico</label>
            <input type="text" id="obra" name="obra" class ="form-control">
            <label for="elaborado">Elaborador por</label>
            <input type="text" id="elaborado" name="elaborado" class ="form-control">
            <label for="email">E-mail que este relatório será enviado</label>
            <input type="text" id="email" name="email" class ="form-control">
            <label for="recomendacoes">Recomendações</label>
            <textarea class="form-control" id="recomendacoes" name="recomendacoes"
                placeholder="Recomendações" rows="4"></textarea>
            <div style="width:33%;">
            	<label for="data_prazo">Prazo</label>
            	<input type="date" id="data_prazo" name="data_prazo" class ="form-control">
            </div>
        </div>
        <div class ="form-group col-md-6">
          <div style="width:33%;">
            <label for="data_rel">Data</label>
            <input type="date" id="data_rel" name="data_rel" class ="form-control">
          </div>
          <label for="descricao">Descrição</label>
          <textarea class="form-control" id="descricao" name="descricao"
              placeholder="Descrição" rows="4"></textarea>
          <label for="asp_legal">Aspecto Legal</label>
          <textarea class="form-control" id="asp_legal" name="asp_legal"
              placeholder="Aspecto Legal" rows="3"></textarea>
        </div>
  </form>

<div class="form-row">
  <form id="form_nova_imagem" style="margin-bottom: 15px;">     
      <div class ="form-group col-md-6">
          <label for="imagem">Imagem</label>
          <input type="file" id="imagem" name="imagem"
          onchange="PreviewImage_pt();" accept="image/*" capture="camera" class="form-control-file">
      </div>
      <div class="form-group col-md-2">
          <img id="uploadPreview_pt" style="width: 150px; height: 125px;" />
      </div>
      <div class="col-md-12 col-sm-12 text-center">
          <button class="btn btn-success" data-loading-text="Incluindo..." id="btn_upload" type="submit"><span class="glyphicon glyphicon-plus"></span> Acrescentar Imagem</button>
      </div>
  </form>
</div>

<div id="imagens1">
<hr>
    <table class="table table-hover">
        <thead>
            <tr>
                <th style="text-align: center">Imagem</th>
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

    function SalvarRelatorio(){
        
        $.ajax(
                {
                    url: "<?php echo site_url('relatorio_painel/salvar') ?>",
                    type: "POST",
                    data: {cliente: document.getElementById("cliente").value, obra: document.getElementById("obra").value, data: document.getElementById("data_rel").value, tst: document.getElementById("elaborado").value, obs: document.getElementById("descricao").value,local: '', tipo: 'RIS'},
                    datatype: "json",
                    async:false,
                    success: function(dados){
                        salvarRis(dados);
                        salvarImagens(dados);
                    },
                    error: function(){
                        alert('erro');
                    }
                }
        );
    };

    function salvarRis(dados){
        
        $.ajax(
                {
                    url: "<?php echo site_url('relatorio_painel/salvar_ris') ?>",
                    type: "POST",
                    data: {email: document.getElementById("email").value, recomendacoes: document.getElementById("recomendacoes").value, data_prazo: document.getElementById("data_prazo").value, asp_legal: document.getElementById("asp_legal").value, id_relatorio : dados},
                    datatype: "json",
                    async:false,
                    success: function(dados){
                      alert('Relatório salvo com sucesso');
                    },
                    error: function(){
                        alert('erro');
                    }
                }
        );
    };


function salvarImagens(dados) {
    let countrows =0;
    let count =0;
    $("#imagensadicionadas tr").each(function (row,tr) {
        $.ajax(               
            {
                url: "<?php echo site_url('relatorio_painel/salvarImagensPcmat') ?>",
                type: "POST",
                data: {image_path : $(this).find("td").eq(0).find("img").attr('src'),
                      observacao:'', id_relatorio : dados},
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