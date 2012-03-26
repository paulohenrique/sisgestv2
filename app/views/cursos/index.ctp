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
		
		<h2>Cursos</h2>
	</div>		<!-- .block_head ends -->
	<div class="block_content">
		<div class="row">
			<div class="span8 columns">
			
				<table id="cursosTable" class="zebra-striped">
				<tr>
						<th>Nome</th>
						<th class="actions">Ações</th>
				</tr>
				<?php
				foreach ($cursos as $curso):
				?>
				<tr>
					<td><?php echo $curso['Curso']['nome']; ?>&nbsp;</td>
					<!--
					<td class="actions">
						<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $curso['Curso']['id'])); ?>
						<?php echo $this->Html->link(__('Apagar', true), array('action' => 'delete', $curso['Curso']['id']), null, sprintf(__('Você tem certeza que deseja apagar este curso?', true), $curso['Curso']['id'])); ?>
					</td>
					-->
					
					<td>
                    <!-- 
                         ====================================================================
					      verifica se o usuario logado é o admin se nao for esconde as ações 
                         ====================================================================
					-->

					<?php if($grupo == 1): ?> 
						<?php echo $this->Html->link(
							$this->Html->image('edit.ico',array('alt'=> __('Visualizar pessoas', true),'title'=>'editar', 'border' => '0')),array('action'=>'edit', $curso['Curso']['id']),array('target' => '_self', 'escape' => false)); ?>

						<?php echo $this->Html->link(
							$this->Html->image('del_btn.png',array('alt'=> __('Deletar pessoas', true),'title'=>'excluir', 'border' => '0')),array('action'=>'delete', $curso['Curso']['id']),array('target' => '_self', 'escape' => false), sprintf(__('Você tem certeza que deseja apagar essa pessoa?', true), $curso['Curso']['id'])); ?>
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



	
