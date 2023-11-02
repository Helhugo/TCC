<?php
include "header.php";
$pdo = mysql_pdo_conn();
$nome_User = $_SESSION['user'];
$stmt = $pdo->query("SELECT * FROM carrinho WHERE user_Cliente = '$nome_User'"); 
try{
    $stmt->execute();
} catch(Exception $e) {
    echo $e->getMessage();
}

$info_Car = $stmt->fetchAll(PDO::FETCH_ASSOC);

$connC = $pdo->prepare("SELECT * FROM cones");
$connC->execute();
$info_Cones = $connC->fetchAll(PDO::FETCH_ASSOC);

$connT = $pdo->prepare("SELECT * FROM trufas");
$connT->execute();
$info_Trufas = $connT->fetchAll(PDO::FETCH_ASSOC);

$info_CT = array_merge($info_Trufas, $info_Cones);

if (empty($_SESSION['logado'])) {
    echo '<script type="text/javascript">
    window.location = "index.php"
    </script>'; 
}
?>

<div class="car_Container">
    <div class="main_Carrinho">
        <div class="prod_Carrinho">
            <?php
            if (!empty($info_Car)) {
                foreach ($info_Car as $info) : 
                    $confere = substr($info['prod_Carrinho'], 0, 1); 
                    $tipo_Prod = $info['prod_Carrinho'];
                foreach ($info_Trufas as $infos_Trufas) :  
                    if ($infos_Trufas['nome_Trufa'] == $info['prod_Carrinho']) {
                        $preco = $infos_Trufas['valor_Trufa'];
                        $desc = $infos_Trufas['descricao_Trufa'];
                        if (empty($infos_Trufas['img_Trufa'])){
                            $imagem = "no-image.png";
                        }else{
                            $imagem = $infos_Trufas['img_Trufa'];
                        }
                    }
                ?>
                <?php 
                endforeach; 
                foreach ($info_Cones as $infos_Cones) :  
                    if ($infos_Cones['nome_Cone'] == $info['prod_Carrinho']) {
                        $preco = $infos_Cones['valor_Cone'];
                        $desc = $infos_Cones['descricao_Cone'];
                        if (empty($infos_Cones['img_Cone'])){
                            $imagem = "no-image.png";
                        }else{
                            $imagem = $infos_Cones['img_Cone'];
                        }
                    } 
                endforeach;
                ?>

                <div class="prods">
                <?php 
                if ($confere == "T") { ?>
                    <img class="prodImgCar modalInfo_img" src="imagens/<?php echo $imagem; ?>">   
                    <div class="nome_Prod">
                        <h4 class="prod_Car"> Produto: </h4>
                        <h4 class="prod_Carr"> <?php echo $info['prod_Carrinho']; ?> </h4>
                    </div>
                    <div class="desc_Prod">
                        <h4 class="prod_Car"> Descrição: </h4> 
                        <h4 class="prod_Carr"> <?php echo $desc; ?> </h4> 
                    </div>
                    <div class="qtd_Prod">
                        <h4 class="prod_Car"> Quantidade:</h4> 
                        <form class="update" id="updateQtd" action="redirect.php" method="post"> 
                            &nbsp;<input type="number" class="prod_Qtd" name="qtd_Prod" value="<?php echo $info['prod_Qtd'];?>" required>
                        </form>
                    </div>
                    <div class="preco_Prod">
                    &nbsp;&nbsp;<h4 class="preco_Car"> R$<?php echo $preco; ?>,00 </h4> 
                    <div class="btn_Del">
                        <input type="button" class="btnDel" value="Excluir">
                    </div>
                    </div>     
                <?php } else { ?>
                    <img class="prodImgCar modalInfo_img" src="imagens/<?php echo $imagem; ?>">
                    <div class="nome_Prod">
                        <h4 class="prod_Car"> Produto: </h4>
                        <h4 class="prod_Carr"> <?php echo $info['prod_Carrinho']; ?> </h4>
                    </div>
                    <div class="desc_Prod">
                        <h4 class="prod_Car"> Descrição: </h4> 
                        <h4 class="prod_Carr"> <?php echo $desc; ?> </h4> 
                    </div>
                    <div class="qtd_Prod">
                        <h4 class="prod_Car"> Quantidade:</h4> 
                        <form class="update" id="updateQtd" action="redirect.php" method="post"> 
                            &nbsp;<input type="number" class="prod_Qtd" name="qtd_Prod" value="<?php echo $info['prod_Qtd'];?>" required>
                        </form>
                        <script>
                            enviarFormulario();
                        </script>
                    </div>
                    <div class="preco_Prod">
                    &nbsp;&nbsp;<h4 class="preco_Car"> R$<?php echo $preco; ?>,00 </h4> 
                    <div class="btn_Del">
                        <form class="delete" action="redirect.php" method="post" onclick="this.submit()"> 
                            <input type="button" class="btnDel" value="Excluir">
                            <input type="hidden" name="del_Prod" value="<?php echo $tipo_Prod; ?>">
                        </form>
                    </div>
                    </div>
                <?php } ?>
                </div>
            <?php endforeach;
            } else {
                echo "AAAAAAAAAAA";
            }
            ?>
        </div>
        <div class="btn_Container">
            <input type="submit" class="btn_Pag" value="Pagar">
        </div>
    </div>
</div>