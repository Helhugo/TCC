<?php
session_start();
include_once "templates.php";

$pdo = mysql_pdo_conn();

function criptografia($senha) {
	$custo = "08";
	$salt = "Cf1f11ePArKlBJomM0F6aJ";

	$hash = crypt($senha, "$2a$" . $custo . "$" . $salt . "$");
	return $hash;
}

if($_POST['deslogar'] == "1"){
	session_destroy();
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}
if (empty($_POST) ) {
	 header('Location: ' . $_SERVER['HTTP_REFERER']);
} else{
	$EMAIL = $_POST["logEmail"];
	$password = $_POST["logSenha"];
	$stmt = $pdo->prepare("SELECT * FROM cliente WHERE email_Cliente = :email AND senha_Cliente = :password"); 
	$stmt->bindParam(':email', $EMAIL, PDO::PARAM_STR);
	$stmt->bindParam(':password', $password, PDO::PARAM_STR);
	$stmt->execute();
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

	if($stmt->rowCount() == 1)
	{
		session_regenerate_id();
        $_SESSION['logado'] = "true";
		$_SESSION['id'] = $userRow['id_Cliente'];
		$_SESSION['user'] = $userRow['user_Cliente'];
		$_SESSION['foto'] = $userRow['foto_Cliente'];
		$_SESSION['infos'] = $userRow;
		$_SESSION['erro'] = "";
				
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	else{
		$_SESSION['erro'] = "Log1";
		header('Location: ' . $_SERVER['HTTP_REFERER']);	
	}
}
?>