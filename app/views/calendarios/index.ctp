<?php echo $javascript->link(array('jquery/jquery-1.5.2.min.js','jquery/jquery-ui-1.8.13.custom.min.js'),false); ?>
<?php echo $this->Html->css('jquery-ui-1.8.13.custom'); ?>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		
		$("#curso").val(0);
		
		$("#curso").bind('change', function() {
			$.post("<?php echo Dispatcher::baseUrl();?>/calendarios/getTurmasByCurso/" + $(this).val(), function(data) {
		        $("#turma_id").empty().append(data);
		    }, 'html');
		});
		
		$("#form").submit(function(){
			var value = $('#turma_id :selected').val();
			$(this).attr("action","<?php echo Dispatcher::baseUrl();?>/calendarios/view/"+value); 
			
		});
		
	});
</script>

<div class="block small left">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>
		
		<h2>Left column</h2>	
	</div>		<!-- .block_head ends -->
	
	<div class="block_content">
		
		<form id="form" action="" method="post">
			<p><?php echo $this->Form->input('curso',array('options' => $cursos,'empty' => 'Selecione...','class' => "styled"));?></p>
			<p><?php echo $this->Form->input('turma_id',array('type' => "select",'empty' => 'Selecione...','class' => "styled")); ?></p>
		
			<p>
				<input type="submit" class="submit long" value="Ver calendários" id="button"/>
			</p>
		</form>


</div>		<!-- .block_content ends -->
<div class="bendl"></div>
<div class="bendr"></div>
</div>		<!-- .block.small.left ends -->