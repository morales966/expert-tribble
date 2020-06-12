<?php

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