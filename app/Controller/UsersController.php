<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

	public $components = array('Paginator');

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add','login','loginData','logout','remember_password','remember_password_step_2');
    }


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}






	

	public function login() {
		$this->layout 					= false;
	}

	public function evitarExpiracion(){
		$this->autoRender 				= false;
    	@session_start();
    }

	public function loginData(){
		$this->autoRender 				= false;
		if ($this->request->is('ajax')) {
			$this->request->data['User']['email'] 			= $this->request->data['email'];
    		$this->request->data['User']['password'] 		= $this->request->data['contrasena'];
			if ($this->Auth->login()) {
				$this->Session->setFlash('Bienvenido', 'Flash/success');
				// $this->paintValidateMenu(AuthComponent::user('role'));
                return 1;
			} else {
				$this->Session->setFlash('Correo electrónico o contraseña incorrectos', 'Flash/Error');
                return 0;
			}
		}
	}

	public function logout() {
		if (AuthComponent::user('id')) {
			echo AuthComponent::user('id');
			return $this->redirect($this->Auth->logout());
		} else {
			$this->redirect(array('controller' => 'Pages','action' => 'home'));
		}
	}

	public function remember_password(){
		$this->validateSessionTrue();
		if ($this->request->is('post')) {
			$user = $this->User->get_user_email($this->request->data['User']['email']);
			if (empty($user)) {
				$this->Session->setFlash('El correo electrónico no existe en nuestra base de datos','Flash/error');
				$this->redirect(array('controller'=>'pages','action' => 'home'));
			}
			$hash = $this->User->generate_hash_change_password();
			$data = array(
				'User' => array(
					'id' => $user['User']['id'],
					'hash_change_password' => $hash
				)
			);
			$this->User->save($data);
			$options = array(
				'to'		=> $this->request->data['User']['email'],
				'template'	=> 'remember_password',
				'subject'	=> '¡Ya puedes restablecer tu contraseña!',
				'vars'		=> array('hash' => $hash, 'name' => $user['User']['name']),
			);
			$this->sendMail($options);
			$this->Session->setFlash('Ahora ingresa a tu correo electrónico y sigue las instrucciones', 'Flash/success');
			$this->redirect(array('controller'=>'pages','action' => 'home'));
		}
	}

	public function remember_password_step_2($hash = null) {
		$user = $this->User->findByHashChangePassword($hash);
		if ($user['User']['hash_change_password'] != $hash || empty($user)) {
			$this->Session->setFlash('Ocurrió un error, por favor vuelve a restablecer la contraseña','Flash/error');
			$this->redirect(array('controller'=>'pages','action' => 'home'));
		}
		if ($this->request->is('post')) {
			if ($this->request->data['User']['password'] === $this->request->data['User']['re_password']) {
				$this->request->data['User']['id'] = $user['User']['id'];
				$this->request->data['User']['hash_change_password'] = '';
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash('Se guardó la contraseña satisfactoriamente', 'Flash/success');
				} else {
					$this->Session->setFlash('No se pudo guardar la contraseña','Flash/error');
				}
				$this->redirect(array('controller'=>'pages','action' => 'home'));
			}
		}
		$this->set(compact('hash'));
	}

}