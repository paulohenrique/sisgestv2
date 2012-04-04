<?php 
	class VinculosController extends appController
	{
		var $name = 'Vinculos';
		var $helpers = array("Javascript");

		function index() 
		{
			//esconder as ações
	        $this->Turma->recursive = 2;
		    $this->set('grupo', $this->Auth->user("group_id"));
			// fim
			$this->Vinculo->recursive = 2;
			$this->set('vinculos', $this->paginate());
	    }

	    function add()
	    {
		    	if (!empty($this->data)) {
				    $this->Vinculo->create();
				if ($this->Vinculo->save($this->data)) {
					$this->Session->setFlash(__('The curso has been saved', true),"default",array("class" => "alert-message success"));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The curso could not be saved. Please, try again.', true),"default",array("class" => "alert-message error"));
				}
			}

	    }

	    function delete($id = null) 
	    {
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for vínculo', true));
				$this->redirect(array('action'=>'index'));
			}
			if ($this->Vinculo->delete($id)) {
				$this->Session->setFlash(__('Vínculo deleted', true),"default",array("class" => "alert-message success"));
				$this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('Vínculo was not deleted', true),"default",array("class" => "alert-message error"));
			$this->redirect(array('action' => 'index'));
	    }

	    function edit($id = null) 
	    {
			if (!$id && empty($this->data)) 
			{
				$this->Session->setFlash(__('Invalid vínculo', true));
				$this->redirect(array('action' => 'index'));
			}
			if (!empty($this->data)) 
			{
				if ($this->Vinculo->save($this->data)) 
				{
					$this->Session->setFlash(__('The vinculo has been saved', true),"default",array("class" => "alert-message success"));
					$this->redirect(array('action' => 'index'));
				}
				else 
				{
					$this->Session->setFlash(__('The vinculo could not be saved. Please, try again.', true),"default",array("class" => "alert-message error"));
				}
			}
			if (empty($this->data))
			{
				$this->data = $this->Vinculo->read(null, $id);
			}
		
	   }


	}


 ?>