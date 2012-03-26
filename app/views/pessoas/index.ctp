


<?php echo $javascript->link(array("/js/jquery/jquery-1.5.2.min",
								   "/js/jquery/jquery-ui-1.8.16.custom.min",
								   "/js/datatable/jquery.dataTables.min",
								   "/js/datatable/ZeroClipboard",
								   "/js/datatable/TableTools.min"),false); ?>


<?php echo $this->Html->css(array('jquery-ui-1.8.13.custom',"style_white","/css/white_label/jquery.datatables",'TableTools')); ?>

<script>
	$(document).ready( function () {
    $('#pessoas_table').dataTable( {
        "sDom": 'T<"clear">lfrtip',
        "oTableTools":
        {
            "sSwfPath": "<?php echo Dispatcher::baseUrl();?>/swf/copy_cvs_xls_pdf.swf"            
        },
        "sPaginationType": "full_numbers",
        "oLanguage":
        {
		    "sUrl": "<?php echo Dispatcher::baseUrl();?>/js/datatable/pt_BR.txt"
        }
    } );
} );

</script>
<style>

#pessoas_table{
	width: 100%;
	border-collapse:collapse;
	hi
	
}
#edit-status{
	text-align:center;
}
.status{
	cursor: pointer;
}
.statusOptions{
	margin-top:20px;
}
label{
	margin-right: 5px;
}
</style>

<div class="block">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>
		
		<h2>Pessoas</h2>	
	</div>		<!-- .block_head ends -->

	<div class="block_content">
		
		<div class="row">
	    <div class="span14 columns">
	    	<table id="pessoas_table">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Email</th>
						<th>Contato</th>
						<th>Atuações</th>
						<th style="width: 350px">Formacao</th>
						<th>Status</th>
						<th>Ações</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($pessoas as $pessoa): ?>
						<tr>
							<td><?php echo $pessoa['Pessoa']['nome']; ?></td>
							<td><?php echo $pessoa['Pessoa']['email']; ?></td>
							<td><?php echo $pessoa['Pessoa']['cel']." / ".$pessoa['Pessoa']['tel'] ; ?></td>
							<td>
								<?php foreach ($pessoa["Atuacao"] as $atuacao): ?>
									<?php echo $atuacao['Funcao']['funcao']." - ".$atuacao["ano"].".".$atuacao["semestre"]; ?><br />
								<?php endforeach; ?>
							</td>
							<td>
								<?php foreach ($pessoa["Formacao"] as $formacao): ?>
									<?php echo $formacao["curso"]." - ".$formacao["instituicao"]."/".$formacao["conclusao"] ?><br />
								<?php endforeach; ?>
							</td>
							
							<td>
								<div class="status">
									<?php echo $this->Html->link(__($this->Util->showStatus($pessoa['Pessoa']['status']), true), array('action' => 'status', $pessoa['Pessoa']['id'])); ?>
								</div>
							</td>
						<!--coluna anteriorr -->

						<!--<td>
								<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $pessoa['Pessoa']['id'])); ?>
								<?php echo $this->Html->link(__('Apagar', true), array('action' => 'delete', $pessoa['Pessoa']['id']), null, sprintf(__('Você tem certeza que deseja apagar essa pessoa?', true), $pessoa['Pessoa']['id'])); ?>
							</td>
						-->	 
							<td>

							<?php if($grupo == 1): ?>
								<?php echo $this->Html->link(
									$this->Html->image('lupa.ico',array('alt'=> __('Visualizar pessoas', true),'title'=>'visualizar', 'border' => '0')),array('action'=>'view', $pessoa['Pessoa']['id']),array('target' => '_self', 'escape' => false)); ?>
							
									

							
								<?php echo $this->Html->link(
									$this->Html->image('del_btn.png',array('alt'=> __('Deletar pessoas', true),'title'=>'excluir','border' => '0')),array('action'=>'delete', $pessoa['Pessoa']['id']),array('target' => '_self', 'escape' => false), sprintf(__('Você tem certeza que deseja apagar essa pessoa?', true), $pessoa['Pessoa']['id'])); ?>
							    <?php endif; ?> 									
							</td>		
								
							 
						</tr>	  	 
					<?php endforeach; ?>
				</tbody>
			</table>
			
	    </div>
	   
	    </div>
		
		
	
	</div>		<!-- .block_content ends -->

	 <div class="bendl"></div>
	 <div class="bendr"></div>

</div>		<!-- .block.small.left ends -->

	<!-- Icon XlS para gerar a planilha -->
	<!--
    <?php echo $this->Html->link(
			$this->Html->image('planilha.ico', array('alt'=> __('Download da planilha', true),'title'=>'relatório', 'border' => '0')),
			'/pessoas/export_xls/',
			array('target' => '_blank', 'escape' => false)
		);
	?>
	
   -->
  