<?php
function mysql_pdo_conn() {
	$BD_HOST = 'localhost';
	$BD_USER = 'root';
	$BD_PASS = '';
	$BD_NAME = 'tcc_pdo';

	try {
		return new PDO("mysql:dbname=" . $BD_NAME . ";charset=utf8;host=" . $BD_HOST, $BD_USER, $BD_PASS);
	}
	catch (PDOException $e) {
		exit("Erro com o banco de dados: " . $e->getMessage());
	}
	catch (Exception $e) {
		exit("Erro: " . $e->getMessage());
	}
}

function search() {
	$referer = $_SERVER['HTTP_REFERER'];
	
	if(!empty($_POST['txtBar'])){
		
	}
	
	header("Location: $referer");
}

function closure() {
	echo "</body>
	</html>
	";
}
?>