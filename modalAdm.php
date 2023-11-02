<form method="post" action="upload.php" enctype="multipart/form-data">
	<div class="modalBgAdm">
		<div class="modalContent">
			<div class="modalHead">
				<div class="modalSabor">
					<h2 class="modalProd_name"> Sabor:</h2>
					<input type="name" class="inputADD" name="inputSabor" id="inputSabor" placeholder="" required>
				</div>
				<i class="fa-solid fa-times" id="closeBtnProd"></i>
			</div>
			
			<div class="modalBody">
				<div class="imgPost">
					<label for="fotoID">
						<i id="labelFotoID" class="fa-solid fa-file-arrow-up"></i> 
						<img class="modalProd_img" id="frame"></label>
						<input type="file" class="N_hidden" name="inputFoto" onchange="preview()" id="fotoID">
				</div>
				<div class="infosGroup">
					<div class="reviews">
						
						<div class="notaContainer_class" id="notaContainer">
							<h2 class="modalProd_nota"></h2>
						</div>
						
						<div class="container_Criar">
								<div class="logError">
									<i class="fa-solid fa-key"></i>
									<i class="fa-solid fa-door-open"></i>
									<i class="fa-solid fa-hand-pointer"></i>
									<i class="fa-solid fa-star" id="iconEnter"></i>
									<i class="fa-solid fa-right-to-bracket"></i>
									<i class="fa-solid fa-code"></i>
									<i class="fa-solid fa-laptop-code"></i>
									<h2 id="loginWarning" onclick="()">As reviews aparecerão aqui!</h2>
								</div>
						</div>
					</div>
				
					<div class="txtContainer">
						<div class="inputPreco">
							<input type="text" class="inputADD" name="InputPreco" id="InputPreco" placeholder="_" maxlength="1" required>
							<h2 class="modalProd_preco"> R$</h2>
						</div>
						<div class="inputDesc">
							<h3 class="modalProd_desc">Descrição:</h3>
							<input type="text" class="inputADD" name="InputDescricao" id="InputDescricao" placeholder="" required>
						</div>
					</div>
				</div>
</form>
				<footer>
					<button type="submit">Adicionar</button>
					<button type="button" class="modalExit" >Voltar</button>
				</footer>
			</div>
		</div>
	</div>