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
          <td style="width: 20%; height: 43px; text-align: center; vertical-align: middle;"><img src="<?php echo base_url('assets/img/logo_relatorio.jpg');?>" alt="" style="width: 75px;" srcset=""></td>
          <td style="width: 50%; height: 43px; text-align: center; vertical-align: middle;">Documento de Segurança do Trabalho</td>
          <td style="width: 15%; height: 15px;">Nº <?php echo $relatorio->id; ?></td>
        </tr>
      </tbody>
    </table>
      <div class="col-md-offset-3 col-md-6" style="border-style: solid; border-width: 1px;margin-top: 35px;" >
            <div class="panel-body text-center">
                  <p class="text-uppercase" style="padding-left: 10px;">EMPRESA: <?php echo $relatorio->empresa?></p>
                  <p class="text-uppercase" style="padding-left: 10px;">OBRA: <?php echo $relatorio->obra?></p>
                  <p class="text-uppercase" style="padding-left: 10px;">LOCAL: <?php echo $relatorio->local?></p>
                  <p class="text-uppercase" style="padding-left: 10px;">DATA: <?php echo $relatorio->data?></p>
                  <p  style="color: #ffffff;
                        background-color: #000000;
                        text-align: center;
                        font-size: 16px;
                        font-weight: 600;
                        padding: 0.25em;
                        margin-bottom: 0;"
                  >Nenhuma tarefa é tão urgente que não pode ser planejada e executada com segurança!</p>
            </div>
      </div>
    </div>
  </div>
  <div class="row" style="margin-top: 30px;" >

    <table style="width: 100%;border-spacing: 0px; margin-bottom:20px;">
      <tbody>
        <tr><td style="text-align:left;">ASSUNTOS ABORDADOS:</td></tr>
		<tr><td style="border:0;text-align:left;"><input type="checkbox" <?php echo $array_info->as_01?>>01 - Uso de Epi's; </input></td></tr>
        <tr><td style="border:0;text-align:left;"><input type="checkbox" <?php echo $array_info->as_02?>>02 - Condições e utilização das ferramentas manuais, elétricas e pneumáticas; </input></td></tr>
		<tr><td style="border:0;text-align:left;"><input type="checkbox" <?php echo $array_info->as_03?>>03 - Trabalhos em altura; </input></td></tr>
		<tr><td style="border:0;text-align:left;"><input type="checkbox" <?php echo $array_info->as_04?>>04 - Condições e utilização de equipamentos para trabalho a quente. (solda, corte e outros); </input></td></tr>
		<tr><td style="border:0;text-align:left;"><input type="checkbox" <?php echo $array_info->as_05?>>05 - Inspeção de andaimes; </input></td></tr>
		<tr><td style="border:0;text-align:left;"><input type="checkbox" <?php echo $array_info->as_06?>>06 - Atenção na utilização de equipamentos elétricos; </input></td></tr>
		<tr><td style="border:0;text-align:left;"><input type="checkbox" <?php echo $array_info->as_07?>>07 - Espaço confinado; </input></td></tr>
		<tr><td style="border:0;text-align:left;"><input type="checkbox" <?php echo $array_info->as_08?>>08 - APR - Analisar os riscos antes do início das atividades; </input></td></tr>
		<tr><td style="border:0;text-align:left;"><input type="checkbox" <?php echo $array_info->as_09?>>09 - Içamento e transporte de cargas que serão suspensas; </input></td></tr>
		<tr><td style="border:0;text-align:left;"><input type="checkbox" <?php echo $array_info->as_10?>>10 - Serviços com equipamentos especiais (cadeira suspensa, linha de vida, jaú, pontos de ancoragem); </input></td></tr>
		<tr><td style="border:0;text-align:left;"><input type="checkbox" <?php echo $array_info->as_11?>>11 - Limpeza, remoção de entulhos. Manter a sua área limpa e desobstruída; </input></td></tr>
		<tr><td style="border:0;text-align:left;"><input type="checkbox" <?php echo $array_info->as_12?>>12 - Sinalização de segurança; </input></td></tr>
		<tr><td style="border:0;text-align:left;"><input type="checkbox" <?php echo $array_info->as_13?>>13 - Cumprimento das normas de segurança; </input></td></tr>
		<tr><td style="border:0;text-align:left;"><input type="checkbox" <?php echo $array_info->as_14?>>14 - Trabalho em equipe; </input></td></tr>
		<tr><td style="border:0;text-align:left;"><input type="checkbox" <?php echo $array_info->as_15?>>15 - DDS; </input></td></tr>
		<tr><td style="border:0;text-align:left;"><input type="checkbox" <?php echo $array_info->as_16?>>16 - Outros(especificar); </input></td></tr>
		<tr><td style="border:0;text-align:left;">(16): <?php echo $array_info->outros?></td></tr>
      <tr style="background-color: #888888; height: 40px;">
        <td>Fotos</td>
      </tr>
       <?php foreach ($array_images as $value) { ?>
          <tr>
            <td>
              <img src="<?php echo $value->image_path;?>" alt="" srcset="" width="400em">
            </td>
          </tr>
       <?php } ?>    
       <tr><td>Declaro, para todos os fins, ter recebido instruções sobre o(s) assunto(s) acima, comprometo-me a segui-las e obedecê-las durante a execução de todas as minhas atividades.</td></tr>
      </tbody>
    </table>
    
    <table style="width: 100%;border-spacing: 0px; margin-bottom: 50px">
      <tbody>
		<tr style="height: 23px;
              background-color: #000000">
          <td style="width: 33%; color: #ffffff;">NOME</td>
          <td style="width: 33%; color: #ffffff;">FUNÇÃO</td>
          <td style="width: 33%; color: #ffffff;">ASSINATURA</td>
        </tr>
        <?php foreach ($array_part as $value) { ?>
            <tr style="height: 30px;">
              <td style="width: 33%; text-align:left;"><?php echo $value->nome;?></td>
              <td style="width: 33%;"><?php echo $value->funcao;?></td>
              <td style="width: 33%;">&nbsp;</td>
          	</tr>
       <?php } ?>
      </tbody>
    </table>
    <table style="width: 100%;border-spacing: 0px;">
      <tbody>
        <tr style="height: 23px;">
          <td style="width: 33%;">JODAL</td>
          <td style="width: 33%;">Encaminhar para o email:</td>
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