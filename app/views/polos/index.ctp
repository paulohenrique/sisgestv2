<?php echo $javascript->link(array("/js/jquery/jquery-1.5.2.min",
								   "/js/jquery/jquery-ui-1.8.16.custom.min",
								   "/js/validation/languages/jquery.validationEngine-pt",
								   "/js/validation/jquery.validationEngine",
								   "/js/tablesorter/jquery.tablesorter.min"),false); ?>
<?php echo $this->Html->css(array('jquery-ui-1.8.13.custom',"bootstrap","validationEngine.jquery")); ?>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
    	$("#turmasTable").tablesorter({ sortList: [[0,1]] });
		
	});
</script>

<div class="block">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>
		
		<h2>Turmas</h2>
	</div>		<!-- .block_head ends -->
	<div class="block_content">
		<div class="row">
			<div class="span8 columns">
			
				<table id="polosTable" class="zebra-striped">
				<tr>
					<th><?php echo $this->Paginator->sort('nome');?></th>
					<th class="actions"><?php __('Actions');?></th>
				</tr>
				<?php
				foreach ($polos as $polo):

				?>
				<tr>
					<td><?php echo $polo['Polo']['nome']; ?>&nbsp;</td>
					<!--
					<td class="actions">
						<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $polo['Polo']['id'])); ?>
						<?php echo $this->Html->link(__('Apagar', true), array('action' => 'delete', $polo['Polo']['id']), null, sprintf(__('Você tem certeza que deseja apagar este pólo?', true), $polo['Polo']['id'])); ?>
					</td>
					-->

					<td class="actions">
                    <!--
                    ================================================================
                    Verifica se o usuario logado é admin se nao for esconde as ações
                    ================================================================
                    -->
					<?php if($grupo == 1): ?>
						<?php echo $this->Html->link(
							$this->Html->image('edit.ico',array('alt'=> __('Editar pessoas', true),'title'=>'editar','border' => '0')),array('action'=>'edit', $polo['Polo']['id']),array('target' => '_self', 'escape' => false)); ?>

						<?php echo $this->Html->link(
							$this->Html->image('del_btn.png',array('alt'=> __('Deletar pessoas', true),'title'=>'excluir', 'border' => '0')),array('action'=>'delete', $polo['Polo']['id']),array('target' => '_self', 'escape' => false), sprintf(__('Você tem certeza que deseja apagar essa pessoa?', true), $polo['Polo']['id'])); ?>
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



	
	
	
	
	