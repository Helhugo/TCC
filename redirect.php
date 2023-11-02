<?php
include "header.php";

$pdo = mysql_pdo_conn();	

if (!empty($_POST["nomeInput"])) {
	$cpf = $email = $_POST['emailInput']; $senha = $_POST['senhaInput']; $nome = $_POST['nomeInput']; $telefone = $_POST['telInput']; $datanasc = $_POST['dataInput'];
	$stmt = $pdo->prepare("UPDATE cliente SET email_Cliente = ?, nomeComp_Cliente = ?, senha_Cliente = ?, datanasc_Cliente = ?, telefone_Cliente = ? WHERE id_Cliente = ?");
	$stmt->execute([$email, $nome, $senha, $datanasc, $telefone, $_SESSION['id']]);
}

if (!empty($_POST["nome_User"])) {
	$stmt = $pdo->prepare("UPDATE cliente SET user_Cliente = :user WHERE id_Cliente = :id");
	$stmt->bindParam(':user', $_POST['nome_User'], PDO::PARAM_STR);
	$stmt->bindParam(':id', $_SESSION['id']);
	$stmt->execute();
}

if(!empty($_POST["favSabor"])){
	$saborFav = $_POST["favSabor"];
	$stmt = $pdo->prepare("DELETE FROM favoritos WHERE sabor_Fav = :sabor_fav");
	$stmt->bindParam(':sabor_fav', $saborFav, PDO::PARAM_STR);
	$stmt->execute();
}

if (!empty($_FILES["inputFoto"]["name"])) {
    $target_dir = "imagens/";
    $target_file = $target_dir . basename($_FILES["inputFoto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["inputFoto"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["inputFoto"]["size"] > 500000) {
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["inputFoto"]["tmp_name"], $target_file)) {
            $foto = $_FILES['inputFoto']['name'];

            $stmt = $pdo->prepare("UPDATE cliente SET foto_Cliente = :FotoNova WHERE id_Cliente = :id");
            $stmt->bindParam(':FotoNova', $foto, PDO::PARAM_STR);
			$stmt->bindParam(':id', $_SESSION['id']);
			$stmt->execute();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

$user_Cliente = "";
$conn = $pdo->prepare("SELECT user_Cliente FROM cliente WHERE id_Cliente = :id");
$conn->bindParam(":id", $_SESSION['id']);
$conn->execute();
$user_Cliente = $conn->fetchColumn();

if(!empty($_POST['favAdd'])) {

$verif_Sabor = $_SESSION['verif_Sabor'];
 
 $sabor_Fav = $_POST['favAdd'];

 $inserirSabor = true;

 foreach ($verif_Sabor as $verif_Sabores) {
     if ($sabor_Fav == $verif_Sabores['sabor_Fav']) {
         $inserirSabor = false;
         break;
     }
 }
     if ($inserirSabor) {
         $sabor_Prod = $_POST['favAdd'];

         $stmt = $pdo->prepare("INSERT INTO favoritos(nome_User, sabor_Fav) VALUES (:nome, :sabor)");
         $stmt->bindParam(":nome", $user_Cliente);
         $stmt->bindParam(":sabor", $sabor_Prod, PDO::PARAM_STR);
         $stmt->execute();  
     }

    echo '<script type="text/javascript">
        window.location = window.history.back();
    </script>'; 
}

if(!empty($_POST['favDel'])) {
    $sabor_Prod = $_POST['favDel'];
    
    $stmt = $pdo->prepare("DELETE FROM favoritos WHERE nome_User = :nome AND sabor_Fav = :sabor");
    $stmt->bindParam(":nome", $user_Cliente, PDO::PARAM_STR);
    $stmt->bindParam(":sabor", $sabor_Prod, PDO::PARAM_STR);
    $stmt->execute();

    echo '<script type="text/javascript">
        window.location = window.history.back();
    </script>'; 
}

if (!empty($_POST['carProd'])) {
    $prod_Carrinho = $_POST['carProd'];
    $produtos = [];

    $conn = $pdo->prepare("SELECT prod_Carrinho FROM carrinho WHERE user_Cliente = '$user_Cliente'");
    $conn->execute();
    $prod_Cad = $conn->fetchAll(PDO::FETCH_ASSOC);

    foreach ($prod_Cad as $prod_Cads) {
        $produtos[] = $prod_Cads['prod_Carrinho'];
    }
        if (in_array($prod_Carrinho, $produtos)) {
            $stmt = $pdo->prepare("UPDATE carrinho SET prod_Qtd = prod_Qtd + 1 WHERE user_Cliente = '$user_Cliente' AND prod_Carrinho = :prod");
            $stmt->bindParam(":prod", $prod_Carrinho, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            $stmt = $pdo->prepare("INSERT INTO carrinho(prod_Carrinho, user_Cliente, prod_Qtd) VALUES (:prod, :user, 1)");
            $stmt->bindParam(":prod", $prod_Carrinho, PDO::PARAM_STR);
            $stmt->bindParam(":user", $user_Cliente, PDO::PARAM_STR);
            $stmt->execute();
        }
    echo '<script type="text/javascript">
        window.location = window.history.back();
    </script>';
}

if (!empty($_POST['del_Prod'])) {
    $del_Prod = $_POST['del_Prod'];
    $stmt = $pdo->prepare("DELETE FROM carrinho WHERE prod_Carrinho = '$del_Prod' AND user_Cliente = '$user_Cliente'");
    $stmt->execute();

    echo '<script type="text/javascript">
        window.location = window.history.back();
    </script>';
}

    echo '<script type="text/javascript">
        window.location = "perfil.php"
    </script>'; 
?>