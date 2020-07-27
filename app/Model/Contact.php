<?php
App::uses('AppModel', 'Model');

class Contact extends AppModel {

	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(26-07-2020)
        * @description Metodo que se encargara de devolver todos los contactos
        * @return Datos de los contactos
    */
	public function all_datos() {
		$order					= array('Contact.id' => 'desc');
		return $this->find('all',compact('order')); 
	}

}