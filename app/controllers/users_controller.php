<?php
class UsersController extends AppController {
//
	var $name = 'Users';
	var $uses = array('User','Group');
	var $helpers = array("Javascript");
	
	function beforeFilter() {
    	parent::beforeFilter();
		//$this->Auth->allow("add");
		$this->Auth->allow('login','logout');
		//$this->Auth->allowedActions = array('*');

	}	
	
	function login() {
		$this->Auth->loginRedirect = array('controller' => 'pessoas', 'action' => 'index');
	}
     
	function logout() {
     
		$this->redirect($this->Auth->logout());
     
	 }
	
	function index() {
		//verifica o id do ususario logado
		$this->set('grupo', $this->Auth->user("group_id"));
		//
		$this->User->recursive = 2;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		$this->User->recursive = 2;
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			if($this->data["User"]["password"] == $this->Auth->password($this->data["User"]["password_confirm"])){
				$this->User->create();
				if ($this->User->save($this->data)) {
					$this->Session->setFlash(__('O Usuário foi salvo corretamente', true),"default",array("class" => "alert-message success flash"));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('O usuário não pode ser salvo. Por favor, tente novamente.', true),"default",array("class" => "alert-message error flash"));
				}
			}else {
				$this->Session->setFlash(__('O usuário não pode ser salvo pois as senhas estão diferentes', true),"default",array("class" => "alert-message error flash"));
			}
		}

		$groups = $this->Group->find("list",array("fields" => array("Group.id","Group.nome")));
		$this->set("groups", $groups);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if($this->data["User"]["password"] == $this->Auth->password($this->data["User"]["password_confirm"])){
			
				if ($this->User->save($this->data)) {
					$this->Session->setFlash(__('O Usuário foi salvo corretamente', true),"default",array("class" => "alert-message success flash"));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('O usuário não pode ser salvo. Por favor, tente novamente', true),"default",array("class" => "alert-message error flash"));
				}
			}else {
				$this->Session->setFlash(__('O usuário não pode ser salvo pois as senhas estão diferentes', true),"default",array("class" => "alert-message error flash"));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}

		$groups = $this->Group->find("list",array("fields" => array("Group.id","Group.nome")));
		$this->set("groups", $groups);
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true),"default",array("class" => "alert-message error flash"));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true),"default",array("class" => "alert-message error success"));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true),"default",array("class" => "alert-message error flash"));
		$this->redirect(array('action' => 'index'));
	}

	    function initDB() 
	    {
		    $group =& $this->User->Group;
		    // Permite aos admins fazer tudo
		    $group->id = 1;
		    $this->Acl->allow($group, 'controllers');
		    
		    $group->id = 2;
		    $this->Acl->allow($group, 'controllers');
		    $this->Acl->deny($group, 'controllers/Users');

		    //$group->id = 3;
		    //$this->Acl->allow($group, 'controllers');
		    
		    
		    // nós adcionamos um exit para evitar que seja exibido o erro de missing views
		    echo "all done";
		    exit;
        }

        // @TODO remover depois de aplicar na produção!
        function addUsuarioGrupo()
        {
        	$usuarios = $this->User->find("all");
        	
        	foreach($usuarios as $usuario)
        	{
				$aro =& $this->Acl->Aro;

				//$user = $aro->findByForeignKeyAndModel($usuario['User']['id'], 'User');
				$group = $aro->findByForeignKeyAndModel($usuario['User']['group_id'], 'Group');
				
				// Salva na tabela ARO
				// $aro->id = $user['Aro']['id'];
				$aro->create();
				$aro->save(array('parent_id' => $group['Aro']['id'], 'model'=>'User', 'foreign_key'=>$usuario['User']['id']));
			}
			exit;
        }

}
?>