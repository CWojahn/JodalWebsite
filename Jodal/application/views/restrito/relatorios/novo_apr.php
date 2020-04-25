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
<div>
<form>
    <div class = "form-row">
        <div class ="form-group col-md-4">
            <label for="obra">Função</label>
            <input type="text" id="obra" name="obra" class ="form-control">
            <label for="data_rel">Data</label>
            <input type="date" id="data_rel" name="data_rel" class ="form-control">            
            <label for="nome_tst">TST</label>
            <input type="text" id="nome_tst" name="nome_tst" class ="form-control">
            
        </div>
        <div class ="form-group col-md-4">
            <label for="local">Unidade</label>
            <input type="text" id="local" name="local" class ="form-control">
            <label for="obs">Área</label>
            <input type="text" id="obs" name="obs" class ="form-control">
            <label for="aprov_area">Aprovador da área</label>
            <input type="text" id="aprov_area" name="aprov_area" class ="form-control">
        </div>
        <div class="form-group col-md-4">
            <label for="rev">Revisão</label>
            <input type="text" id="rev" name="rev" class ="form-control">
            <label for="aprov_seg">Aprovador da segurança</label>
            <input type="text" id="aprov_seg" name="aprov_seg" class ="form-control">
        </div>
    </div>
    <div class="form-row">
      <div style="text-align:center;" class="form-group col-md-3">
        <label for="atividades">ATIVIDADES<br><span style="font-size: 10px;">(Etapas da Tarefas)</span></label>
        <textarea class="form-control" id="atividades" name="atividades"
              placeholder="ATIVIDADES" rows="16"></textarea>
      </div>
      <div style="text-align:center;" class="form-group col-md-3">
        <label for="riscos">RISCO POTENCIAL<br><span style="font-size: 10px;">(O que poderá sair errado)</span></label>
        <textarea class="form-control" id="riscos" name="riscos"
              placeholder="RISCO POTENCIAL" rows="16"></textarea>
      </div>
      <div style="text-align:center;" class="form-group col-md-6">
        <label for="medidas">MEDIDAS PREVENTIVAS / RECOMENDAÇÕES<br><span style="font-size: 10px;">(Evita o acidente ou minimiza danos caso ocorra)</span></label>
        <textarea class="form-control" id="medidas" name="medidas"
              placeholder="MEDIDAS PREVENTIVAS / RECOMENDAÇÕES" rows="16"></textarea>
      </div>
    </div>
    <!-- <div class="col-md-12 col-sm-12 text-center">
        <form id="form_nova_imagem" style="margin-bottom: 15px;">   
            <div class ="col-md-4">
                <label for="imagem">Imagem</label>
                <input type="file" id="imagem" name="imagem"
                onchange="PreviewImage_pt();" accept="image/*" capture="camera" class="form-control-file">
            </div>
            <div class="col-md-2">
                <img id="uploadPreview_pt" style="width: 150px; height: 125px;" />
            </div>
            <div class="col-md-4">
                <label for="descricao">Observação</label>
                <textarea class="form-control" id="descricao" name="descricao"
                placeholder="Observação" rows="4"></textarea> 
            </div>
            <div class="col-md-12 col-sm-12 text-center">
                <button class="btn btn-success" data-loading-text="Incluindo..." id="btn_upload" type="submit"><span class="glyphicon glyphicon-plus">				</span> Acrescentar Imagem</button>
            </div>
        </form>
    </div>
    <div id="imagens1">
        <hr>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th style="text-align: center">Imagem</th>
                    <th style="text-align: center">Observação</th>
                    <th style="text-align: center">Excluir</th>
                </tr>
            </thead>
            <tbody id="imagensadicionadas">
            </tbody>
        </table>
    </div>    -->
    <div class="col-md-12 col-sm-12 text-center">
        <button class="btn btn-success" data-loading-text="Incluindo..." id="btn_save"  onclick="SalvarRelatorio()"><span class="glyphicon glyphicon-plus"></span>Salvar</button>
    </div>
</form>
</div>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>

<script>
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
    function SalvarRelatorio(){
        
        $.ajax(
                {
                    url: "<?php echo site_url('relatorio_painel/salvar') ?>",
                    type: "POST",
                    data: {cliente: document.getElementById("cliente").value, obra: document.getElementById("obra").value, data: document.getElementById("data_rel").value, local: document.getElementById("local").value, tst: document.getElementById("nome_tst").value, obs: document.getElementById("obs").value, tipo: 'APR'},
                    datatype: "json",
                    async:false,
                    success: function(dados){
                      salvarapr(dados);
                    //   salvarPcmat(dados);
                    },
                    error: function(){
                        alert('erro');
                    }
                }
        );
    };

    function salvarapr(dados) {
        $.ajax(               
            {
                url: "<?php echo site_url('relatorio_painel/salvar_apr') ?>",
                type: "POST",
                data: {id_relatorio:dados,
                  aprov_area: document.getElementById("aprov_area").value, 
                  aprov_seg: document.getElementById("aprov_seg").value,
                  rev: document.getElementById("rev").value,
                  atividades: document.getElementById("atividades").value,
                  riscos: document.getElementById("riscos").value,
                  medidas: document.getElementById("medidas").value},
                datatype: "json",
                async:false,
                success: function(dados){
                   console.log(dados);
                },
                error: function(){
                    alert('erro');
                }
        });
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
<script type="text/javascript">


</script>