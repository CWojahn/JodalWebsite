<div class="container-fluid" style="border-top: 10px solid #003232; margin-top: 30px;">

</div>
<div class="container" style="background-color: #FFF; min-height: 400px; ">

    <h2><?php echo $header; ?></h2>
    <?php foreach ($materiais as $material) { ?>
    <div class="col-sm-4 col-md-3" style="height: 170px;">
            <div class="center-block">
                <a target="_blank" href="<?php echo base_url('uploads/acessoria/material/' . $material->arquivo); ?>">
                    <?php
                    $path_parts = pathinfo(APPPATH . 'uploads/acessoria/material/' . $material->arquivo);
                    switch ($path_parts['extension']) {
                        case "pdf":
                            echo "<img class='center-block' src=". base_url() . "img/pdf-icon.png style='height: 72px; width: 72px;'>";
                            break;
                        case "doc":
                            echo "<img class='center-block' src=". base_url() . "img/doc.png style='height: 72px; width: 72px;'>";
                            break;
                        case "docx":
                            echo "<img class='center-block' src=". base_url() . "img/doc.png style='height: 72px; width: 72px;'>";
                            break;
                        case "xls":
                            echo "<img class='center-block' src=". base_url() . "img/xlsx.png style='height: 72px; width: 72px;'>";
                            break;
                        case "xlsx":
                            echo "<img class='center-block' src=". base_url() . "img/xlsx.png style='height: 72px; width: 72px;'>";
                            break;

                        case NULL: // Handle no file extension
                            break;
                    }
                    ?>
                    <h3 class="text-center"><?php echo $material->nome ?></h3>
                </a>
            </div>

        </div>
    <?php } ?>


</div>


