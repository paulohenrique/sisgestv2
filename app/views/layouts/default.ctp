<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=7" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SisGest &#9679; Index</title>
		<?php echo $this->Html->css(array('style','jquery.wysiwyg','facebox', 'visualize')) ?>
		<?php echo $scripts_for_layout; ?>
		<!--[if lt IE 8]><style type="text/css" media="all">@import url("/adminus/css/ie.css");</style><![endif]-->
		
</head>
<body>
	<div id="hld">
		<div class="wrapper">		<!-- wrapper begins -->
			<div id="header">
				<div class="hdrl"></div>
				<div class="hdrr"></div>
				
				<h1><a href="<?php echo Dispatcher::baseUrl();?>">sisgest</a></h1>
				
				<ul id="nav">
					<li><a href="#">Cursos</a>
						<ul>
							<li><a href="<?php echo Dispatcher::baseUrl();?>/cursos/index/">Mostrar</a>			
							</li>
							<li><a href="<?php echo Dispatcher::baseUrl();?>/cursos/add/">Adicionar</a></li>
							</li>
						</ul>
					</li>
					<li><a href="#">Vínculos</a>
						<ul>
							<li><a href="<?php echo Dispatcher::baseUrl();?>/vinculos/index/">Mostrar</a>			
							</li>
							<li><a href="<?php echo Dispatcher::baseUrl();?>/vinculos/add/">Adicionar</a></li>
							</li>
						</ul>
					</li>
					<li><a href="#">Turmas</a>
						<ul>
							<li><a href="<?php echo Dispatcher::baseUrl();?>/turmas/index/">Mostrar</a></li>
							<li><a href="<?php echo Dispatcher::baseUrl();?>/turmas/add/">Adicionar</a></li>
							</li>
						</ul>
					</li>
					<li><a href="#">Disciplinas</a>
						<ul>
							<li><a href="<?php echo Dispatcher::baseUrl();?>/disciplinas/index/">Mostrar</a></li>
							<li><a href="<?php echo Dispatcher::baseUrl();?>/disciplinas/add/">Adicionar</a></li>
							<!--
							<li><a href="<?php echo Dispatcher::baseUrl();?>/disciplinas/export_xls/">Relatório</a></li>-->
							</li>
						</ul>
					</li>
					<li><a href="#">Polos</a>
						<ul>
							<li><a href="<?php echo Dispatcher::baseUrl();?>/polos/index/">Mostrar</a></li>
							<li><a href="<?php echo Dispatcher::baseUrl();?>/polos/add/">Adicionar</a></li>
							</li>
						</ul>
					</li>
					<li><a href="#">Pessoas</a>
						<ul>
							<li><a href="<?php echo Dispatcher::baseUrl();?>/pessoas/index/">Mostrar</a></li>
							<li><a href="<?php echo Dispatcher::baseUrl();?>/pessoas/add/">Adicionar</a></li>
							<li><a href="<?php echo Dispatcher::baseUrl();?>/inscricoes/index/">Inscrições</a></li>
							<li>
								<!--<a href="<?php echo Dispatcher::baseUrl();?>">Relatório</a> --><a>Relatório</a>
								<ul>
									<li> <a href="<?php echo Dispatcher::baseUrl();?>/pessoas/export_xls/">Pessoas</a> </li>
								</ul>
							</li>
							</li>
						</ul>
					</li>
					<li><a href="#">Calendários</a>
						<ul>
							<li><a href="<?php echo Dispatcher::baseUrl();?>/calendarios/index/">Mostrar</a></li>
							<li><a href="<?php echo Dispatcher::baseUrl();?>/calendarios/add/">Adicionar</a></li>
							</li>
						</ul>
					</li>
					<li><a href="#">Usuários</a>
						<ul>
							<li><a href="<?php echo Dispatcher::baseUrl();?>/users/index/">Mostrar</a></li>
							<li><a href="<?php echo Dispatcher::baseUrl();?>/users/add/">Adicionar</a></li>
							</li>
						</ul>
					</li>
					<li><a href="#">Editais</a>
						<ul>
							<li><a href="<?php echo Dispatcher::baseUrl();?>/editais/index/">Mostrar</a></li>
							<li><a href="<?php echo Dispatcher::baseUrl();?>/editais/add/">Adicionar</a></li>
							<li><a href="<?php echo Dispatcher::baseUrl();?>/inscricoes/inscritos/">Inscritos</a></li>
							</li>
						</ul>
					</li>
				</ul>
				
				<?php if($this->Session->read('Auth.User')): ?>
					<p class="user">Oi, <?php $nome = explode(" ",$this->Session->read('Auth.User.nome')); echo $nome[0]." ".$nome[count($nome)-1] ?>| 
					<?php echo $this->Html->link("Logout", array("controller" => "users", "action" => "logout")) ?>
					</p>
				<?php endif; ?>
			</div>		<!-- #header ends -->
			     
			
			<?php //echo $this->Session->flash(); ?>

			<?php echo $this->Session->flash('auth'); ?>
			

			<?php echo $content_for_layout; ?>

			
			<div id="footer">
			
				<p class="left">developed by <a href="http://www.ifce.edu.br/">DEaD/IFCE</a></p>
				<p class="right">powered by CentOS6</p>
				
			</div>
		
		
		</div>						<!-- wrapper ends -->
		
	</div>		<!-- #hld ends -->
	
	
	<!--[if IE]><script type="text/javascript" src="<?php echo Dispatcher::baseUrl();?>/js/adminus/excanvas.js"></script><![endif]-->	

    	<script>
			$(document).ready(function(){
				<!--
				<?php
					if(!$this->Session->read('Auth.User')){
						echo "\$(\"#nav\").hide();";
					}
				?>
				//-->
				
				$(".alert-message").click(function(){
					$(this).hide("slow");
				});
				
				
		   	});
		</script>
</body>
</html>
