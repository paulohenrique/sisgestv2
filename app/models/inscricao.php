<?php
class Inscricao extends AppModel {
	var $name = 'Inscricao';
	var $useDbConfig = 'schema_uab';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Pessoa' => array(
			'className' => 'Pessoa',
			'foreignKey' => 'pessoa_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Vaga' => array(
			'className' => 'Vaga',
			'foreignKey' => 'vaga_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>