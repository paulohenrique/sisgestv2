<?php
class PessoasController extends AppController {
    

	var $name = 'Pessoas';
	var $helpers = array('Javascript',"Estudo", "Util",'Html','Form');
	var $uses = array('Pessoa','Formacao', "Atuacao", "Curso", "Disciplina", "Funcao", 'Vaga','Inscricao','Edital', 'Vinculo');
	
	
	function beforeFilter() {
    	parent::beforeFilter();
    	$this->Auth->allow('add','vaga','getPolos','getCursos','getDisciplinas','validaCPF','salvarDadosPessoa');
	}
	
	function index() {
		//verifica o grupo do usuario logado
		$this->set('grupo', $this->Auth->user("group_id"));
		//

		$this->Pessoa->recursive = 2;
		$pessoas = $this->Pessoa->find("all");
		$this->set("pessoas",$pessoas);	
		
	}

    //Lista de pessoas com dados pessoais
    function dado() {
	
		$pessoas = $this->Pessoa->find("all");
		$this->set("pessoas",$pessoas);	
		
	}
	
	function view($id = null){
		$this->Pessoa->recursive = 2;
		$pessoa = $this->Pessoa->findById($id);
		$this->set("pessoa",$pessoa);
		//debug($pessoa);
	}
	
	
	function add(){
		if (!empty($this->data)) {
			
			if($this->Pessoa->findByCpf($this->data['Pessoa']['cpf'])){
				$this->Session->setFlash(__('Prezado candidato, você já está cadastrado no sistema. Portanto, não pode realizar um novo cadastro.', true),"default",array("class" => "alert-message error"));
				$this->redirect('/cadastro');
			}
			
			$this->data["Pessoa"]["endereco"] = $this->data["Pessoa"]["rua"].", ".$this->data["Pessoa"]["numero"]." ".$this->data["Pessoa"]["complemento"]." - ".$this->data["Pessoa"]["bairro"].", ".$this->data["Pessoa"]["cidade"]." - ".$this->data["Pessoa"]["estado"].", ".$this->data["Pessoa"]["cep"];
			
			if ($this->Session->check('Pessoa')) {
				$this->Session->delete('Pessoa');
			}
			
			$this->Session->write('Pessoa', $this->data['Pessoa']);
			
			//if ($this->Session->read('Auth.User')){
				$this->redirect(array('controller' => 'atuacoes','action' => 'add', $this->Pessoa->getLastInsertID()));
			//}else{
				$this->redirect(array('controller' => 'formacoes','action' => 'add', $this->Pessoa->getLastInsertID()));
			//}
			
		}
		
		$cursos = $this->Curso->find("list",array("fields" => array("Curso.id","Curso.nome")));
		$this->set("cursos", $cursos);
        
		$disciplinas = $this->Disciplina->find("list",array("fields" => array("Disciplina.id","Disciplina.nome")));
		$this->set("disciplinas", $disciplinas);
        
		$funcoes = $this->Funcao->find("list",array("fields" => array("Funcao.id","Funcao.funcao")));
		$this->set("funcoes", $funcoes);

		$vinculos = $this->Vinculo->find("list",array("fields" => array("Vinculo.id","Vinculo.vinculo")));
		$this->set("vinculos", $vinculos);

		/*$vinculos = $this->Vinculo->find("list",array("fields" => array("Vinculo.id","Vinculo.vinculo")));
		$this->set("vinculos", $vinculos);
        */		
		
	}
	
	function edit($id = null){
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Pessoa Inválida', true));
			$this->redirect(array('controller' => 'pessoas','action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Pessoa->save($this->data)) {
				$this->Session->setFlash(__('The turma has been saved', true),"default",array("class" => "alert-message success"));
				$this->redirect(array('action' => 'view',$id));
			} else {
				$this->Session->setFlash(__('The turma could not be saved. Please, try again.', true),"default",array("class" => "alert-message error"));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->Pessoa->read(null, $id);
			$this->data["Pessoa"]['nascimento'] = date('d/m/Y', strtotime($this->data["Pessoa"]["nascimento"]));
		}
		
		
	}
	
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for turma', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Pessoa->delete($id)) {
			$this->Session->setFlash(__('Turma deleted', true),"default",array("class" => "alert-message success"));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Turma was not deleted', true),"default",array("class" => "alert-message error"));
		$this->redirect(array('action' => 'index'));
	}
	
	
	
    

	function vaga($edital_id = null){
		if (!empty($this->data)) {

			$this->salvarDadosPessoa();

			$last_pessoa = $this->Pessoa->find('first', array("order" => "Pessoa.id DESC", 'fields' => array('Pessoa.id'), 'recursive' => 0));
			$this->data['Inscricao']['pessoa_id'] = $last_pessoa['Pessoa']['id'];
			
			$vaga = $this->Vaga->find('first', array('conditions' => array('edital_id' => $this->data['Inscricao']['edital_id'],
			 															   'polo_id' => $this->data['Inscricao']['polo_id'],
																		   'curso_id' => $this->data['Inscricao']['curso_id'],
																		   'disciplina_id' => $this->data['Inscricao']['disciplina_id'])));
			$this->data['Inscricao']['vaga_id'] = $vaga['Vaga']['id'];
			if($this->Inscricao->save($this->data)) {
				$this->Session->write('pessoa_id',$this->data['Inscricao']['pessoa_id']);
				$this->Session->setFlash(__('Inscricao salva', true),"default",array("class" => "alert-message success"));
				$this->redirect(array('action' => 'finalizada', 'controller' => 'inscricoes'));
			} else {
				$this->Session->setFlash(__('The turma could not be saved. Please, try again.', true),"default",array("class" => "alert-message error"));
			}
			
		}
		
		$editais = $this->Edital->find('all', array('fields' => array('DISTINCT Edital.id','Edital.numero','Edital.ano')));
		
		foreach($editais as $edital){
			$nome = $edital['Edital']['numero']."/".$edital['Edital']['ano'];
			$list_editais[$edital['Edital']['id']] = $nome;
		}
		
		$this->set(compact('list_editais'));
	}
	
