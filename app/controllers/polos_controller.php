<?php
class PolosController extends AppController {

	var $name = 'Polos';
	var $helpers = array('Javascript');
	function index() {
		$this->Polo->recursive = 2;
		//envia o id do  grupo do usuario logado para a view
		$this->set('grupo', $this->Auth->user("group_id"));
		//
		$this->set('polos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid polo', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('polo', $this->Polo->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Polo->create();
			if ($this->Polo->save($this->data)) {
				$this->Session->setFlash(__('The polo has been saved', true),"default",array("class" => "alert-message success"));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The polo could not be saved. Please, try again.', true),"default",array("class" => "alert-message error"));
			}
		}
		$cursos = $this->Polo->Curso->find('list', array("fields" => array("Curso.id","Curso.nome")));
		$this->set(compact('cursos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid polo', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Polo->save($this->data)) {
				$this->Session->setFlash(__('The polo has been saved', true),"default",array("class" => "alert-message success"));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The polo could not be saved. Please, try again.', true),"default",array("class" => "alert-message error"));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Polo->read(null, $id);
		}
		$cursos = $this->Polo->Curso->find('list', array("fields" => array("Curso.id","Curso.nome")));
		$this->set(compact('cursos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for polo', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Polo->delete($id)) {
			$this->Session->setFlash(__('Polo deleted', true),"default",array("class" => "alert-message success"));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Polo was not deleted', true),"default",array("class" => "alert-message error"));
		$this->redirect(array('action' => 'index'));
	}
}
?>