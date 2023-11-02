<div class="newLogin_modal">
	<div class="modalContent">
		<div class="modalHead">
			<h2>Login</h2>
			<i class="fa-solid fa-times" id="closeModal_login"></i>
		</div>
		
		<div class="modalBody">
			<form action="autenticacao.php" method="post">
				<label for="logEmail">Email</label>
				<input type="email" class="loginInputs" name="logEmail" required>
				<label for="logSenha">Senha</label>
				<input type="password" class="loginInputs" name="logSenha" required>
				<hr>
				<input type="submit" name="btnSubmit">
			</form>
		</div>
	</div>
</div>