	function salvarDadosPessoa(){
		$pessoa['Pessoa'] = $this->Session->read('Pessoa');
		
		
		
		$this->Pessoa->create();
		
		if($this->Pessoa->save($pessoa)){
			$pessoa_id = $this->Pessoa->find('first',array('order'=>array('Pessoa.id DESC'), 'fields' => array('Pessoa.id')));
			$this->salvarDadosAtuacao($pessoa_id);
			$this->salvarDadosFormacao($pessoa_id);
			
			$this->Session->setFlash(__('Cadastro efetuado com sucesso !', true),"default",array("class" => "alert-message success"));
			$this->redirect(array('action' => 'view',$pessoa_id['Pessoa']['id']));
			//$this->set('pes',$pessoa_id);


		}
	}

	function salvarDadosAtuacao($pessoa_id){
		
		$pessoa_id = $this->Pessoa->find('first',array('order'=>array('Pessoa.id DESC'), 'fields' => array('Pessoa.id')));
		$atuacoes['Atuacao'] = $this->Session->read('Atuacao');

		foreach($atuacoes['Atuacao'] as $key => $atuacao){
			$atuacoes['Atuacao'][$key]['pessoa_id'] = $pessoa_id['Pessoa']['id'];
		}
		$this->Atuacao->create();
		if($this->Atuacao->saveAll($atuacoes['Atuacao'])){
			$this->log('Salvou tudo corretamente', LOG_DEBUG);
		}
			
	}

	function salvarDadosFormacao($pessoa_id){
		$formacoes['Formacao'] = $this->Session->read('Formacao');

		foreach($formacoes['Formacao'] as $key => $formacao){
			$formacoes['Formacao'][$key]['pessoa_id'] = $pessoa_id['Pessoa']['id'];
		}
		$this->Formacao->create();
		if($this->Formacao->saveAll($formacoes['Formacao'])){
			$this->log('Salvou tudo corretamente', LOG_DEBUG);
		}
	}

	//AJAX
	function getPolos($edital_id){
		$polos = $this->Vaga->find('all', array('conditions' => array("edital_id" => $edital_id),'fields' => array('DISTINCT Polo.id','Polo.nome'))); 
		
		foreach($polos as $polo){
			$id = $polo['Polo']['id'];
			$nome = $polo['Polo']['nome'];
			echo "<option value=$id>$nome</option>";
		}
		
	}
	function getCursos($edital_id, $polo_id){
		
		$cursos = $this->Vaga->find('all', array('conditions' => array("edital_id" => $edital_id, "polo_id" => $polo_id),'fields' => array('DISTINCT Curso.id','Curso.nome'))); 
		
		foreach($cursos as $curso){
			$id = $curso['Curso']['id'];
			$nome = $curso['Curso']['nome'];
			echo "<option value=$id>$nome</option>";
		}
	}
	
	function getDisciplinas($edital_id, $polo_id, $curso_id){
		
		$disciplinas = $this->Vaga->find('all', array('conditions' => array("edital_id" => $edital_id, "polo_id" => $polo_id,'curso_id' => $curso_id),'fields' => array('DISTINCT Disciplina.id','Disciplina.nome')));
		
		foreach($disciplinas as $disciplina){
			$id = $disciplina['Disciplina']['id'];
			$nome = $disciplina['Disciplina']['nome'];
			echo "<option value=$id>$nome</option>";
		}
	}
	
	function status($pessoa_id = null){
		
		if(!empty($this->data)){
			$this->Pessoa->read(null, $this->data["Pessoa"]['id']);
			$this->Pessoa->set(array(
				'status' => $this->data['Pessoa']['status']
			));
			
			if($this->Pessoa->save()){
				$this->redirect(array('action'=>'index'));
			}
		}
		
		$this->Pessoa->recursive = 0;
		$pessoa = $this->Pessoa->read(array("id"), $pessoa_id);
		$this->set("pessoa",$pessoa);
	}
	
	function validaCPF(){
		Configure::write('debug', 0); 
		$this->autoRender = false;
		
		$cpf = $this->params['url']['fieldValue'];
		$field = $this->params['url']['fieldId'];
		
		if($this->Pessoa->findByCpf($cpf)){
			echo "[ \"$field\" ,false]";
		}else {
			echo "[ \"$field\" ,true]";
		}
		
	}


	/*function export_xls() {
		$this->Pessoa->recursive = 2;
		$data = $this->Pessoa->find('all');
		
		$this->set('pessoas',$data);
		$this->render('export_xls','export_xls');

	}
*/

		function export_xls()
		{
			if(!empty($this->data)) {
				$this->Pessoa->recursive = -1;
				$fields = $this->data['Pessoa']['fields'];
				$data = $this->Pessoa->find('all',array('fields' => $fields));

				$this->set('pessoas',$data);
				$this->set('fields',$fields);
				$this->render('export_xls','export_xls');	
			} 


			$this->render('preparar_xls');
		}
	
}	
	
?>