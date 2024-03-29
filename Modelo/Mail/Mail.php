﻿<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail {

    public function enviarMailValidarRegistro($email, $keyValidacion) {
        require 'vendor/autoload.php';

        $mail = new PHPMailer();
        $exito = false;
        try {
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'a2plcpnl0516.prod.iad2.secureserver.net';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;
$mail->Username = "feriaufps@tksis.com";
$mail->Password = "Feria2017";
$mail->SetFrom('feriaufps@tksis.com', 'Activar usuario - Feria proyectos aula');
$mail->AddAddress($email);
$mail->isHTML(true);
$mail->Subject = 'Activar usuario feria de proyectos de aula'; //asunto
$mail->Body = $this->retornarPlantillaRegistro($keyValidacion); //mensaje


//$mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));

            $exito = $mail->Send(); //enviar    
        } catch (Exception $e) {
            
            throw new Exception('No lograste enviar el correo ');
        }
        return $exito;
    }
    
    
    public function enviarMailInvitarProyecto($email, $keyValidacion,$nombreProyecto,$idProyecto) {
        require 'vendor/autoload.php';

        $mail = new PHPMailer(true);
        $exito = false;
        try {
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'a2plcpnl0516.prod.iad2.secureserver.net';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;
$mail->Username = "feriaufps@tksis.com";
$mail->Password = "Feria2017";
$mail->SetFrom('feriaufps@tksis.com', 'Invitacion de union - Feria proyectos de aula');
$mail->AddAddress($email);
$mail->isHTML(true);
$mail->Subject = 'Unete a un proyecto de aula'; //asunto
$mail->Body = $this->retornarPlantillaInvitacionProyecto($keyValidacion,$nombreProyecto,$idProyecto); //mensaje


//$mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));

            $exito = $mail->send(); //enviar    
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $exito;
    }
    
    
    public function enviarMailRecuperarContrasenia($email, $key,$usuario,$tipo) {
        require 'vendor/autoload.php';

        $mail = new PHPMailer();
        $exito = false;
        try {
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'a2plcpnl0516.prod.iad2.secureserver.net';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;
$mail->Username = "feriaufps@tksis.com";
$mail->Password = "Feria2017";
$mail->SetFrom('feriaufps@tksis.com', 'Recuperar contraseña - Feria proyectos aula');
$mail->AddAddress($email);
$mail->isHTML(true);
$mail->Subject = 'Recuperar contraseña proyectos de aula'; //asunto
$mail->Body = $this->retornarPlantillaContrasenia($key, $usuario, $tipo); //mensaje


//$mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));

            $exito = $mail->Send(); //enviar    
        } catch (Exception $e) {
            
            throw new Exception('No lograste enviar el correo ');
        }
        return $exito;
    }
    
    function retornarPlantillaInvitacionProyecto($keyValidacion,$nombreProyecto,$idProyecto){
        $algo= "'Roboto'";
    $url= 'http://www.tksis.com/demos/proyectos/unirse='.$idProyecto.'-'.$keyValidacion;
    $plantilla= '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>
    <!--[if gte mso 9]><xml>
     <o:OfficeDocumentSettings>
      <o:AllowPNG/>
      <o:PixelsPerInch>96</o:PixelsPerInch>
     </o:OfficeDocumentSettings>
    </xml><![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
    <title>Template Base</title>
    <!--[if !mso]><!-- -->
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
	<!--<![endif]-->
    
    <style type="text/css" id="media-query">
      body {
  margin: 0;
  padding: 0; }

table, tr, td {
  vertical-align: top;
  border-collapse: collapse; }

.ie-browser table, .mso-container table {
  table-layout: fixed; }

* {
  line-height: inherit; }

a[x-apple-data-detectors=true] {
  color: inherit !important;
  text-decoration: none !important; }

[owa] .img-container div, [owa] .img-container button {
  display: block !important; }

[owa] .fullwidth button {
  width: 100% !important; }

[owa] .block-grid .col {
  display: table-cell;
  float: none !important;
  vertical-align: top; }

.ie-browser .num12, .ie-browser .block-grid, [owa] .num12, [owa] .block-grid {
  width: 600px !important; }

.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
  line-height: 100%; }

.ie-browser .mixed-two-up .num4, [owa] .mixed-two-up .num4 {
  width: 200px !important; }

.ie-browser .mixed-two-up .num8, [owa] .mixed-two-up .num8 {
  width: 400px !important; }

.ie-browser .block-grid.two-up .col, [owa] .block-grid.two-up .col {
  width: 300px !important; }

.ie-browser .block-grid.three-up .col, [owa] .block-grid.three-up .col {
  width: 200px !important; }

.ie-browser .block-grid.four-up .col, [owa] .block-grid.four-up .col {
  width: 150px !important; }

.ie-browser .block-grid.five-up .col, [owa] .block-grid.five-up .col {
  width: 120px !important; }

.ie-browser .block-grid.six-up .col, [owa] .block-grid.six-up .col {
  width: 100px !important; }

.ie-browser .block-grid.seven-up .col, [owa] .block-grid.seven-up .col {
  width: 85px !important; }

.ie-browser .block-grid.eight-up .col, [owa] .block-grid.eight-up .col {
  width: 75px !important; }

.ie-browser .block-grid.nine-up .col, [owa] .block-grid.nine-up .col {
  width: 66px !important; }

.ie-browser .block-grid.ten-up .col, [owa] .block-grid.ten-up .col {
  width: 60px !important; }

.ie-browser .block-grid.eleven-up .col, [owa] .block-grid.eleven-up .col {
  width: 54px !important; }

.ie-browser .block-grid.twelve-up .col, [owa] .block-grid.twelve-up .col {
  width: 50px !important; }

@media only screen and (min-width: 620px) {
  .block-grid {
    width: 600px !important; }
  .block-grid .col {
    vertical-align: top; }
    .block-grid .col.num12 {
      width: 600px !important; }
  .block-grid.mixed-two-up .col.num4 {
    width: 200px !important; }
  .block-grid.mixed-two-up .col.num8 {
    width: 400px !important; }
  .block-grid.two-up .col {
    width: 300px !important; }
  .block-grid.three-up .col {
    width: 200px !important; }
  .block-grid.four-up .col {
    width: 150px !important; }
  .block-grid.five-up .col {
    width: 120px !important; }
  .block-grid.six-up .col {
    width: 100px !important; }
  .block-grid.seven-up .col {
    width: 85px !important; }
  .block-grid.eight-up .col {
    width: 75px !important; }
  .block-grid.nine-up .col {
    width: 66px !important; }
  .block-grid.ten-up .col {
    width: 60px !important; }
  .block-grid.eleven-up .col {
    width: 54px !important; }
  .block-grid.twelve-up .col {
    width: 50px !important; } }

@media (max-width: 620px) {
  .block-grid, .col {
    min-width: 320px !important;
    max-width: 100% !important;
    display: block !important; }
  .block-grid {
    width: calc(100% - 40px) !important; }
  .col {
    width: 100% !important; }
    .col > div {
      margin: 0 auto; }
  img.fullwidth, img.fullwidthOnMobile {
    max-width: 100% !important; } }

    </style>
</head>
<body class="clean-body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #E3E8E5">
  <style type="text/css" id="media-query-bodytag">
    @media (max-width: 620px) {
      .block-grid {
        min-width: 320px!important;
        max-width: 100%!important;
        width: 100%!important;
        display: block!important;
      }

      .col {
        min-width: 320px!important;
        max-width: 100%!important;
        width: 100%!important;
        display: block!important;
      }

      .col>div {
        margin: 0 auto;
      }

      img.fullwidth {
        max-width: 100%!important;
      }

      img.fullwidthOnMobile {
        max-width: 100%!important;
      }
    }
  </style>
  <!--[if IE]><div class="ie-browser"><![endif]-->
  <!--[if mso]><div class="mso-container"><![endif]-->
  <table class="nl-container" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #E3E8E5;width: 100%" cellpadding="0" cellspacing="0">
    <tbody>
      <tr style="vertical-align: top">
        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding: 0">
          <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #E3E8E5;"><![endif]-->
          <!--[if (IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #E3E8E5;"><![endif]-->

          <div style="background-color:transparent;">
            <div style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #393B3B;" class="block-grid ">
              <div style="border-collapse: collapse;display: table;width: 100%;background-color:#393B3B;">
                <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#393B3B;"><![endif]-->
                <!--[if (IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#393B3B;"><![endif]-->

                    <!--[if (mso)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                    <!--[if (IE)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                  <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;">
                    <div style="background-color: transparent; width: 100% !important;">
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]--><!--<![endif]-->

                        
                          <div style="padding-right: 0px; padding-left: 0px; padding-top: 0px; padding-bottom: 0px;">
  <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px;padding-left: 0px; padding-top: 0px; padding-bottom: 0px;"><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0"><tr><td><![endif]-->
  <div align="center"><div style="border-top: 0px solid transparent; width:100%; line-height:0px; height:0px; font-size:0px;">&#160;</div></div>
  <!--[if (mso)]></td></tr></table></td></tr></table><![endif]-->
</div>

                        
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--></div><!--<![endif]--><!--<![endif]-->
                    </div>
                  </div>
                <!--[if (mso)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
                <!--[if (IE)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
              </div>
            </div>
          </div>          <div style="background-color:transparent;">
            <div style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #FFFFFF;" class="block-grid ">
              <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
                <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->
                <!--[if (IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->

                    <!--[if (mso)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                    <!--[if (IE)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                  <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;">
                    <div style="background-color: transparent; width: 100% !important;">
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;"><!--<![endif]--><!--<![endif]-->

                        
                          <div align="center" class="img-container center fullwidth" style="padding-right: 0px;  padding-left: 0px;">
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px;" align="center"><![endif]-->
<div style="line-height:5px;font-size:1px">&#160;</div>  <img class="center fullwidth" align="center" border="0" src="https://preview.ibb.co/eL4U36/poster.jpg" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: 0;height: auto;float: none;width: 100%;max-width: 600px" width="600">
<!--[if mso]></td></tr></table><![endif]-->
</div>

                        
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--></div><!--<![endif]--><!--<![endif]-->
                    </div>
                  </div>
                <!--[if (mso)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
                <!--[if (IE)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
              </div>
            </div>
          </div>          <div style="background-color:#E3E8E5;">
            <div style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #FFFFFF;" class="block-grid ">
              <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
                <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:#E3E8E5;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->
                <!--[if (IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:#E3E8E5;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->

                    <!--[if (mso)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                    <!--[if (IE)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                  <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;">
                    <div style="background-color: transparent; width: 100% !important;">
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]--><!--<![endif]-->

                        
                          &#160;
                        
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--></div><!--<![endif]--><!--<![endif]-->
                    </div>
                  </div>
                <!--[if (mso)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
                <!--[if (IE)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
              </div>
            </div>
          </div>          <div style="background-color:#E3E8E5;">
            <div style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #FFFFFF;" class="block-grid ">
              <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
                <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:#E3E8E5;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->
                <!--[if (IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:#E3E8E5;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->

                    <!--[if (mso)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                    <!--[if (IE)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                  <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;">
                    <div style="background-color: transparent; width: 100% !important;">
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]--><!--<![endif]-->

                        
                          <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 30px; padding-top: 30px; padding-bottom: 5px;"><![endif]-->
<div style="font-family:'.$algo.', Tahoma, Verdana, Segoe, sans-serif;line-height:150%;color:#555555; padding-right: 30px; padding-left: 30px; padding-top: 30px; padding-bottom: 5px;">	
	<div style="font-size:12px;line-height:18px;color:#555555;font-family:'.$algo.', Tahoma, Verdana, Segoe, sans-serif;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: center"><span style="font-size: 24px; line-height: 36px;"><strong><span style="line-height: 36px; font-size: 24px;"><span style="line-height: 36px; font-size: 24px;">Bienvenido a feria de proyectos de aula<br></span></span></strong></span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: center"><span style="font-size: 18px; line-height: 27px;">Te han enviado una invitacion para unirte a el proyecto llamado :<br><b>'.$nombreProyecto.'</b><br>Utiliza el siguiente url para unirte al proyecto :<br><a href"'.$url.'">'.$url.'</a><br>O puedes oprimir el botón Aceptar invitacion</span></p></div>	
</div>
<!--[if mso]></td></tr></table><![endif]-->

                        
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--></div><!--<![endif]--><!--<![endif]-->
                    </div>
                  </div>
                <!--[if (mso)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
                <!--[if (IE)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
              </div>
            </div>
          </div>          <div style="background-color:transparent;">
            <div style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #FFFFFF;" class="block-grid ">
              <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
                <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->
                <!--[if (IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->

                    <!--[if (mso)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:15px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                    <!--[if (IE)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:15px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                  <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;">
                    <div style="background-color: transparent; width: 100% !important;">
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:15px; padding-right: 0px; padding-left: 0px;"><!--<![endif]--><!--<![endif]-->

                        
                          
<div align="center" class="button-container center" style="padding-right: 10px; padding-left: 10px; padding-top:10px; padding-bottom:20px;">
  <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top:10px; padding-bottom:20px;" align="center"><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://www.tksis.com/demos/proyectos/Inicio" style="height:50px; v-text-anchor:middle; width:222px;" arcsize="8%" strokecolor="#DC3F00" fillcolor="#DC3F00"><w:anchorlock/><center style="color:#ffffff; font-family:'.$algo.', Tahoma, Verdana, Segoe, sans-serif; font-size:20px;"><![endif]-->
    <a href="'.$url.'" target="_blank" style="display: block;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #ffffff; background-color: #DC3F00; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; max-width: 222px; width: 182px;width: auto; border-top: 0px solid transparent; border-right: 0px solid transparent; border-bottom: 0px solid transparent; border-left: 0px solid transparent; padding-top: 5px; padding-right: 20px; padding-bottom: 5px; padding-left: 20px; font-family: '.$algo.', Tahoma, Verdana, Segoe, sans-serif;mso-border-alt: none">
      <span style="font-size:12px;line-height:24px;"><span style="font-size: 20px; line-height: 40px;" data-mce-style="font-size: 20px;"><strong>Aceptar invitacion</strong></span></span>
    </a>
  <!--[if mso]></center></v:roundrect></td></tr></table><![endif]-->
</div>

                        
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--></div><!--<![endif]--><!--<![endif]-->
                    </div>
                  </div>
                <!--[if (mso)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
                <!--[if (IE)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
              </div>
            </div>
          </div>          <div style="background-color:transparent;">
            <div style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #393B3B;" class="block-grid ">
              <div style="border-collapse: collapse;display: table;width: 100%;background-color:#393B3B;">
                <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#393B3B;"><![endif]-->
                <!--[if (IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#393B3B;"><![endif]-->

                    <!--[if (mso)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                    <!--[if (IE)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                  <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;">
                    <div style="background-color: transparent; width: 100% !important;">
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;"><!--<![endif]--><!--<![endif]-->

                        
                          <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;"><![endif]-->
<div style="font-family:'.$algo.', Tahoma, Verdana, Segoe, sans-serif;line-height:120%;color:#FFFFFF; padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;">	
	<div style="font-size:12px;line-height:14px;color:#FFFFFF;font-family:'.$algo.', Tahoma, Verdana, Segoe, sans-serif;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 14px;text-align: center"><span style="font-size: 10px; line-height: 12px;"><span style="line-height: 12px; font-size: 10px;">Recibiste este mensaje porque completaste registro en el sistema de feria de proyectos de aula.</span></span></p></div>	
</div>
<!--[if mso]></td></tr></table><![endif]-->

                        
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--></div><!--<![endif]--><!--<![endif]-->
                    </div>
                  </div>
                <!--[if (mso)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
                <!--[if (IE)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
              </div>
            </div>
          </div>         <!--[if (mso)]></td></tr></table><![endif]-->
         <!--[if (IE)]></td></tr></table><![endif]-->
       </td>
     </tr>
    </tbody>
  </table>
  <!--[if (mso)]></div><![endif]-->
  <!--[if (IE)]></div><![endif]-->


</body></html>';
    return $plantilla;
    }


    
    
    public function retornarPlantillaRegistro($key) {
    $algo= "'Roboto'";
    $url= 'http://www.tksis.com/demos/proyectos/Validacion='.$key;
    $plantilla= '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>
    <!--[if gte mso 9]><xml>
     <o:OfficeDocumentSettings>
      <o:AllowPNG/>
      <o:PixelsPerInch>96</o:PixelsPerInch>
     </o:OfficeDocumentSettings>
    </xml><![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
    <title>Template Base</title>
    <!--[if !mso]><!-- -->
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
	<!--<![endif]-->
    
    <style type="text/css" id="media-query">
      body {
  margin: 0;
  padding: 0; }

table, tr, td {
  vertical-align: top;
  border-collapse: collapse; }

.ie-browser table, .mso-container table {
  table-layout: fixed; }

* {
  line-height: inherit; }

a[x-apple-data-detectors=true] {
  color: inherit !important;
  text-decoration: none !important; }

[owa] .img-container div, [owa] .img-container button {
  display: block !important; }

[owa] .fullwidth button {
  width: 100% !important; }

[owa] .block-grid .col {
  display: table-cell;
  float: none !important;
  vertical-align: top; }

.ie-browser .num12, .ie-browser .block-grid, [owa] .num12, [owa] .block-grid {
  width: 600px !important; }

.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
  line-height: 100%; }

.ie-browser .mixed-two-up .num4, [owa] .mixed-two-up .num4 {
  width: 200px !important; }

.ie-browser .mixed-two-up .num8, [owa] .mixed-two-up .num8 {
  width: 400px !important; }

.ie-browser .block-grid.two-up .col, [owa] .block-grid.two-up .col {
  width: 300px !important; }

.ie-browser .block-grid.three-up .col, [owa] .block-grid.three-up .col {
  width: 200px !important; }

.ie-browser .block-grid.four-up .col, [owa] .block-grid.four-up .col {
  width: 150px !important; }

.ie-browser .block-grid.five-up .col, [owa] .block-grid.five-up .col {
  width: 120px !important; }

.ie-browser .block-grid.six-up .col, [owa] .block-grid.six-up .col {
  width: 100px !important; }

.ie-browser .block-grid.seven-up .col, [owa] .block-grid.seven-up .col {
  width: 85px !important; }

.ie-browser .block-grid.eight-up .col, [owa] .block-grid.eight-up .col {
  width: 75px !important; }

.ie-browser .block-grid.nine-up .col, [owa] .block-grid.nine-up .col {
  width: 66px !important; }

.ie-browser .block-grid.ten-up .col, [owa] .block-grid.ten-up .col {
  width: 60px !important; }

.ie-browser .block-grid.eleven-up .col, [owa] .block-grid.eleven-up .col {
  width: 54px !important; }

.ie-browser .block-grid.twelve-up .col, [owa] .block-grid.twelve-up .col {
  width: 50px !important; }

@media only screen and (min-width: 620px) {
  .block-grid {
    width: 600px !important; }
  .block-grid .col {
    vertical-align: top; }
    .block-grid .col.num12 {
      width: 600px !important; }
  .block-grid.mixed-two-up .col.num4 {
    width: 200px !important; }
  .block-grid.mixed-two-up .col.num8 {
    width: 400px !important; }
  .block-grid.two-up .col {
    width: 300px !important; }
  .block-grid.three-up .col {
    width: 200px !important; }
  .block-grid.four-up .col {
    width: 150px !important; }
  .block-grid.five-up .col {
    width: 120px !important; }
  .block-grid.six-up .col {
    width: 100px !important; }
  .block-grid.seven-up .col {
    width: 85px !important; }
  .block-grid.eight-up .col {
    width: 75px !important; }
  .block-grid.nine-up .col {
    width: 66px !important; }
  .block-grid.ten-up .col {
    width: 60px !important; }
  .block-grid.eleven-up .col {
    width: 54px !important; }
  .block-grid.twelve-up .col {
    width: 50px !important; } }

@media (max-width: 620px) {
  .block-grid, .col {
    min-width: 320px !important;
    max-width: 100% !important;
    display: block !important; }
  .block-grid {
    width: calc(100% - 40px) !important; }
  .col {
    width: 100% !important; }
    .col > div {
      margin: 0 auto; }
  img.fullwidth, img.fullwidthOnMobile {
    max-width: 100% !important; } }

    </style>
</head>
<body class="clean-body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #E3E8E5">
  <style type="text/css" id="media-query-bodytag">
    @media (max-width: 620px) {
      .block-grid {
        min-width: 320px!important;
        max-width: 100%!important;
        width: 100%!important;
        display: block!important;
      }

      .col {
        min-width: 320px!important;
        max-width: 100%!important;
        width: 100%!important;
        display: block!important;
      }

      .col>div {
        margin: 0 auto;
      }

      img.fullwidth {
        max-width: 100%!important;
      }

      img.fullwidthOnMobile {
        max-width: 100%!important;
      }
    }
  </style>
  <!--[if IE]><div class="ie-browser"><![endif]-->
  <!--[if mso]><div class="mso-container"><![endif]-->
  <table class="nl-container" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #E3E8E5;width: 100%" cellpadding="0" cellspacing="0">
    <tbody>
      <tr style="vertical-align: top">
        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding: 0">
          <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #E3E8E5;"><![endif]-->
          <!--[if (IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #E3E8E5;"><![endif]-->

          <div style="background-color:transparent;">
            <div style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #393B3B;" class="block-grid ">
              <div style="border-collapse: collapse;display: table;width: 100%;background-color:#393B3B;">
                <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#393B3B;"><![endif]-->
                <!--[if (IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#393B3B;"><![endif]-->

                    <!--[if (mso)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                    <!--[if (IE)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                  <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;">
                    <div style="background-color: transparent; width: 100% !important;">
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]--><!--<![endif]-->

                        
                          <div style="padding-right: 0px; padding-left: 0px; padding-top: 0px; padding-bottom: 0px;">
  <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px;padding-left: 0px; padding-top: 0px; padding-bottom: 0px;"><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0"><tr><td><![endif]-->
  <div align="center"><div style="border-top: 0px solid transparent; width:100%; line-height:0px; height:0px; font-size:0px;">&#160;</div></div>
  <!--[if (mso)]></td></tr></table></td></tr></table><![endif]-->
</div>

                        
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--></div><!--<![endif]--><!--<![endif]-->
                    </div>
                  </div>
                <!--[if (mso)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
                <!--[if (IE)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
              </div>
            </div>
          </div>          <div style="background-color:transparent;">
            <div style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #FFFFFF;" class="block-grid ">
              <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
                <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->
                <!--[if (IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->

                    <!--[if (mso)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                    <!--[if (IE)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                  <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;">
                    <div style="background-color: transparent; width: 100% !important;">
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;"><!--<![endif]--><!--<![endif]-->

                        
                          <div align="center" class="img-container center fullwidth" style="padding-right: 0px;  padding-left: 0px;">
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px;" align="center"><![endif]-->
<div style="line-height:5px;font-size:1px">&#160;</div>  <img class="center fullwidth" align="center" border="0" src="https://preview.ibb.co/eL4U36/poster.jpg" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: 0;height: auto;float: none;width: 100%;max-width: 600px" width="600">
<!--[if mso]></td></tr></table><![endif]-->
</div>

                        
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--></div><!--<![endif]--><!--<![endif]-->
                    </div>
                  </div>
                <!--[if (mso)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
                <!--[if (IE)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
              </div>
            </div>
          </div>          <div style="background-color:#E3E8E5;">
            <div style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #FFFFFF;" class="block-grid ">
              <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
                <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:#E3E8E5;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->
                <!--[if (IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:#E3E8E5;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->

                    <!--[if (mso)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                    <!--[if (IE)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                  <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;">
                    <div style="background-color: transparent; width: 100% !important;">
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]--><!--<![endif]-->

                        
                          &#160;
                        
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--></div><!--<![endif]--><!--<![endif]-->
                    </div>
                  </div>
                <!--[if (mso)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
                <!--[if (IE)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
              </div>
            </div>
          </div>          <div style="background-color:#E3E8E5;">
            <div style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #FFFFFF;" class="block-grid ">
              <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
                <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:#E3E8E5;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->
                <!--[if (IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:#E3E8E5;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->

                    <!--[if (mso)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                    <!--[if (IE)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                  <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;">
                    <div style="background-color: transparent; width: 100% !important;">
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]--><!--<![endif]-->

                        
                          <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 30px; padding-top: 30px; padding-bottom: 5px;"><![endif]-->
<div style="font-family:'.$algo.', Tahoma, Verdana, Segoe, sans-serif;line-height:150%;color:#555555; padding-right: 30px; padding-left: 30px; padding-top: 30px; padding-bottom: 5px;">	
	<div style="font-size:12px;line-height:18px;color:#555555;font-family:'.$algo.', Tahoma, Verdana, Segoe, sans-serif;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: center"><span style="font-size: 24px; line-height: 36px;"><strong><span style="line-height: 36px; font-size: 24px;"><span style="line-height: 36px; font-size: 24px;">Bienvenido a feria de proyectos de aula<br></span></span></strong></span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: center"><span style="font-size: 18px; line-height: 27px;">Para completar tu registro utiliza el siguiente enlace :<br><a href"'.$url.'">'.$url.'</a><br>O puedes oprimir el botón Validar Registro</span></p></div>	
</div>
<!--[if mso]></td></tr></table><![endif]-->

                        
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--></div><!--<![endif]--><!--<![endif]-->
                    </div>
                  </div>
                <!--[if (mso)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
                <!--[if (IE)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
              </div>
            </div>
          </div>          <div style="background-color:transparent;">
            <div style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #FFFFFF;" class="block-grid ">
              <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
                <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->
                <!--[if (IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->

                    <!--[if (mso)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:15px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                    <!--[if (IE)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:15px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                  <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;">
                    <div style="background-color: transparent; width: 100% !important;">
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:15px; padding-right: 0px; padding-left: 0px;"><!--<![endif]--><!--<![endif]-->

                        
                          
<div align="center" class="button-container center" style="padding-right: 10px; padding-left: 10px; padding-top:10px; padding-bottom:20px;">
  <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top:10px; padding-bottom:20px;" align="center"><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://www.tksis.com/demos/proyectos/Inicio" style="height:50px; v-text-anchor:middle; width:222px;" arcsize="8%" strokecolor="#DC3F00" fillcolor="#DC3F00"><w:anchorlock/><center style="color:#ffffff; font-family:'.$algo.', Tahoma, Verdana, Segoe, sans-serif; font-size:20px;"><![endif]-->
    <a href="'.$url.'" target="_blank" style="display: block;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #ffffff; background-color: #DC3F00; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; max-width: 222px; width: 182px;width: auto; border-top: 0px solid transparent; border-right: 0px solid transparent; border-bottom: 0px solid transparent; border-left: 0px solid transparent; padding-top: 5px; padding-right: 20px; padding-bottom: 5px; padding-left: 20px; font-family: '.$algo.', Tahoma, Verdana, Segoe, sans-serif;mso-border-alt: none">
      <span style="font-size:12px;line-height:24px;"><span style="font-size: 20px; line-height: 40px;" data-mce-style="font-size: 20px;"><strong>VALIDAR REGISTRO</strong></span></span>
    </a>
  <!--[if mso]></center></v:roundrect></td></tr></table><![endif]-->
</div>

                        
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--></div><!--<![endif]--><!--<![endif]-->
                    </div>
                  </div>
                <!--[if (mso)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
                <!--[if (IE)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
              </div>
            </div>
          </div>          <div style="background-color:transparent;">
            <div style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #393B3B;" class="block-grid ">
              <div style="border-collapse: collapse;display: table;width: 100%;background-color:#393B3B;">
                <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#393B3B;"><![endif]-->
                <!--[if (IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#393B3B;"><![endif]-->

                    <!--[if (mso)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                    <!--[if (IE)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                  <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;">
                    <div style="background-color: transparent; width: 100% !important;">
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;"><!--<![endif]--><!--<![endif]-->

                        
                          <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;"><![endif]-->
<div style="font-family:'.$algo.', Tahoma, Verdana, Segoe, sans-serif;line-height:120%;color:#FFFFFF; padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;">	
	<div style="font-size:12px;line-height:14px;color:#FFFFFF;font-family:'.$algo.', Tahoma, Verdana, Segoe, sans-serif;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 14px;text-align: center"><span style="font-size: 10px; line-height: 12px;"><span style="line-height: 12px; font-size: 10px;">Recibiste este mensaje porque completaste registro en el sistema de feria de proyectos de aula.</span></span></p></div>	
</div>
<!--[if mso]></td></tr></table><![endif]-->

                        
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--></div><!--<![endif]--><!--<![endif]-->
                    </div>
                  </div>
                <!--[if (mso)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
                <!--[if (IE)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
              </div>
            </div>
          </div>         <!--[if (mso)]></td></tr></table><![endif]-->
         <!--[if (IE)]></td></tr></table><![endif]-->
       </td>
     </tr>
    </tbody>
  </table>
  <!--[if (mso)]></div><![endif]-->
  <!--[if (IE)]></div><![endif]-->


</body></html>';
    return $plantilla;
}


public function retornarPlantillaContrasenia($key,$usuario,$tipo) {
    $algo= "'Roboto'";
    $url= 'http://www.tksis.com/demos/proyectos/ContraNueva='.$key."-".$usuario."-".$tipo;
    $plantilla= '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>
    <!--[if gte mso 9]><xml>
     <o:OfficeDocumentSettings>
      <o:AllowPNG/>
      <o:PixelsPerInch>96</o:PixelsPerInch>
     </o:OfficeDocumentSettings>
    </xml><![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
    <title>Template Base</title>
    <!--[if !mso]><!-- -->
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
	<!--<![endif]-->
    
    <style type="text/css" id="media-query">
      body {
  margin: 0;
  padding: 0; }

table, tr, td {
  vertical-align: top;
  border-collapse: collapse; }

.ie-browser table, .mso-container table {
  table-layout: fixed; }

* {
  line-height: inherit; }

a[x-apple-data-detectors=true] {
  color: inherit !important;
  text-decoration: none !important; }

[owa] .img-container div, [owa] .img-container button {
  display: block !important; }

[owa] .fullwidth button {
  width: 100% !important; }

[owa] .block-grid .col {
  display: table-cell;
  float: none !important;
  vertical-align: top; }

.ie-browser .num12, .ie-browser .block-grid, [owa] .num12, [owa] .block-grid {
  width: 600px !important; }

.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
  line-height: 100%; }

.ie-browser .mixed-two-up .num4, [owa] .mixed-two-up .num4 {
  width: 200px !important; }

.ie-browser .mixed-two-up .num8, [owa] .mixed-two-up .num8 {
  width: 400px !important; }

.ie-browser .block-grid.two-up .col, [owa] .block-grid.two-up .col {
  width: 300px !important; }

.ie-browser .block-grid.three-up .col, [owa] .block-grid.three-up .col {
  width: 200px !important; }

.ie-browser .block-grid.four-up .col, [owa] .block-grid.four-up .col {
  width: 150px !important; }

.ie-browser .block-grid.five-up .col, [owa] .block-grid.five-up .col {
  width: 120px !important; }

.ie-browser .block-grid.six-up .col, [owa] .block-grid.six-up .col {
  width: 100px !important; }

.ie-browser .block-grid.seven-up .col, [owa] .block-grid.seven-up .col {
  width: 85px !important; }

.ie-browser .block-grid.eight-up .col, [owa] .block-grid.eight-up .col {
  width: 75px !important; }

.ie-browser .block-grid.nine-up .col, [owa] .block-grid.nine-up .col {
  width: 66px !important; }

.ie-browser .block-grid.ten-up .col, [owa] .block-grid.ten-up .col {
  width: 60px !important; }

.ie-browser .block-grid.eleven-up .col, [owa] .block-grid.eleven-up .col {
  width: 54px !important; }

.ie-browser .block-grid.twelve-up .col, [owa] .block-grid.twelve-up .col {
  width: 50px !important; }

@media only screen and (min-width: 620px) {
  .block-grid {
    width: 600px !important; }
  .block-grid .col {
    vertical-align: top; }
    .block-grid .col.num12 {
      width: 600px !important; }
  .block-grid.mixed-two-up .col.num4 {
    width: 200px !important; }
  .block-grid.mixed-two-up .col.num8 {
    width: 400px !important; }
  .block-grid.two-up .col {
    width: 300px !important; }
  .block-grid.three-up .col {
    width: 200px !important; }
  .block-grid.four-up .col {
    width: 150px !important; }
  .block-grid.five-up .col {
    width: 120px !important; }
  .block-grid.six-up .col {
    width: 100px !important; }
  .block-grid.seven-up .col {
    width: 85px !important; }
  .block-grid.eight-up .col {
    width: 75px !important; }
  .block-grid.nine-up .col {
    width: 66px !important; }
  .block-grid.ten-up .col {
    width: 60px !important; }
  .block-grid.eleven-up .col {
    width: 54px !important; }
  .block-grid.twelve-up .col {
    width: 50px !important; } }

@media (max-width: 620px) {
  .block-grid, .col {
    min-width: 320px !important;
    max-width: 100% !important;
    display: block !important; }
  .block-grid {
    width: calc(100% - 40px) !important; }
  .col {
    width: 100% !important; }
    .col > div {
      margin: 0 auto; }
  img.fullwidth, img.fullwidthOnMobile {
    max-width: 100% !important; } }

    </style>
</head>
<body class="clean-body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #E3E8E5">
  <style type="text/css" id="media-query-bodytag">
    @media (max-width: 620px) {
      .block-grid {
        min-width: 320px!important;
        max-width: 100%!important;
        width: 100%!important;
        display: block!important;
      }

      .col {
        min-width: 320px!important;
        max-width: 100%!important;
        width: 100%!important;
        display: block!important;
      }

      .col>div {
        margin: 0 auto;
      }

      img.fullwidth {
        max-width: 100%!important;
      }

      img.fullwidthOnMobile {
        max-width: 100%!important;
      }
    }
  </style>
  <!--[if IE]><div class="ie-browser"><![endif]-->
  <!--[if mso]><div class="mso-container"><![endif]-->
  <table class="nl-container" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #E3E8E5;width: 100%" cellpadding="0" cellspacing="0">
    <tbody>
      <tr style="vertical-align: top">
        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;padding: 0">
          <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #E3E8E5;"><![endif]-->
          <!--[if (IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #E3E8E5;"><![endif]-->

          <div style="background-color:transparent;">
            <div style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #393B3B;" class="block-grid ">
              <div style="border-collapse: collapse;display: table;width: 100%;background-color:#393B3B;">
                <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#393B3B;"><![endif]-->
                <!--[if (IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#393B3B;"><![endif]-->

                    <!--[if (mso)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                    <!--[if (IE)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                  <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;">
                    <div style="background-color: transparent; width: 100% !important;">
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]--><!--<![endif]-->

                        
                          <div style="padding-right: 0px; padding-left: 0px; padding-top: 0px; padding-bottom: 0px;">
  <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px;padding-left: 0px; padding-top: 0px; padding-bottom: 0px;"><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0"><tr><td><![endif]-->
  <div align="center"><div style="border-top: 0px solid transparent; width:100%; line-height:0px; height:0px; font-size:0px;">&#160;</div></div>
  <!--[if (mso)]></td></tr></table></td></tr></table><![endif]-->
</div>

                        
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--></div><!--<![endif]--><!--<![endif]-->
                    </div>
                  </div>
                <!--[if (mso)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
                <!--[if (IE)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
              </div>
            </div>
          </div>          <div style="background-color:transparent;">
            <div style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #FFFFFF;" class="block-grid ">
              <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
                <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->
                <!--[if (IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->

                    <!--[if (mso)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                    <!--[if (IE)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                  <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;">
                    <div style="background-color: transparent; width: 100% !important;">
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;"><!--<![endif]--><!--<![endif]-->

                        
                          <div align="center" class="img-container center fullwidth" style="padding-right: 0px;  padding-left: 0px;">
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px;" align="center"><![endif]-->
<div style="line-height:5px;font-size:1px">&#160;</div>  <img class="center fullwidth" align="center" border="0" src="https://preview.ibb.co/eL4U36/poster.jpg" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: 0;height: auto;float: none;width: 100%;max-width: 600px" width="600">
<!--[if mso]></td></tr></table><![endif]-->
</div>

                        
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--></div><!--<![endif]--><!--<![endif]-->
                    </div>
                  </div>
                <!--[if (mso)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
                <!--[if (IE)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
              </div>
            </div>
          </div>          <div style="background-color:#E3E8E5;">
            <div style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #FFFFFF;" class="block-grid ">
              <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
                <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:#E3E8E5;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->
                <!--[if (IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:#E3E8E5;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->

                    <!--[if (mso)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                    <!--[if (IE)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                  <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;">
                    <div style="background-color: transparent; width: 100% !important;">
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]--><!--<![endif]-->

                        
                          &#160;
                        
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--></div><!--<![endif]--><!--<![endif]-->
                    </div>
                  </div>
                <!--[if (mso)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
                <!--[if (IE)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
              </div>
            </div>
          </div>          <div style="background-color:#E3E8E5;">
            <div style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #FFFFFF;" class="block-grid ">
              <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
                <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:#E3E8E5;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->
                <!--[if (IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:#E3E8E5;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->

                    <!--[if (mso)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                    <!--[if (IE)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                  <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;">
                    <div style="background-color: transparent; width: 100% !important;">
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;"><!--<![endif]--><!--<![endif]-->

                        
                          <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 30px; padding-top: 30px; padding-bottom: 5px;"><![endif]-->
<div style="font-family:'.$algo.', Tahoma, Verdana, Segoe, sans-serif;line-height:150%;color:#555555; padding-right: 30px; padding-left: 30px; padding-top: 30px; padding-bottom: 5px;">	
	<div style="font-size:12px;line-height:18px;color:#555555;font-family:'.$algo.', Tahoma, Verdana, Segoe, sans-serif;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: center"><span style="font-size: 24px; line-height: 36px;"><strong><span style="line-height: 36px; font-size: 24px;"><span style="line-height: 36px; font-size: 24px;">Recuperar contraseña<br></span></span></strong></span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: center"><span style="font-size: 18px; line-height: 27px;">Para recuperar contraseña utiliza el siguiente enlace :<br><a href"'.$url.'">'.$url.'</a><br>O puedes oprimir el botón Recuperar Contraseña</span></p></div>	
</div>
<!--[if mso]></td></tr></table><![endif]-->

                        
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--></div><!--<![endif]--><!--<![endif]-->
                    </div>
                  </div>
                <!--[if (mso)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
                <!--[if (IE)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
              </div>
            </div>
          </div>          <div style="background-color:transparent;">
            <div style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #FFFFFF;" class="block-grid ">
              <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
                <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->
                <!--[if (IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#FFFFFF;"><![endif]-->

                    <!--[if (mso)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:15px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                    <!--[if (IE)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:15px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                  <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;">
                    <div style="background-color: transparent; width: 100% !important;">
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:0px; padding-bottom:15px; padding-right: 0px; padding-left: 0px;"><!--<![endif]--><!--<![endif]-->

                        
                          
<div align="center" class="button-container center" style="padding-right: 10px; padding-left: 10px; padding-top:10px; padding-bottom:20px;">
  <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top:10px; padding-bottom:20px;" align="center"><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://www.tksis.com/demos/proyectos/Inicio" style="height:50px; v-text-anchor:middle; width:222px;" arcsize="8%" strokecolor="#DC3F00" fillcolor="#DC3F00"><w:anchorlock/><center style="color:#ffffff; font-family:'.$algo.', Tahoma, Verdana, Segoe, sans-serif; font-size:20px;"><![endif]-->
    <a href="'.$url.'" target="_blank" style="display: block;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #ffffff; background-color: #DC3F00; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; max-width: 222px; width: 182px;width: auto; border-top: 0px solid transparent; border-right: 0px solid transparent; border-bottom: 0px solid transparent; border-left: 0px solid transparent; padding-top: 5px; padding-right: 20px; padding-bottom: 5px; padding-left: 20px; font-family: '.$algo.', Tahoma, Verdana, Segoe, sans-serif;mso-border-alt: none">
      <span style="font-size:12px;line-height:24px;"><span style="font-size: 20px; line-height: 40px;" data-mce-style="font-size: 20px;"><strong>RECUPERAR CONTRASEÑA</strong></span></span>
    </a>
  <!--[if mso]></center></v:roundrect></td></tr></table><![endif]-->
</div>

                        
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--></div><!--<![endif]--><!--<![endif]-->
                    </div>
                  </div>
                <!--[if (mso)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
                <!--[if (IE)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
              </div>
            </div>
          </div>          <div style="background-color:transparent;">
            <div style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #393B3B;" class="block-grid ">
              <div style="border-collapse: collapse;display: table;width: 100%;background-color:#393B3B;">
                <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#393B3B;"><![endif]-->
                <!--[if (IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 600px;"><tr class="layout-full-width" style="background-color:#393B3B;"><![endif]-->

                    <!--[if (mso)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                    <!--[if (IE)]><td align="center" width="600" style=" width:600px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                  <div class="col num12" style="min-width: 320px;max-width: 600px;display: table-cell;vertical-align: top;">
                    <div style="background-color: transparent; width: 100% !important;">
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;"><!--<![endif]--><!--<![endif]-->

                        
                          <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;"><![endif]-->
<div style="font-family:'.$algo.', Tahoma, Verdana, Segoe, sans-serif;line-height:120%;color:#FFFFFF; padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;">	
	<div style="font-size:12px;line-height:14px;color:#FFFFFF;font-family:'.$algo.', Tahoma, Verdana, Segoe, sans-serif;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 14px;text-align: center"><span style="font-size: 10px; line-height: 12px;"><span style="line-height: 12px; font-size: 10px;">Recibiste este mensaje porque llenaste el formulario de recuperacion de contraseña</span></span></p></div>	
</div>
<!--[if mso]></td></tr></table><![endif]-->

                        
                    <!--[if (!mso)]><!--><!--[if (!IE)]><!--></div><!--<![endif]--><!--<![endif]-->
                    </div>
                  </div>
                <!--[if (mso)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
                <!--[if (IE)]></td></tr/></table></td></tr></table></td></tr></table><![endif]-->
              </div>
            </div>
          </div>         <!--[if (mso)]></td></tr></table><![endif]-->
         <!--[if (IE)]></td></tr></table><![endif]-->
       </td>
     </tr>
    </tbody>
  </table>
  <!--[if (mso)]></div><![endif]-->
  <!--[if (IE)]></div><![endif]-->


</body></html>';
    return $plantilla;
}


}