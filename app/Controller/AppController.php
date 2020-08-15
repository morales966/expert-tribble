<?php

App::uses('Controller', 'Controller'); 

class AppController extends Controller {

    public $helpers           = array('Utilities');
    public $components        = array(  
                                    'Auth' => array(
                                       'authenticate' => array(
                                            'Form' => array(
                                                'fields' => array('username' => 'email')
                                            )
                                        ),
                                        'loginAction' => array(
                                            'controller' => 'Pages','action' => 'home'
                                        ),
                                        'logoutRedirect' => array(
                                            'controller' => 'Pages','action' => 'home'
                                        )
                                    ),
                                    'Session'
                                 );

    public function beforeRender() {

    }

    public function beforeFilter(){
        // $this->forgeSSL();
        $this->validateSessionActive();
    }

   public function forgeSSL(){
       if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on") {
           header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
           exit;
       }
  }

    public function validateSessionActive(){
        if (!AuthComponent::user('id')) {
            $arrayController                        = array('css','js','Pages','Users');
            $arrayAction                            = array('loginData');
            if (!in_array($this->request->params['controller'], $arrayController)) {
                if ($this->request->params['controller'] == 'Users' && !in_array($this->request->params['action'], $arrayAction)){
                    $this->Session->setFlash('La sesión se ha perdido, por favor vuelvete a iniciar sesión','Flash/error');
                    $this->redirect(array('controller' => 'Pages','action' => 'home'));
                } else {
                    $this->Session->setFlash('La sesión se ha perdido, por favor vuélvete a iniciar sesión','Flash/error');
                    $this->redirect(array('controller' => 'Pages','action' => 'home'));
                }
            }
        }
    }

    public function saveManagesUser($description,$user_id,$url){
        $this->loadModel('Message');
        $datosM['Message']['description']                = $description;
        $datosM['Message']['url']                        = $url;
        $datosM['Message']['state']                      = Configure::read('variables.noti_por_leer');
        $datosM['Message']['user_id']                    = $user_id;
        $this->Message->create();
        $this->Message->save($datosM);
        return true;
    }

    // public function sendMailCake() {
        // try {
        //     $email                      = new CakeEmail();
        //     if (isset($options['file'])) {
        //         $email->template($options['template'], 'default')
        //             ->config('default')
        //             ->emailFormat('html')
        //             ->subject($options['subject'])
        //             ->to($options['to'])
        //             ->from(Configure::read('Email.contact_mail'))
        //             ->attachments($options['file'])
        //             ->viewVars($options['vars'])
        //             ->send();
        //     } else {
        //         $email->template($options['template'], 'default')
        //             ->config('default')
        //             ->emailFormat('html')
        //             ->subject($options['subject'])
        //             ->to($options['to'])
        //             ->from(Configure::read('Email.contact_mail'))
        //             ->viewVars($options['vars'])
        //             ->send();
        //     }
        // } catch(Exception $e){
        //     $this->log($e->getMessage(),"error"); 
        // } 
    // }

    public function sendMail($options = array()) {
        ini_set ('display_errors', 1);
        error_reporting (E_ALL);
        $from = "dlmorales096@gmail.com";
        $to = $options['to'];
        $subject = $options['subject'];
        if ($options['vCliente'] == true) {
            $message = $this->mailSend_BienvenidoCliente($options['vName'],$options['vPassword']);
        } else if($options['vUsuario'] == true) {
            $message = $this->mailSend_BienvenidoUsuario($options['vName'],$options['vPassword']);
        } else if($options['vclienteNuevo'] == true) {
            $message = $this->mailSend_BienvenidoCliente($options['vName'],$options['vPassword']);
        } else {
            $message = $this->mailSend_RememberPassword($options['vHash'],$options['vName']);
        }
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $cabeceras .= "De:". $from;
        mail ($to, $subject, $message, $cabeceras);
        return true;
    }

    public function mailSend_BienvenidoUsuario($name,$password) {
        $message = '
        <!DOCTYPE html>
        <html lang="es">
            <head>
                <title>Bienvenido</title>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <meta charset="utf-8" />
            </head>
            <body style="background-color:#f8f8f8;">
                <table align="center" style="width: 600px; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;background-color:#ffffff;">
                    <tr>
                        <td>
                            <table style="width: 600px; background-color:#ffffff; color:#111E2D; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;">
                                <tr align="center">
                                    <td style="width:50px;"></td>
                                    <td style="width:500px;">
                                        <br>
                                        <h1>
                                            <b style="color:#031730; text-transform: capitalize;">
                                                CREDIVENTAS
                                            </b>
                                        </h2>
                                    </td>
                                    <td style="width:50px;"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table style="width: 600px; background-color:#ffffff; color:#111E2D; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;">
                                <tr align="center">
                                    <td style="width:50px;"></td>
                                    <td style="width:500px;">
                                        <h2><b style="color:#031730; text-transform: capitalize;">
                                            Bienvenido '.$name.'
                                        </b></h2>
                                        <p style="color:#6f6f6f;">
                                          Ya haces parte del equipo de crediventa
                                        </p>
                                    </td>
                                    <td style="width:50px;"></td>
                                </tr>
                            </table>
                            <br>
                            <table style="width: 600px; background-color:#ffffff; color:#111E2D; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;">
                                <tr align="center">
                                    <td style="width:600px;">
                                        <p style="color: #031730;">
                                          Tu contraseña es: '.$password.'
                                        </p>
                                    </td>
                                </tr>  
                            </table>
                            <br>
                            <table style="width: 600px; background-color:#ffffff; color:#111E2D; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;">
                                <tr align="center">
                                    <td style="width:50px;"></td>
                                    <td style="width:500px;">

                                        <p style="color:#6f6f6f;">
                                          Por motivos de seguridad recuerda cambiarla cuando inicies sesión
                                      </p>
                                    </td>
                                    <td style="width:50px;"></td>
                                </tr>
                            </table>
                            <br>
                            <table border="0" align="center" cellpadding="0" cellspacing="0" class="mbtn20 mtop10" cellmargin="0">
                                <tr>
                                    <td width="225"></td>
                                    <td width="150" height="30" bgcolor="#031730" align="center">
                                    <a href="'.Router::url("/", true).'Pages/home'.'" style="color:#ffffff; text-decoration:none;">
                                        <span style="font-family:arial; font-size:14px;color:#ffffff;">IR A CREDIVENTAS.COM</span></a>
                                    </td>
                                    <td width="225"></td>

                                </tr>
                            </table>
                            <br>
                            <table style="width: 600px; background-color:#ffffff; color:#111E2D; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;">
                                <tr align="center">
                                    <td style="width:50px;"></td>
                                    <td style="width:500px;">
                                        <hr>
                                        <p style="color:#6f6f6f;"><span> Crediventas.com </span></p><br>
                                    </td>
                                    <td style="width:50px;"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
        </html>';
        return $message;
    }

    public function mailSend_BienvenidoCliente($name_cliente,$password) {
        $message = '
        <!DOCTYPE html>
        <html lang="es">
            <head>
                <title>Bienvenido</title>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <meta charset="utf-8" />
            </head>

            <body style="background-color:#f8f8f8;">
                <table align="center" style="width: 600px; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;background-color:#ffffff;">
                    <tr>
                        <td>
                            <table style="width: 600px; background-color:#ffffff; color:#111E2D; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;">
                                <tr align="center">
                                    <td style="width:50px;"></td>
                                    <td style="width:500px;">
                                        <br>
                                        <h1>
                                            <b style="color:#031730; text-transform: capitalize;">
                                                CREDIVENTAS
                                            </b>
                                        </h2>
                                    </td>
                                    <td style="width:50px;"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table style="width: 600px; background-color:#ffffff; color:#111E2D; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;">
                                <tr align="center">
                                    <td style="width:50px;"></td>
                                    <td style="width:500px;">
                                        <h2><b style="color:#031730; text-transform: capitalize;">
                                            Bienvenido '.$name_cliente.'
                                        </b></h2>
                                        <p style="color:#6f6f6f;">
                                          Ya haces parte del equipo de crediventas
                                        </p>
                                    </td>
                                    <td style="width:50px;"></td>
                                </tr>
                            </table>
                            <br>
                            <table style="width: 600px; background-color:#ffffff; color:#111E2D; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;">
                                <tr align="center">
                                    <td style="width:600px;">
                                        <p style="color: #031730;">
                                          Tu contraseña es: '.$password.'
                                        </p>
                                    </td>
                                </tr>  
                            </table>
                            <br>
                            <table style="width: 600px; background-color:#ffffff; color:#111E2D; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;">
                                <tr align="center">
                                    <td style="width:50px;"></td>
                                    <td style="width:500px;">

                                        <p style="color:#6f6f6f;">
                                          Por motivos de seguridad recuerda cambiarla cuando inicies sesión
                                      </p>
                                    </td>
                                    <td style="width:50px;"></td>
                                </tr>
                            </table>
                            <br>
                            <table border="0" align="center" cellpadding="0" cellspacing="0" class="mbtn20 mtop10" cellmargin="0">
                                <tr>
                                    <td width="225"></td>
                                    <td width="150" height="30" bgcolor="#031730" align="center">
                                        <a href="'.Router::url("/", true).'Pages/home'.'" style="color:#ffffff; text-decoration:none;">
                                            <span style="font-family:arial; font-size:14px;color:#ffffff;">IR A CREDIVENTAS.COM</span>
                                        </a>
                                    </td>
                                    <td width="225"></td>

                                </tr>
                            </table>
                            <br>
                            <table style="width: 600px; background-color:#ffffff; color:#111E2D; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;">
                                <tr align="center">
                                    <td style="width:50px;"></td>
                                    <td style="width:500px;">
                                        <hr>
                                        <p style="color:#6f6f6f;"><span> Crediventas.com </span></p><br>
                                    </td>
                                    <td style="width:50px;"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
        </html>';
        return $message;
    }

    public function mailSend_RememberPassword($hash,$name) {
        $message = '
        <!DOCTYPE html>
        <html lang="es">
            <head>
                <title>Restablecer contraseña</title>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <meta charset="utf-8" />
            </head>
            <body style="background-color:#f8f8f8;">
                <table align="center" style="width: 600px; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;background-color:#ffffff;">
                    <tr>
                        <td>
                            <table style="width: 600px; background-color:#ffffff; color:#111E2D; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;">
                                <tr align="center">
                                    <td style="width:50px;"></td>
                                    <td style="width:500px;">
                                        <br>
                                        <h1>
                                            <b style="color:#031730; text-transform: capitalize;">
                                                CREDIVENTAS
                                            </b>
                                        </h2>
                                    </td>
                                    <td style="width:50px;"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table style="width: 600px; background-color:#ffffff; color:#111E2D; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;">
                                <tr align="center">
                                    <td style="width:50px;"></td>
                                    <td style="width:500px;">
                                        <h2><b style="color:#031730; text-transform: capitalize;">
                                            Hola '.$name.'
                                        </b></h2>
                                        <p style="color:#6f6f6f;">Has solicitado restablecer tu contraseña para ingresar a CREDIVENTAS.com</p>
                                    </td>
                                    <td style="width:50px;"></td>
                                </tr>
                            </table>
                            <br>
                            <table style="width: 600px; background-color:#ffffff; color:#111E2D; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;">
                                <tr align="center">
                                    <td style="width:600px;">
                                        <p style="color: #031730;">
                                            Por favor haz clic en el siguiente enlace y continúa el proceso de restablecimiento
                                        </p>
                                        <a href="'.Router::url("/", true).'Users/remember_password_step_2/'.$hash.'">
                                            <b>Restablecer la contraseña</b>
                                        </a>
                                    </td>
                                </tr>  
                            </table>
                            <br>
                            <table style="width: 600px; background-color:#ffffff; color:#111E2D; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;">
                                <tr align="center">
                                    <td style="width:50px;"></td>
                                    <td style="width:500px;">

                                        <p style="color:#6f6f6f;">Si no fuiste tu o no necesitas realizar este procedimiento por favor ignora este mensaje y accede normalmente a tu cuenta.</p>
                                    </td>
                                    <td style="width:50px;"></td>
                                </tr>
                            </table>
                            <br>
                            <table border="0" align="center" cellpadding="0" cellspacing="0" class="mbtn20 mtop10" cellmargin="0">
                                <tr>
                                    <td width="225"></td>
                                    <td width="150" height="30" bgcolor="#031730" align="center">
                                        <a href="'.Router::url("", true).'Pages/home'.'" style="color:#ffffff; text-decoration:none;">
                                            <span style="font-family:arial; font-size:14px;color:#ffffff;">IR A CREDIVENTAS.COM</span>
                                        </a>
                                    </td>
                                    <td width="225"></td>

                                </tr>
                            </table>
                            <br>
                            <table style="width: 600px; background-color:#ffffff; color:#111E2D; display:block; margin: 0 auto; border-collapse: collapse; font-family: Helvetica, Arial, Sans-Serif;">
                                <tr align="center">
                                    <td style="width:50px;"></td>
                                    <td style="width:500px;">
                                        <hr>
                                        <p style="color:#6f6f6f;"><span> Crediventas.com </span></p><br>
                                    </td>
                                    <td style="width:50px;"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
        </html>';
        return $message;
    }

    public function validateSessionTrue() {
        if (AuthComponent::user('id')) {
            $this->redirect(array('controller' => 'pages', 'action' => 'index'));
        }
    }

    public function replaceText($texto,$caracterRemplazar,$caracterNuevo) {
        return str_replace($caracterRemplazar,$caracterNuevo,$texto);
    }

    public function deleteCache() {
        $this->Session->delete('archivo_foto_cedula_delantera');
        $this->Session->delete('archivo_foto_cedula_trasera');
        $this->Session->delete('archivo_perfil');
        $this->Session->delete('documento_modelo');
        $this->Session->delete('archivo_adjuntar_cedula_delantera');
        $this->Session->delete('archivo_adjuntar_cedula_trasera');
        $this->Session->delete('archivo_adjuntar_camara_comercio');
        $this->Session->delete('archivo_adjuntar_rut');
        $this->Session->delete('archivo_adjuntar_administrador');
        $this->Session->delete('archivo_adjuntar_almacen');
    }

    public function loadDocumentPdf($documento,$carpeta){
        if ($documento['error'] < 1) {
            $type_array                          = explode("/",$documento['type']);
            $ruta_archivo                        = WWW_ROOT.'files/'.$carpeta.'/';
            $nombre_archivo                      = $this->name_foto('pan_pagos',$type_array['1']);
            $this->Session->write('documento_modelo', $nombre_archivo);
            if(move_uploaded_file($documento['tmp_name'], $ruta_archivo.$nombre_archivo)) {
                return 1;
            } else{
                return 5;
            }
        } else {
            return 2;
        }
    }

    public function loadArchives($documento,$carpeta,$name_archivo,$session_name){
        if ($documento['error'] < 1) {
            $type_array                          = explode("/",$documento['type']);
            $ruta_archivo                        = WWW_ROOT.'files/'.$carpeta.'/';
            $nombre_archivo                      = $this->name_foto($name_archivo,$type_array['1']);
            $this->Session->write('archivo_'.$session_name,$nombre_archivo);
            if(move_uploaded_file($documento['tmp_name'], $ruta_archivo.$nombre_archivo)) {
                return 1;
            } else{
                return 5;
            }
        } else {
            return 2;
        }
    }

    public function loadFile($imagen,$carpeta,$name_archivo,$session_name,$type_file) {
        if ($imagen['size'] > 0) {
            if ($imagen['error'] < 1) {
                $type_array                          = explode("/",$imagen['type']);
                if ($type_array['0'] == $type_file) {
                    $ruta_img                       = WWW_ROOT.'img/'.$carpeta.'/';
                    $nombre_archivo                 = $this->name_foto($name_archivo,$type_array['1']);
                    // if (!file_exists($ruta_img.$nombre_archivo)) {
                    //     mkdir($ruta_img.$nombre_archivo, 0777, true);
                    // }
                    $this->Session->write('archivo_'.$session_name,$nombre_archivo);
                    if(move_uploaded_file($imagen['tmp_name'], $ruta_img.$nombre_archivo)) {
                        return 1;
                    } else{
                        return 5;
                    }
                } else {
                    return 4;
                }
            } else {
                return 2;
            }
        } else {
            return 3;
        }
    }

    public function name_foto($name_archivo,$ext) {
        return $name_archivo.'_'.uniqid().'.'.$ext;
    }

    public function validateImageState($imagen) {
        switch ($imagen) {
            case 3:
                $this->Session->setFlash('La imagen es necesaria','Flash/error');
                break;
             case 4:
                $this->Session->setFlash('El archivo no es el documento requerido','Flash/error');
                break;

            default:
                $this->Session->setFlash('El archivo se encuentra dañado, no se ha podido subir al servidor','Flash/error');
                break;
        }
    }

    public function deleteImageServer($ruta) {
        if (file_exists($ruta)) {
            unlink($ruta);
        }
        return true;
    }

    
}
