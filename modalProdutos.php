<div class="modalBgProd">
	<div class="modalContent">
		<div class="modalHead">
			<h2 class="modalProd_name"></h2>
			<i class="fa-solid fa-times" id="closeBtnProd"></i>
		</div>
		
		<div class="modalBody">
			<div class="imgAlign">
				<img class="modalProd_img" src="" alt="Imagem do Produto">
			</div>
			<div class="infosGroup">
				<div class="reviews">
					<i title="Criar Review" class="fa-solid fa-pencil" id="criarReview_Icon" onclick="abreCriar()"></i>
					
					<div class="notaContainer_class" id="notaContainer">
						<h2 class="modalProd_nota"></h2>
					</div>
					
					<?php if(!empty($_SESSION['logado'])){ ?>
					<div class="notaContainer_Criar">
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
					</div>
					<?php } ?>
					
					<div class="container_reviews">
						
					</div>
					
					<div class="container_Criar">
						<?php if(empty($_SESSION['logado'])){ ?>
							<div class="logError">
								<i class="fa-solid fa-key"></i>
								<i class="fa-solid fa-door-open"></i>
								<i class="fa-solid fa-hand-pointer"></i>
								<i class="fa-solid fa-person-walking-arrow-right" id="iconEnter" onclick="abreLogar()"></i>
								<i class="fa-solid fa-right-to-bracket"></i>
								<i class="fa-solid fa-code"></i>
								<i class="fa-solid fa-laptop-code"></i>
								<h2 id="loginWarning" onclick="abreLogar()">Faça login para enviar a sua review!</h2>
							</div>
						<?php } else { ?>
							<h2>Quantas estrelas esse produto merece?</h2>
							<form action=<?php echo basename($_SERVER['PHP_SELF']) ?>  method="post">
								<input type="hidden" id="newSabor" name="saborProd" value="">
								<input type="hidden" id="newUser" name="newUser" value="<?php echo $_SESSION['user']; ?>">
								<input type="number" id="newNota" name="userNota" value="" required>
								
								<label for="userText">Descreva a sua nota abaixo</label>
								<textarea id="userText" name="userText" placeholder="Nos diga a sua opinião..." rows="3" maxlength="100" required></textarea>
								<input type="submit" value="Enviar Review">
							</form>
						<?php } ?>
					</div>
				</div>
			
				<div class="txtContainer">
					<h2 class="modalProd_preco"></h2>
					<h3 class="modalProd_desc"></h3>
				</div>
			</div>
			<footer>
				<button type="button">Comprar</button>
				<button type="button" class="modalExit">Voltar</button>
			</footer>
		</div>
	</div>
</div>

