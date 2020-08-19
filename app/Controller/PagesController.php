<?php

App::uses('AppController', 'Controller');

class PagesController extends AppController {

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('home','guardar_fotoCD','guardar_fotoCT','guardar_fotoFP','foto_guardaname_foto');
    }

    public function home(){
        $this->layout = "landing";
    	if (AuthComponent::user('id')){
			$this->redirect(array('controller' => 'Credits','action' => 'index'));
		}
    }

	public function index(){

    }

    public function guardar_fotoCD() {
        $this->autoRender               = false;
        $imagenCodificada               = file_get_contents("php://input");
        //La imagen traerá al inicio data:image/png;base64, cosa que debemos remover
        $imagenCodificadaLimpia         = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));
        //Venía en base64 pero sólo la codificamos así para que viajara por la red, ahora la decodificamos y
        //todo el contenido lo guardamos en un archivo
        $imagenDecodificada             = base64_decode($imagenCodificadaLimpia);
        $nombreImagenGuardada           = $this->foto_guardaname_foto('foto_cedula_delantera');
        $dir_to_save                    = WWW_ROOT.'img/creditos/cedula/';
        file_put_contents($dir_to_save.$nombreImagenGuardada,$imagenDecodificada);
        return $nombreImagenGuardada;
    }

    public function guardar_fotoCT() {
        $this->autoRender               = false;
        $imagenCodificada               = file_get_contents("php://input");
        //La imagen traerá al inicio data:image/png;base64, cosa que debemos remover
        $imagenCodificadaLimpia         = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));
        //Venía en base64 pero sólo la codificamos así para que viajara por la red, ahora la decodificamos y
        //todo el contenido lo guardamos en un archivo
        $imagenDecodificada             = base64_decode($imagenCodificadaLimpia);
        $nombreImagenGuardada           = $this->foto_guardaname_foto('foto_cedula_trasera');
        $dir_to_save                    = WWW_ROOT.'img/creditos/cedula/';
        file_put_contents($dir_to_save.$nombreImagenGuardada,$imagenDecodificada);
        return $nombreImagenGuardada;
    }

    public function guardar_fotoFP() {
        $this->autoRender               = false;
        $imagenCodificada               = file_get_contents("php://input");
        //La imagen traerá al inicio data:image/png;base64, cosa que debemos remover
        $imagenCodificadaLimpia         = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));
        //Venía en base64 pero sólo la codificamos así para que viajara por la red, ahora la decodificamos y
        //todo el contenido lo guardamos en un archivo
        $imagenDecodificada             = base64_decode($imagenCodificadaLimpia);
        $nombreImagenGuardada           = $this->foto_guardaname_foto('perfil');
        $dir_to_save                    = WWW_ROOT.'img/creditos/perfil/';
        file_put_contents($dir_to_save.$nombreImagenGuardada,$imagenDecodificada);
        return $nombreImagenGuardada;
    }

    public function foto_guardaname_foto($name_archivo) {
        return $name_archivo.'_'.uniqid().".png";;
    }

}