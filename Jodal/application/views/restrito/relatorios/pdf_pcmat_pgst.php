<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <htmlpageheader>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/styles.css'); ?>">
        <style type="text/css">

            @page {
                margin-top: 0.0cm;
                margin-bottom: 0.0cm;
                margin-left: 1.0cm;
                margin-right: 1.0cm;
                background-color:#ffffff;
            }
            
            html, body{
              font-family: Arial, Helvetica, sans-serif;
			}
            
            td{
              border: solid 1px #333;
              text-align: center;
              vertical-align: middle;
            }
            .text-uppercase {
              font-weight:600;
              font-size: 12px;
            }
            

            .emailsitem span{
              position: relative;
              left: -30%;
            }
        </style>
    </htmlpageheader>

    <?php setlocale(LC_ALL, 'pt_BR'); ?>
    <div class="row">
    <table style="border-spacing: 0px; width: 100%; border-color: 000; border: 1px">
      <tbody>
        <tr style="height: 20px;">
          <td style="width: 20%; height: 43px; text-align: center; vertical-align: middle;" rowspan="2"><img src="<?php echo base_url('assets/img/logo_relatorio.jpg');?>" alt="" style="width: 75px;" srcset=""></td>
          <td style="width: 50%; height: 43px; text-align: center; vertical-align: middle;" rowspan="2">Relatório fotográfico das <br> Melhorias a serem Implantadas no canteiro de obra.</td>
          <td style="width: 15%; height: 15px;">Nº <?php echo $relatorio->id; ?></td>
          <td style="width: 15%; height: 15px;">Página: {$1} de {$2}</td>
        </tr>
        <tr style="height: 20px;">
          <td style="width: 15%; height: 20px;">Classificação: Uso Interno</td>
          <td style="width: 15%; height: 20px;">Rev.: 00 - 27/04/2019</td>
        </tr>
      </tbody>
    </table>
      <div class="col-md-offset-3 col-md-6" style="border-style: solid; border-width: 1px;margin-top: 35px;" >
          <div class="panel panel-default">
            <div class="panel-body text-center">
                  <p class="text-uppercase" style="padding-left: 10px;">EMPRESA: <?php echo $relatorio->empresa?></p>
                  <p class="text-uppercase" style="padding-left: 10px;">OBRA: <?php echo $relatorio->obra?></p>
                  <p class="text-uppercase" style="padding-left: 10px;">LOCAL: <?php echo $relatorio->local?></p>
                  <p class="text-uppercase" style="padding-left: 10px;">TST-OBRA: <?php echo $relatorio->tst_name?></p>
                  <p class="text-uppercase" style="padding-left: 10px;">DATA: <?php echo $relatorio->data?></p>
                  <p  style="color: #ffffff;
                        background-color: #000000;
                        text-align: center;
                        font-size: 16px;
                        padding: 0.25em;
                        margin-bottom: 0;"
                  >PCMAT & PGST</p>
            </div>
          </div>
      </div>
    </div>
  </div>
  <div class="row" style="margin-top: 30px;" >
    <p style="font-size: 12px; font-weight: 600; padding-left: 10px;">RELATÓRIO VISUAL: - (X)</p>
    <table style="width: 100%;border-spacing: 0px;">
      <tbody>
      <tr style="background-color: #888888; height: 43px; font-weight: 600;">
        <td colspan="2">Foto/Imagem</td>
        <td >Ações Encontradas</td>
      </tr>
      <?php foreach ($array_images as $value) { ?>
                <tr>
                  <td colspan="2">
                  	<img src="<?php echo $value->image_path;?>" alt="" srcset="" width="400em">
                  </td>
                  <td style="vertical-align: top;">
                    APONTAMENTOS TÉCNICOS:<br>
                    <?php echo $value->observacao; ?>
                  </td>
                </tr>
              <?php } ?> 
      <tr style="background-color: #888888; height: 40px;">
        <td colspan="3">Observações</td>
      </tr>
      <tr style="height: 50px;">
        <td colspan="3"><?php echo $relatorio->observacoes; ?></td>
      </tr>
      <tr style="height: 23px;">
        <td style="width: 33%;">JODAL</td>
        <td style="width: 33%;">Observações: Documento encaminhar para email:</td>
        <td style="width: 33%;">&nbsp;</td>
      </tr>
      <tr style="height: 70px;">
        <td style="width: 33%;">&nbsp;</td>
        <td style="width: 33%;" rowspan="2"><?php echo $relatorio->email; ?></td>
        <td style="width: 33%;">&nbsp;</td>
      </tr>
      <tr style="height: 23px;">
        <td style="width: 33%;">PABLO M. DE MOURA MASTELLA</td>
        <td style="width: 33%; border-top: solid 1px #333">CONTRATANTE - <?php echo $relatorio->empresa?></td>
      </tr>
      </tbody>
    </table>
  </div>
</html>