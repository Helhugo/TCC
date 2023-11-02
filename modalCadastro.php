<div class="modalBg">
	<div class="modalContent">
		<div class="modalHead">
			<h2>Cadastrar</h2>
			<i class="fa-solid fa-times" id="closeBtnCad"></i>
		</div>
		
		<div class="modalBody">
			<form method="post" action="upload.php" class="modalcadForm" enctype="multipart/form-data">
				<div class="inputsDiv">
					<label for="inputName">Nome:</label>
					<input type="name" class="inputCad" name="inputName" id="inputName" placeholder="Insira o nome" required>
					<label for="inputUser">Usuário:</label>
					<input type="name" class="inputCad" name="inputUser" id="inputUser" placeholder="Insira o nome de usuário" required>
					<label for="inputCel">Celular:</label>
					<input type="tel" class="inputCad" name="inputCel" id="inputCel" placeholder="Insira o celular" onkeypress="$(this).mask('(00) 00000-0000');" required>
					<label for="inputNasc">Data de Nascimento:</label>
					<input type="date" class="inputCad" name="inputNasc" id="inputNasc" required>
					<label for="inputEmail">Email:</label>
					<input type="email" class="inputCad" name="inputEmail" id="inputEmail" placeholder="Insira o email" required>
					<label for="inputSenha">Senha:</label>
					<input type="password" class="inputCad" name="inputSenha" id="inputSenha" placeholder="Insira a senha" required>
					<label for="inputFoto">Foto:</label>
					<input type="file" class="inputCad" name="inputFoto" id="inputFoto">
				</div>
				<hr>
				<input type="submit" name="btnCadastrar" id="btnCadastrar" value="Cadastrar">
			</form>
		</div>
	</div>
</div>