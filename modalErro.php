<div class="modalBgErro on">
	<div class="modalContent">
		<div class="modalHead">
			<?php if($_SESSION['erro'] == "Cad1"){ ?>
				<h2>Erro ao cadastrar!</h2>
			<?php } ?>
			<?php if($_SESSION['erro'] == "Log1"){ ?>
				<h2>Erro ao logar!</h2>
			<?php } ?>
			<i class="fa-solid fa-times" id="closeBtnErro"></i>
		</div>
		<div class="modalBody">
		<?php if($_SESSION['erro'] == "Cad1"){ ?>
			<h2>Erro - o Email, CPF ou celular utilizado já está cadastrado!</h2>
			<br>
			<h3>Verifique as informações colocadas e certifique que você já não possui uma conta com as mesmas informações ou alguma das informações fornecidas no CPF, Email ou Celular.</h3>
		<?php } ?>
		<?php if($_SESSION['erro'] == "Log1"){ ?>
			<h2>Erro - Usuário ou senha incorretos!</h2>
			<br>
			<h3>Verifique as informações colocadas e certifique que você escreveu tudo corretamente, caso tenha esquecido sua senha: <br> <a href="#">Redefinir senha</a></h3>
		<?php } ?>
		</div>
	</div>
</div>

<?php 
	$_SESSION['erro'] = "";
?>