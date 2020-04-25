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
          <tr style="height: 75px;">
            <td style="width: 20%; height: 43px; text-align: center; vertical-align: middle;"><img src="<?php echo site_url('assets/img/logo_relatorio.jpg');?>" alt="" style="width: 75px;" srcset=""></td>
            <td style="width: 50%; height: 43px; text-align: center; vertical-align: middle;">APR - Análise Preliminar de Risco</td>
            <td style="width: 15%; height: 15px;">Nº <?php echo $relatorio->id; ?></td>
          </tr>
        </tbody>
      </table>
      <div class="col-md-offset-3 col-md-6"
        style="border-style: solid;
          border-width: 1px;
          margin-top: 35px;
          padding: 0;" >
        <p class="text-uppercase" style="padding-left: 10px; padding-top: 10px">EMPRESA: <?php echo $relatorio->empresa?></p>
        <p class="text-uppercase" style="padding-left: 10px;">FUNÇÃO: <?php echo $relatorio->obra?></p>
        <p class="text-uppercase" style="padding-left: 10px;">UNIDADE: <?php echo $relatorio->local?></p>
        <p class="text-uppercase" style="padding-left: 10px;">ÁREA: <?php echo $relatorio->observacoes?></p>
        <p class="text-uppercase" style="padding-left: 10px;">REVISÃO: <?php echo $array_info->rev?></p>
        <p class="text-uppercase" style="padding-left: 10px;">DATA: <?php echo $relatorio->data?></p>
        <p class="text-uppercase" style="padding-left: 10px;">TST: <?php echo $relatorio->tst_name?></p>
        <p  style="color: #ffffff;
              background-color: #000000;
              text-align: center;
              font-size: 16px;
              padding-left: 0;
              padding-right: 0;
              padding-top: 5px;
              padding-bottom: 5px;
              margin-bottom: 0;"
        >Nenhuma tarefa é tão urgente que não pode ser planejada e executada com segurança!</p>
      </div>
    </div>
  <div class="row" style="margin-top: 30px;" >
    <table style="width: 100%;border-spacing: 0px;">
      <tbody>
        <tr>
          <tr style="text-align: center;
                     font-size: 16px;
                     font-weight:600;">
            <td style="border-bottom:0;">ATIVIDADES</td>
            <td style="border-bottom:0;">RISCO POTENCIAL</td>
            <td style="border-bottom:0;">MEDIDAS PREVENTIVAS / RECOMENDAÇÕES</td>
          </tr>
          <tr style="height: 15px; ">
            <td style="border-top:0;">(Etapas das Tarefas)</td>
            <td style="border-top:0;">(O que poderá sair errado)</td>
            <td style="border-top:0;">(Evita o acidente ou minimiza danos caso ocorra)</td>
          </tr>
          </tr>
          <?php
            $atividades = explode(';', $array_info->atividades);
            $riscos = explode(';', $array_info->riscos);
            $medidas = explode(';', $array_info->medidas);
            for ($i=0, $tamanho = count($atividades);$i < $tamanho; ++$i){
              echo '<tr>
                <td style="width: 30%; vertical-align:top; text-align: left; padding: 5px 5px">'.
                $atividades[$i] . '
                </td>
                <td style="width: 30%; vertical-align:top; text-align: left; padding: 5px 5px">'.
                $riscos[$i] . '</td>
                <td style="width: 40%; vertical-align:top; text-align: left; padding: 5px 5px">'.
                $medidas[$i] . '</td>
              </tr>';
            }
          ?>
          <!-- <tr>
            <td colspan="2">Foto</td>
            <td>Observação</td>
          </tr>
          <?php foreach ($array_images as $value) { ?>
            <tr>
              <td colspan="2">
                <img src="<?php echo $value->image_path;?>" alt="" srcset="" width="400px">
              </td>
              <td style="vertical-align: top;">
                Obs:<br>
                <?php echo $value->observacao; ?>
              </td>
            </tr>
          <?php } ?>  -->
      </tbody>
    </table>
  
    <table style="width: 100%;border-spacing: 0px;">
      <tr style="background-color: #888888; height: 40px;">
        <td >PREPARADA POR</td>
        <td >APROVAÇÃO DA ÁREA</td>
        <td >APROVAÇÃO DA SEGURANÇA</td>
      </tr>
      <tr style="height: 70px;">
      	<td style="width: 33%;">&nbsp;</td>
        <td style="width: 33%;">&nbsp;</td>
        <td style="width: 33%;">&nbsp;</td>
      </tr>
      <tr style="height: 23px;">
        <td class="text-uppercase" style="width: 33%; text-height:8px;">JODAL - <?php echo $relatorio->tst_name?></td>
        <td class="text-uppercase" style="width: 33%;">CONTRATANTE - <?php echo $array_info->aprov_area?></td>
        <td class="text-uppercase" style="width: 33%;">CONTRATANTE - <?php echo $array_info->aprov_seg;?></td>
        </tr>
      </tbody>
    </table>
  </div>
</html>