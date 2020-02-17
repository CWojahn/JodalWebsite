<div class="row">
    <div class="row">
        <?php foreach ($treinamentos as $trein) { ?>
            <?php if ($trein->versao_pt == TRUE) { ?>
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img class="nocopy" data-src="holder.js/100%x200" alt="100%x200" src="<?php echo base_url('uploads/selos/' . $trein->selo_pt); ?>" data-holder-rendered="true" style="height: 170px; width: 170px; display: block;">
                        <div class="caption">
                            <h3 class="text-center" style="font-size: 16px; font-family: HandelGotDBol;"><?php echo $trein->nome_pt ?><a class="anchorjs-link" href="#thumbnail-label"><span class="anchorjs-icon"></span></a></h3>
                            <p class="text-center p-height"><?php echo $trein->descricao_curta_pt; ?></p>
                            <p class="text-center">
                                <a href="<?php echo site_url('treinamentos/detalhes/' . $trein->id) ?>" class="btn btn-jodal">SAIBA +</a>
                                <a href="<?php echo site_url('treinamentos/cotacao/' . $trein->id) ?>" class="btn btn-jodal">COTAR</a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img class="nocopy" data-src="holder.js/100%x200" alt="100%x200" src="<?php echo base_url('uploads/selos/' . $trein->selo_en); ?>" data-holder-rendered="true" style="height: 170px; width: 170px; display: block;">
                        <div class="caption">
                            <h3 class="text-center" style="font-size: 16px; font-family: HandelGotDBol;"><?php echo $trein->nome_en ?><a class="anchorjs-link" href="#thumbnail-label"><span class="anchorjs-icon"></span></a></h3>
                            <p class="text-center p-height"><?php echo $trein->descricao_curta_en; ?></p>
                            <p class="text-center">
                                <a href="<?php echo site_url('treinamentos/detalhes/' . $trein->id . '/en') ?>" class="btn btn-jodal">SEE +</a>
                                <a href="<?php echo site_url('treinamentos/cotacao/' . $trein->id . '/en') ?>" class="btn btn-jodal">QUOTE</a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php }
        }
        ?>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <a href="<?php echo site_url('treinamentos'); ?>"><img class="img-responsive" src="<?php echo base_url('img/009.png'); ?>"></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <h1 style="color: #003333"><span>Acesso Rápido</span></h1>
            <div class="media col-md-6 col-sm-12">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object" src="<?php echo base_url('img/002.png'); ?>" alt="..." style="width: 64px; height: 64px;">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Serviços</h4>
                    Conheça todos os serviços que prestamos.
                </div>
                <div class="text-right">
                    <a href="<?php echo site_url('servicos'); ?>" class="btn btn-jodal">SAIBA +</a>
                </div>
            </div>
            <div class="media col-md-6 col-sm-12">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object" src="<?php echo base_url('img/003.png'); ?>" alt="..." style="width: 64px; height: 64px;">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Parceiros</h4>
                    Veja quais são os nossos parceiros.
                </div>
                <div class="text-right">
                    <a href="<?php echo site_url('parceiros'); ?>" class="btn btn-jodal">SAIBA +</a>
                </div>
            </div>
            <div class="media col-md-6 col-sm-12">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object" src="<?php echo base_url('img/001.png'); ?>" alt="..." style="width: 64px; height: 64px;">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Cotação</h4>
                    Peça agora a cotação para sua empresa.
                </div>
                <div class="text-right">
                    <a href="<?php echo site_url('treinamentos/cotacao'); ?>" class="btn btn-jodal">SAIBA +</a>
                </div>
            </div>
            <div class="media col-md-6 col-sm-12">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object" src="<?php echo base_url('img/004.png'); ?>" alt="..." style="width: 64px; height: 64px;">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">E-mail</h4>
                    Tire suas dúvidas, entre em contato.

                </div>
                <div class="text-right">
                    <a href="<?php echo site_url('contato'); ?>" class="btn btn-jodal">SAIBA +</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <h1 style="color: #003333"><span>Nossa Visão</span></h1>
            <p class="text-center">
                Garantimos a você nosso cliente total qualidade nos cursos dirigidos por nossa equipe formada 
                pelos melhores funcionários na área.<br>
                Com o foco de passar pleno conhecimento aos colaboradores para que dentro de suas funções possam
                desempenhar seu papel na empresa, garantindo total segurança para as equipes de trabalho.<br>
                Para atender suas necessidades estamos em constante evolução, sempre planejando, investindo e
                inovando nossos meios para que possamos atender você nosso amigo e cliente com a melhor eficácia.
            </p>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.nocopy').bind('contextmenu', function (e) {
        return false;
    });
    $(".nocopy").mousedown(function () {
        return false;
    });
</script>