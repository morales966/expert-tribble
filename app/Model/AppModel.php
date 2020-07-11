<?php

App::uses('Model', 'Model');

class AppModel extends Model {
	/**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(07-06-2020)
        * @description Metodo para buscar el proximo ID ya que aveces hay problemas con cakephp para insertar un nuevo registro
        * @return Proximo ID de la tabla(modelo)
    */
    public function new_row_model() {
        return $this->find('count');
    }

    /**
        * @author Diego Morales <dlmorales096@gmail.com>
        * @date(07-06-2020)
        * @description Metodo que se encarga de devolver los datos del registro
        * @variables $model = nombre de la tabla(modelo), $model_id = id de la fila a devolver
        * @return Ddatos del registro
    */
    public function get_data($model,$model_id) {
		$this->recursive 	= -1;
		$conditions 		= array($model.'.id' => $model_id);
		return $this->find('first',compact('conditions')); 
	}
}
