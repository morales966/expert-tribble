<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

class PagesController extends AppController {

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('home','about','businnes');
    }

    public function home(){
    	if (AuthComponent::user('id')){
			$this->redirect(array('action' => 'index'));
		}
    }

    public function about(){
    	if (AuthComponent::user('id')){
			$this->redirect(array('action' => 'index'));
		}
    }

    public function businnes(){
    	if (AuthComponent::user('id')){
			$this->redirect(array('action' => 'index'));
		}
    }

	public function index(){}

}