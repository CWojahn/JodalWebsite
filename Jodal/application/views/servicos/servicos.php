<?php foreach ($servicos as $servico) {?>
<div class="media">
    <div class="media-left media-middle">
        <a href="#">
            <img class="media-object" alt="64x64" src="<?php echo base_url('uploads/servicos/'. $servico->imagem); ?>" data-holder-rendered="true" style="width: 150px; height: 150px;">
        </a>
    </div>
    <div class="media-body">
        <h3 class="media-heading"><?php echo $servico->nome; ?></h3>
        <p><?php echo $servico->descricao; ?></p>
        
    </div>
</div>
<?php } ?>