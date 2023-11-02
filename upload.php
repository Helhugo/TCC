<?php
include "header.php";
$pdo = mysql_pdo_conn();
	

if(!empty($_POST['inputName'])){

    $email = isset($_POST['inputEmail']) ? $_POST['inputEmail'] : '';
    $nome = isset($_POST['inputName']) ? $_POST['inputName'] : '';
    $user = isset($_POST['inputUser']) ? $_POST['inputUser'] : '';
    $senha = isset($_POST['inputSenha']) ? $_POST['inputSenha'] : '';
    $datanasc = isset($_POST['inputNasc']) ? $_POST['inputNasc'] : date('d-m-Y H:i:s');
    $cel = isset($_POST['inputCel']) ? $_POST['inputCel'] : '';
    $foto = isset($_FILES['inputFoto']) ? $_FILES['inputFoto'] : '';

    $stmt = $pdo->prepare("INSERT INTO Cliente(email_Cliente, nomeComp_Cliente, user_Cliente, senha_Cliente, datanasc_Cliente, telefone_Cliente, foto_Cliente)
    VALUES (?, ?, ?, ?, ?, ?, ?)"); 
    
    if(!empty($_FILES["inputFoto"]["name"])) {
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
                $stmt->execute(array($email, $nome, $user, $senha, $datanasc, $cel, $foto));
                
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }


    }
    else{
        $stmt->execute(array($email, $nome, $user, $senha, $datanasc, $cel, ''));
    }

}

if(!empty($_POST['inputSabor'])){
    $conetrufa = 'cone';
    $sabor = isset($_POST['inputSabor']) ? $_POST['inputSabor'] : '';
    $valor = isset($_POST['inputPreco']) ? $_POST['inputPreco'] : '';
    $tipo = isset($_POST['inputUser']) ? $_POST['inputUser'] : '';
    $descricao = isset($_POST['InputDescricao']) ? $_POST['InputDescricao'] : '';
    $foto = $conetrufa . $sabor . ".jpg";
    

    if($conetrufa == 'cone'){
        $nome = 'Cone de ' . $_POST['inputSabor'];

        $stmt = $pdo->prepare("INSERT INTO cones(nome_Cone, valor_Cone, descricao_Cone, clasfic_Cone, tipo_Cone, sabor_Cone, img_Cone)
        VALUES (?, ?, ?, ?, ?, ?, ?)"); 
       

        if(!empty($_FILES["inputFoto"]["name"])) {
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
                echo 'erro1';
            }
        
            // Check file size
            if ($_FILES["inputFoto"]["size"] > 5000000) {
                $uploadOk = 0;
                echo 'erro2';
            }
        
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $uploadOk = 0;
                echo 'erro3';
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["inputFoto"]["tmp_name"], $target_file)) {

                    $stmt->execute(array($nome, $valor, $descricao, 0, '', $sabor, $foto));
                    rename($target_file,"imagens/cone" . $sabor . ".jpg");
                    

                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }


        } else {
            $stmt->execute(array($nome, $valor, $descricao, 0, '', $sabor, ''));
        }

    




    } else {
        $nome = 'Trufa de ' . $_POST['inputSabor'];

        $stmt = $pdo->prepare("INSERT INTO trufa(nome_Trufa, valor_Trufa, descricao_Trufa, clasfic_Trufa, sabor_Trufa, img_Trufa)
        VALUES (?, ?, ?, ?, ?, ?)"); 
       

        if(!empty($_FILES["inputFoto"]["name"])) {
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
                echo 'erro1';
            }
        
            // Check file size
            if ($_FILES["inputFoto"]["size"] > 5000000) {
                $uploadOk = 0;
                echo 'erro2';
            }
        
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $uploadOk = 0;
                echo 'erro3';
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["inputFoto"]["tmp_name"], $target_file)) {

                    $stmt->execute(array($nome, $valor, $descricao, 0, $sabor, $foto));
                    rename($target_file,"imagens/trufa" . $sabor . ".jpg");
                    
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }


        } else {
            $stmt->execute(array($nome, $valor, $descricao, 0, $sabor, ''));
        } 

    }
     
   
    
    

}

   

?>