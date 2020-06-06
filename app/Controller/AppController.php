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
        //$this->forgeSSL();
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
                    $this->Session->setFlash('La sesión se ha perdido, por favor vuelvete a iniciar sesión','Flash/error');
                    $this->redirect(array('controller' => 'Pages','action' => 'home'));
                }
            }
        }
    }

    public function deleteCache() {
        $this->Session->delete('imagen_cedula');
        $this->Session->delete('imagen_perfil');
    }

	public function sendMail($options = array()) {
        try {
            $email                      = new CakeEmail();
            $email->template($options['template'], 'default')
                ->config('default')
                ->emailFormat('html')
                ->subject($options['subject'])
                ->to($options['to'])
                ->from(Configure::read('Email.contact_mail'))
                ->viewVars($options['vars'])
                ->send();
            
        } catch(Exception $e){
            $this->log($e->getMessage(),"debug");
        }
        return true;
    }

    public function validateSessionTrue() {
        if (AuthComponent::user('id')) {
            $this->redirect(array('controller' => 'pages', 'action' => 'index'));
        }
    }

    public function replaceText($texto,$caracterRemplazar,$caracterNuevo) {
        return str_replace($caracterRemplazar,$caracterNuevo,$texto);
    }


    public function loadFile($imagen,$carpeta,$name_archivo,$session_name,$type_file) {
        if ($imagen['size'] > 0) {
            if ($imagen['error'] < 1) {
                $type_array                          = explode("/",$imagen['type']);
                if ($type_array['0'] == $type_file) {
                    $ruta_img = WWW_ROOT.'img/'.$carpeta.'/';
                    if (!file_exists($ruta_img)) {
                        mkdir($ruta_img, 0777, true);
                    }
                    $nombreImagenGuardada           = $this->name_foto($name_archivo,$type_array['1']);
                    $nombre_archivo                 = $nombreImagenGuardada;
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
