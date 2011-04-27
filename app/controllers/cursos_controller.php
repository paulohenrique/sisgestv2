<?php
class CursosController extends AppController {

	var $name = 'Cursos';

	function index() {
		$this->Curso->recursive = 0;
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
		if (!empty($this->data)) {
			$this->Curso->create();
			
			$dados = $this->data;

			$this->data = array();
			for($i = 0; $i < 3; $i++){
				array_push($this->data,$dados);
			}
		    
			debug($this->data);

			
			
			if ($this->Curso->saveAll($this->data)) {
				$this->Session->setFlash(__('The curso has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The curso could not be saved. Please, try again.', true));
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
				$this->Session->setFlash(__('The curso has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The curso could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Curso->read(null, $id);
		}
		$disciplinas = $this->Curso->Disciplina->find('list');
		$this->set(compact('disciplinas'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for curso', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Curso->delete($id)) {
			$this->Session->setFlash(__('Curso deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Curso was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>