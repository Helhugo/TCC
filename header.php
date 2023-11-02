<?php
session_start();
include_once "templates.php"; 	
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="imagens/logo.png" type="image/x-icon" />
	<link rel="stylesheet" href="css/styleHeader.css">
	<link rel="stylesheet" href="css/styleVariables.css">
	<link rel="stylesheet" href="css/stylemodalCad.css">
	<link rel="stylesheet" href="css/stylemodalProd.css">
	<link rel="stylesheet" href="css/styleIndex.css">
	<link rel='stylesheet' href='css/styleCones.css'>
	<link rel='stylesheet' href='css/styleTrufas.css'>
	<link rel='stylesheet' href='css/stylePerfil.css'>
	<link rel='stylesheet' href='css/styleCarrinho.css'>
	<link rel='stylesheet' href='css/stylemodalAdm.css'>
    <script src="https://kit.fontawesome.com/75b9b9272c.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
	<script src="js/headerScript.js" defer></script>
	<script src="js/modalcadScript.js" defer></script>
	<title>Delícia DaHora</title>
</head>

<body>
	<header>
		<div class="header_bg_fill"></div>
		<div class="header_max_size">
			<div class="logo">
				<img src="imagens/logo2.png" alt="Logo">
			</div>
			<nav>
				<ul>
					<li>
						<a class="navA" href="index.php">Início</a>
						<a href="index.php" title="Início" class="icons"><i class="fa-solid fa-house"></i></a>
					</li>
					<li>
						<a class="navA" href="cones.php">Cones</a>
						<a title="Cones" href="cones.php" class="icons"><i class="fa-solid fa-basket-shopping"></i></a>
					</li>
					<li>
						<a class="navA" href="trufas.php">Trufas</a>
						<a href="trufas.php" title="Trufas" class="icons"><i class="fa-solid fa-basket-shopping"></i></a>
					</li>
					<li>
						<a class="navA" href="sobre.php">Sobre</a>
						<a href="sobre.php" title="Sobre" class="icons"><i class="fa-solid fa-circle-question"></i></a>
					</li>
				</ul>
			</nav>

			<div class="btnsUser">
				<?php if(!empty($_SESSION['logado'])) { ?>
				<button type="button">
					<a href="perfil.php" title="Cadastrar" >Perfil</a>
				</button>
				<?php } else { ?>
				<button type="button" class="logIn">
					<a href="#" title="Entrar" >Entrar</a>
					<div class="modalH" data-state="closed">
						<form action="autenticacao.php" method="post">
							<label for="logEmail">Email</label>
							<input type="email" name="logEmail" required>
							<label for="logSenha">Senha</label>
							<input type="password" name="logSenha" required>
							<hr>
							<input type="submit" name="btnSubmit">
						</form>
					</div>
				</button>
				<button type="button" class="signIn">
					<a href="#" title="Cadastrar" >Cadastrar</a>
				</button>
				<?php } ?>
			</div>

			<nav class="stickyNav" id="stickyNav">
				<i class="fa-solid fa-xmark fa-4x" data-state="off" id="closeMenuBurguer"></i>
				<button title="Menu" type="button" class="menu-burguer">
					<div class="linhas">
						<div class="linha"></div>
						<div class="linha"></div>
						<div class="linha"></div>
					</div>
				</button>

				<form class="searchBar" method="post" id="formSearch" name="search">        
					<input type="text" name="txtBar" list="produtos" id="txtBar" placeholder="O que deseja procurar?">
					<datalist id="produtos">
						<?php 
							$pdo = mysql_pdo_conn();
							$stmt = $pdo->prepare("SELECT * from cones JOIN trufas");
							$stmt->execute();
							$Allproduto = $stmt->fetchAll(PDO::FETCH_ASSOC);
							
							foreach($Allproduto as $Allprodutos){
								?>
								<option> <?php echo $Allprodutos['nome_Cone']; ?> </option>
								<option> <?php echo $Allprodutos['nome_Trufa']; ?> </option>
								<?php
							};
						?>
					</datalist>
					<button title="Ícone" type="submit" class="btnIcon" id="btnIcon" name="btnIcon">
						<i class="fa-solid fa-magnifying-glass"></i>
					</button>
				</form>

				<div class="utilityIcons">
					<a href="carrinho.php" title="Carrinho"><i class="fa-solid fa-cart-shopping"></i></a>
					<?php if(!empty($_SESSION['logado'])) { ?>
						<button type="button" class="perfilBtn">
							<a href="#" class="contaIcon_logado" id="contaIcon_logado" title="Conta"><i id="iconConta_logado" class="fa-solid fa-circle-user"></i></a>
							<div class="perfilTooltip">
								<ul>
									<li>
										<a href="perfil.php#perfil" class="group_divison">
											<p>Perfil</p>
											<i class="fa-solid fa-user"></i>
										</a>
									</li>
									<li>
										<a href="perfil.php#pedidos" class="group_divison">
											<p>Pedidos</p>
											<i class="fa-solid fa-list"></i>
										</a>
									</li>	
						
									<li>
										<a href="perfil.php#infos" class="group_divison">
											<p>Infos</p>
											<i class="fa-solid fa-pencil"></i>
										</a>
									</li>
									
									<li>
										<form action="autenticacao.php" method="post" class="group_divison gd_last">
											<input type="submit" name="deslogar" value="1" id="submitPerfil_logOut" style="display: none;">
											<label for="submitPerfil_logOut">Sair <i class="fa-solid fa-right-from-bracket"></i></label>
										</form>
									</li>
								</ul>
							</div>
						</button>
					<?php } else { ?> <a href="#" class="contaIcon" id="contaIcon" title="Conta"><i class="fa-solid fa-circle-user"></i></a> <?php } ?>
				</div>
			</nav>
		</div>
	</header>

	<div class="side-menu" data-state="off">
		<ul>
			<li>
				 <a href="index.php" title="Início">Início <i class="fa-solid fa-house"></i></a>
			</li>
			<li>
				 <a href="cones.php" title="Cones">Cones <i class="fa-solid fa-basket-shopping"></i></a>
			</li>
			<li>
				<a href="trufas.php" title="Trufas">Trufas <i class="fa-solid fa-basket-shopping"></i></a>
			</li>
			<li>
				<a href="sobre.php" title="Sobre">Sobre <i class="fa-solid fa-circle-question"></i></a>
			</li>
			<li id="carrinho_conta_menuAside">
				<a href="#" title="Carrinho"><i class="fa-solid fa-cart-shopping"></i></a>
				<a href="#" class="contaIcon" title="Conta"><i class="fa-solid fa-circle-user"></i></a>
			</li>
		</ul>
	</div>
<?php
include "modalCadastro.php";
include "modalInfo.php";
include "modalLogin.php";

if(!empty($_SESSION['erro'])){
	include "modalErro.php";
};