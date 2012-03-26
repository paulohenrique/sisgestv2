<?php
class CursosController extends AppController {

	var $name = 'Cursos';
	var $helpers = array("Javascript");

	function index() {
		//esconder as ações
        $this->Turma->recursive = 2;
		$this->set('grupo', $this->Auth->user("group_id"));
		// fim
		$this->Curso->recursive = 2;
		$this->set('cursos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid curso', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('curso', $this->Curso->read(null, $id));
	}

	function add() {
         //envia o grupo ao qual o usuario pertence para view
         
		 $this->set('grupo', $this->Auth->user("group_id"));

		if (!empty($this->data)) {
			$this->Curso->create();
			if ($this->Curso->save($this->data)) {
				$this->Session->setFlash(__('The curso has been saved', true),"default",array("class" => "alert-message success"));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The curso could not be saved. Please, try again.', true),"default",array("class" => "alert-message error"));
			}
		}
		$disciplinas = $this->Curso->Disciplina->find('list');
		$this->set(compact('disciplinas'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid curso', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Curso->save($this->data)) {
				$this->Session->setFlash(__('The curso has been saved', true),"default",array("class" => "alert-message success"));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The curso could not be saved. Please, try again.', true),"default",array("class" => "alert-message error"));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Curso->read(null, $id);
		}
		$disciplinas = $this->Curso->Disciplina->find('list',array("fields" => array("Disciplina.id","Disciplina.nome")));
		$this->set(compact('disciplinas'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for curso', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Curso->delete($id)) {
			$this->Session->setFlash(__('Curso deleted', true),"default",array("class" => "alert-message success"));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Curso was not deleted', true),"default",array("class" => "alert-message error"));
		$this->redirect(array('action' => 'index'));
	}
}
?>