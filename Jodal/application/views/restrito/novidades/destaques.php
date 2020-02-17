
<h3 class="text-center">ARTIGOS EM DESTAQUE</h3>
<div class="col-md-12 col-sm-12">

    <div class="col-md-5 col-sm-5">
        <div class="form-group col-md-12 col-sm-12">
            <label for="disp">Todos os Artigos do site</label>

            <div>
                <select id="art_disp" name="art_disp" class="dropdown-toggle form-control text-center" size="10">
                    <?php foreach ($artigos_disp as $prod_disp) { ?>
                        <option value="<?php echo $prod_disp->id ?>"><?php echo $prod_disp->nome; ?></option>     
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-2 col-sm-2 text-center">
        <div class="row"><br></div><div class="row"><br></div><div class="row"><br></div>
        <div class="row">
            <button id="bt_libera" class="btn btn-success" title="Adicionar artigo aos destaques do site"><span id="span_btn" class="glyphicon glyphicon-forward"></span></button>
        </div>
        <br>
        <div class="row">
            <button id="bt_remove" class="btn btn-danger" title="Remover artigo dos destaques"><span id="span_btn" class="glyphicon glyphicon-remove"></span></button>
        </div>
    </div>

    <div class="col-md-5 col-sm-5">
        <div id="vers_liberadas" class="form-group col-md-12 col-sm-12"><div><label for="serv_destaques">Artigos em destaque</label>
                <select id="art_destaques" name="art_destaques" class="dropdown-toggle form-control text-center" size="10">
                    <?php foreach ($artigos_dest as $prod_dest) { ?>
                        <option value="<?php echo $prod_dest->id ?>"><?php echo $prod_dest->nome;?></option>     
                    <?php } ?>
                </select></div></div>
    </div>
</div>

<script type="text/javascript">

    $("#bt_libera").click(function() {
        $.ajax(
                {
                    url: "<?php echo site_url('novidades_painel/set_destaque') ?>",
                    type: "POST",
                    data: {id: $("#art_disp").val()},
                    success: function(dados)
                    {
                        $('#art_destaques').html(dados);
                    },
                    error: function()
                    {
                        console.log('ERROR');
                    }
                });
    });
    
    $("#bt_remove").click(function() {
        $.ajax(
                {
                    url: "<?php echo site_url('novidades_painel/remove_destaque') ?>",
                    type: "POST",
                    data: {id: $("#art_destaques").val()},
                    success: function(dados)
                    {
                        $('#art_destaques').html(dados);
                    },
                    error: function()
                    {
                        console.log('ERROR');
                    }
                });
    });

</script>