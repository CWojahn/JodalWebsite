<div class="container-fluid" style="border-top: 10px solid #003232; margin-top: 30px;">

</div>
<div class="container" style="background-color: #FFF; min-height: 400px; ">

    <h2><?php echo $header; ?></h2>
    <?php foreach ($parceiros as $parceiro) { ?>
    <div class="col-sm-6 col-md-3" style="height: 280px;">
            <div class="center-block">
                <a target="_blank" href="<?php echo 'http://' . $parceiro->site; ?>">
                    <img class="img-thumbnail center-block" data-src="holder.js/100%x200" alt="100%x200" src="<?php echo base_url('uploads/parceiros/' . $parceiro->logo); ?>" data-holder-rendered="true" style="height: 200px; width: 200px; display: block;">
                </a>
            </div>
            <div>
                <h3 class="text-center" style="margin-top: 10px;"><?php echo $parceiro->nome ?></h3>
            </div>

        </div>
    <?php } ?>
    

</div>


