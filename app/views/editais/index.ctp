<?php echo $javascript->link(array("/js/jquery/jquery-1.5.2.min",
								   "/js/jquery/jquery-ui-1.8.16.custom.min",
								   "/js/validation/languages/jquery.validationEngine-pt",
								   "/js/validation/jquery.validationEngine",
								   "/js/tablesorter/jquery.tablesorter.min"),false); ?>
<?php echo $this->Html->css(array('jquery-ui-1.8.13.custom',"bootstrap","validationEngine.jquery")); ?>

<div class="block">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>
		
		<h2>Editais</h2>
	</div>		<!-- .block_head ends -->
	<div class="block_content">
		<div class="row">
			<div class="span15 columns">
			
				<table id="cursosTable" class="zebra-striped">
					<tr>
							<th>Número</th>
							<th>Ano</th>
							<th>Inicio</th>
							<th>Fim</th>
							<th class="actions">Ações</th>
					</tr>
				<?php
				foreach ($editais as $edital):
				?>
				<tr>
					<td><?php echo $edital['Edital']['numero']; ?></td>
					<td><?php echo $edital['Edital']['ano']; ?></td>
					<td><?php echo date('d/m/Y', strtotime($edital['Edital']['inicio'])); ?></td>
					<td><?php echo date('d/m/Y', strtotime($edital['Edital']['fim'])); ?></td>
					<!--
					<td class="actions">
						<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $edital['Edital']['id'])); ?>
						<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $edital['Edital']['id'])); ?>
						<?php echo $this->Html->link(__('Apagar', true), array('action' => 'delete', $edital['Edital']['id']), null, sprintf(__('Você tem certeza que deseja apagar este edital?', true), $edital['Edital']['id'])); ?>
						<?php echo $this->Html->link(__('Vagas', true), array('action' => 'add', 'controller' => 'vagas', $edital['Edital']['id'])); ?>
					</td>
					-->
					<td>
					<?php if($grupo == 1): ?>
					    
					    <?php echo $this->Html->link(
									$this->Html->image('lupa.ico',array('alt'=> __('Visualizar pessoas', true),'title'=>'visualizar', 'border' => '0')),array('action'=>'view', $edital['Edital']['id']),array('target' => '_self', 'escape' => false)); ?>

						<?php echo $this->Html->link(
							$this->Html->image('edit.ico',array('alt'=> __('Editar', true),'title'=>'editar', 'border' => '0')),array('action'=>'edit', $edital['Edital']['id']),array('target' => '_self', 'escape' => false)); ?>

						<?php echo $this->Html->link(
							$this->Html->image('del_btn.png',array('alt'=> __('Deletar pessoas', true),'title'=>'excluir', 'border' => '0')),array('action'=>'delete', $edital['Edital']['id']),array('target' => '_self', 'escape' => false), sprintf(__('Você tem certeza que deseja apagar essa pessoa?', true), $edital['Edital']['id'])); ?>
							
						<?php echo $this->Html->link(
							$this->Html->image('paper.ico',array('alt'=> __('Vagas', true),'title'=>'vagas', 'border' => '0')),array('action'=>'add','controller'=>'vagas', $edital['Edital']['id']),array('target' => '_self', 'escape' => false)); ?>
					<?php endif; ?>		
					     												
					</td>
				</tr>
			<?php endforeach; ?>
				</table>
			</div>
		</div>
		
	</div>		<!-- .block_content ends -->
	
	<div class="bendl"></div>
	<div class="bendr"></div>
</div>		<!-- .block ends -->



	
