<div class="row">
    <h2 class="text-center">Editar categoria</h2>
</div>

<div>
    <?php if ($this->session->flashdata('error')) { ?>
        <div class="alert alert-danger alert-dismissible text-center" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php } ?>
    <form id="form_nova" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo site_url('acessoria_painel/categ_editar_submit'); ?>">
        <input id="id_categ" name="id_categ" value="<?php echo $categoria->id; ?>" hidden>
        <div class="form-group">
            <label for="categoria" class="control-label col-md-4">Nome:</label>
            <div class="col-md-5">
                <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Digite aqui o nome da categoria" value="<?php echo $categoria->nome; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4" for="banner_home">Banner Home</label>
            <div class="col-md-7">
                <input type="file" class="form-control" id="banner_home" name="banner_home" onchange="PreviewImage(this);" accept="image/*">
            </div>
            <div class="text-center">
                <img id="banner_home_img" style="width: 150px; height: 150px; margin-top: 10px;" src="<?php echo base_url('uploads/acessoria/categoria/home/' . $categoria->banner_home); ?>" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4" for="banner">Banner:</label>
            <div class="col-md-7">
                <input type="file" class="form-control" id="banner" name="banner" accept="image/*" onchange="PreviewImage(this);">
            </div>
            <div class="text-center">
                <img id="banner_img" src="<?php echo base_url('uploads/acessoria/categoria/' . $categoria->banner); ?>" style="width: 100%; margin-top: 10px;">
            </div>
        </div>
        <div class="text-center">
            <button class="btn btn-primary">Salvar</button>
        </div>    
    </form>
</div>
<script>
    function PreviewImage(elem) {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(elem.files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById(elem.id + "_img").src = oFREvent.target.result;
        };
    }
    ;

</script>