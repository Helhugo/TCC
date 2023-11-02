<?php
include "header.php";
$pdo = mysql_pdo_conn();
$stmt = $pdo->prepare("SELECT * FROM reviews WHERE nome_Review = :nomeR"); 
$stmt->bindParam(':nomeR', $_SESSION['user'], PDO::PARAM_STR);
$stmt->execute();
$coneReview = $stmt->fetchAll(PDO::FETCH_ASSOC);

$conn = $pdo->prepare("SELECT * FROM cliente WHERE id_Cliente = :id");
$conn->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
$conn->execute();
$info = $conn->fetchAll(PDO::FETCH_ASSOC);

$connFav = $pdo->prepare("SELECT * FROM favoritos WHERE nome_User = :nomeU");
$connFav->bindParam(':nomeU', $_SESSION['user'], PDO::PARAM_STR);
$connFav->execute();
$favs = $connFav->fetchAll(PDO::FETCH_ASSOC);

$connNome = $pdo->prepare("SELECT user_Cliente FROM cliente WHERE id_Cliente = :id");
$connNome->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
$connNome->execute();
$user_Cliente = $connNome->fetchColumn();

$connFoto = $pdo->prepare("SELECT foto_Cliente FROM cliente WHERE id_Cliente = :id");
$connFoto->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
$connFoto->execute();
$foto_Cliente = $connFoto->fetchColumn();

if (empty($_SESSION['logado'])){
	echo '<script type="text/javascript">
        window.location = "index.php"
    </script>';
}

function func_Cel($cel){

	$substr1 = substr($cel, 0, 2);
	$substr2 = substr($cel, 2, 5);
	$substr3 = substr($cel, 7, 9);

	echo "(" . $substr1 . ")" . " " . $substr2 . "-" . $substr3;
} 

?>

<div class="perfil_Container">
	<aside class="sideMenu_perfil">
		<ul>
			<li onclick="actived(this)" class="on"><h3>Perfil</h3> <i class="fa-solid fa-user"></i></li>
			<li onclick="actived(this)"><h3>Pedidos</h3> <i class="fa-solid fa-list"></i></li>
			<li onclick="actived(this)"><h3>Informações</h3> <i class="fa-solid fa-pencil"></i></li>
			<li onclick="actived(this)"><h3>Reviews</h3> <i class="fa-solid fa-star"></i></li>
		</ul>
	</aside>
	
	<div class="mainMenu_perfil">
		<div class="mainMenu_slide">
			<div class="sec_Perfil">
				<div class="top">
					<div class="fotoPerfil">
						<img src="imagens/<?php echo $foto_Cliente; ?>" alt="Foto de Perfil">
						<label for="fotoID"><i class="fa-solid fa-camera"></i></label>
						<form method="post" action="redirect.php" class="N_hidden" enctype="multipart/form-data">
							<input type="file" class="N_hidden" name="inputFoto" onchange="form.submit()" id="fotoID">
						</form>
					</div>
					<div class="nomePerfil">
						<form method="post" action="redirect.php">
							<h2> <?php echo $user_Cliente; ?> </h2>
							<input type="text" class="formName N_hidden" name="nome_User" value="<?php echo $user_Cliente; ?>" disabled>
							<i title="Editar" id="editName" class="fa-solid fa-pencil"></i>
							<label for="btnSave_nameid" class="btnSave_name N_hidden"><i class="fa-solid fa-check"></i></label>
							<input id="btnSave_nameid" type="submit" class="N_hidden">
						</form>
					</div>
				</div>
				<div class="bottom">
					<div class="quadro">
						<?php 
						if(!empty($favs)){ ?>
								<div class="favsPerfil">
									<?php 
									foreach ($favs as $fav) {
										echo "<div class='favCell'>" . $fav['sabor_Fav'] . " <i class='fa-solid fa-times-circle' onclick='delFav(this)'></i></div>";
									}
									?>
									<form action="redirect.php" method="post" class="favForm">
										<input type="hidden" name="favSabor" id="favSabor" value="">
									</form>
								</div>
							<?php 
						} else{
							echo "<h2 class='noFav'> Você não possui produtos favoritos.</h2>";
						}
						?>
					</div>
				</div>
			</div>
			
			<div class="sec_Pedidos">
				<?php 
						if(!empty($_SESSION['pedidos'])){
							foreach($_SESSION['pedidos'] as $pedidos){ ?>
								<div class="pedidosPerfil">
									
								</div>
							<?php 
							}
						} else{
							echo "<h2 class='noPedidos'> Você não possui pedidos efetuados.</h2>";
						}
				?>
			</div>
			
			<div class="sec_Infos">
				<div class="mainInfos">
					<form method="post" class="sec_info_form" action="redirect.php">
						<div class="groupA">
							<label for="nomeInput">Nome:</label>
							<?php if(!empty($info)) { foreach($info as $infos){ ?>
							<input class="inputsInfo" type="text" id="nomeInput" name="nomeInput" value="<?php echo $infos['nomeComp_Cliente']; ?>" required>
							<label for="emailInput">Email:</label>
							<input class="inputsInfo" type="email" id="emailInput" name="emailInput" value="<?php echo $infos['email_Cliente']; ?>" required>
							<label for="senhaInput">Senha:</label>
							<input class="inputsInfo" type="text" id="senhaInput" name="senhaInput" value="<?php echo $infos['senha_Cliente']; ?>" required>
							<label for="telInput">Celular:</label>
							<input class="inputsInfo" type="tel" id="telInput" name="telInput" value="<?php echo func_cel($infos['telefone_Cliente']); ?>" onkeypress="$(this).mask('(00) 00000-0000');"  required>
							<label for="dataInput">Data de Nascimento:</label>
							<input class="inputsInfo" type="date" id="dataInput" name="dataInput" value="<?php echo $infos['datanasc_Cliente']; ?>" required>
							<?php } }?>
						</div>
						
						<button class="formEdit_btn" type="button"> Editar <i class="fa-solid fa-pencil"></i></button>
						<input type="submit" class="btnEnv" name="btnEnv" id="btnEnv" value="Confirmar">
					</form>
				</div>
			</div>
			
			<div class="sec_Reviews">
				<div class="sec_reviewsBg">
				<?php if($coneReview != [0]) :
						foreach($coneReview as $cReviews) : ?>
							<div class="reviewsC_bubbles">
								<img src="imagens/<?php echo $cReviews['tipo_Review'] . $cReviews['sabor_Review']; ?>.jpg" alt="Foto da Review Cones">
								<div class="notaAlign">
									<h2> <?php echo $cReviews['nota_Review']; ?> <i style="font-size: 2.2rem;" class="fa-solid fa-star"></i> </h2>
								</div>
							</div>
						<?php endforeach; ?>
				    <?php else : ?>
					<h2 class="noReviewsUser"> Você não possui nenhuma Review feita! </h2>
				<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="js/perfilScript.js" defer></script>