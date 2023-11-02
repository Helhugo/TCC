<?php
    include "header.php";
    $pdo = mysql_pdo_conn();    
    $stmt = $pdo->query("SELECT * FROM trufas");
    try{
        $stmt->execute();
    } catch(Exception $e) {
        echo $e->getMessage();
    }
 
    $infos = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
    $stmtN = $pdo->prepare("SELECT user_Cliente FROM cliente WHERE id_Cliente = :id");
    $stmtN->bindParam(":id", $_SESSION['id']);
    $stmtN->execute();
    $nome_Usuario = $stmtN->fetchColumn();
 
    if (!empty($_POST['userText'])) {
        $tipoProd = 'Trufa';
        $userName = $_POST['newUser'];
        $saborProd = $_POST['saborProd'];
        $notaProd = $_POST['userNota'];
        $textProd = $_POST['userText'];
       
        $stmt = $pdo->prepare("INSERT INTO reviews(tipo_Review, nome_Review, text_Review, nota_Review, sabor_Review)
        VALUES (?, ?, ?, ?, ?)");
 
        $stmt->execute(array($tipoProd, $userName, $textProd, $notaProd, $saborProd));
    }  
 
    $connBD = $pdo->prepare("SELECT sabor_Fav FROM favoritos WHERE nome_User = :nomeU");
    $connBD->bindParam(":nomeU", $nome_Usuario, PDO::PARAM_STR);
    $connBD->execute();
    $verif_Sabor = $connBD->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['verif_Sabor'] = $verif_Sabor;       
?>
    <script src="js/modalProdutos.js" defer></script>
    <script src="js/filtro.js" defer></script>
    <script src="js/modalAdm.js" defer></script>
        <div class="filtroBG"></div>
        <div class="bg_Cone">
            <div class="btnAdmin">
				<button type="button" onclick="verMaisAdm(this)"><i class="fa-solid fa-plus"></i></button>
			</div>
            <button class="btnFiltrar" type="button"> Filtrar <i class="fa-solid fa-circle-chevron-down" id="filtroChevron"></i> </button>
            <aside class="filtro_Aside">
                <h2>Filtrar Busca</h2>
                <i class="fa-solid fa-caret-down"></i>
                <div class="filtroTipo">
                    <h3 class="tituloFiltro">Sabores:</h3>
                    <div class="tipoNormal">
                            <div class="saborDuo trufaDuo">
                                <input id="cbDuotrufa" type="checkbox" name="cbDuo" onchange="clickCB(this)" value="Duo">
                                <label for="cbDuo">Duo</label>
                            </div>
                            <div class="saborOreo">
                                <input type="checkbox" name="cbOreo" onchange="clickCB(this)" value="Oreo">
                                <label for="cbOreo">Oreo</label>
                            </div>
                            <div class="saborSensacao">
                                <input type="checkbox" name="cbSensacao" onchange="clickCB(this)" value="Sensação">
                                <label for="cbSensacao">Sensação</label>
                            </div>
                            <div class="saborDoceleite">
                                <input type="checkbox" name="cbDoceleite" onchange="clickCB(this)" value="DocedeLeite">
                                <label for="cbDoceleite">Doce de Leite</label>
                            </div>
                            <div class="saborBrigadeiro">
                                <input type="checkbox" name="cbBrigadeiro" onchange="clickCB(this)" value="Brigadeiro">
                                <label for="cbBrigadeiro">Brigadeiro</label>
                            </div>  
                            <div class="saborChocomenta">
                                <input type="checkbox" name="cbChocomenta" onchange="clickCB(this)" value="Chocomenta">
                                <label for="cbChocomenta">Chocomenta</label>
                            </div>  
                            <div class="saborMaracuja">
                                <input type="checkbox" name="cbMaracuja" onchange="clickCB(this)" value="Maracujá">
                                <label for="cbMaracuja">Maracujá</label>
                            </div>
                            <div class="saborNinho">            
                                <input type="checkbox" name="cbNinho" onchange="clickCB(this)" value="Ninho">
                                <label for="cbNinho">Ninho</label>
                            </div>
                            <div class="saborPacoca">  
                                <input type="checkbox" name="cbPacoca" onchange="clickCB(this)" value="Paçoca">
                                <label for="cbPacoca">Paçoca</label>
                            </div>
                     </div>
                </div>
                <div class="filtroNota">
                    <h3 class="tituloFiltro">Nota:</h3>
                    <div class="medidor">
                        <input type="range" name="medidaInput" min="1" max="5" list="pontinhos" id="medidaInput" value="1" onchange="checaNota(this)">
                        <datalist id="pontinhos">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </datalist>
                        <i class="fa-solid fa-times-circle" title="Resetar Medidor" data-state="off" id="resetMedidor"></i>
                    </div>
                </div>
            </aside>
            <div class="container_Cone">
    <?php
 
    if(isset($infos)) :
        foreach ($infos as $info) :
            //Criei a varável para o AND no SELECT
            $Cone_Trufa = "Trufa";
            $saborCone = $info['sabor_Trufa'];
            //Adicionei o AND
            $AVG = $pdo->prepare("SELECT AVG(nota_Review) FROM reviews WHERE sabor_Review = '$saborCone' AND tipo_Review = '$Cone_Trufa'");
            $AVG->execute();
            $row = $AVG->fetch(PDO::FETCH_ASSOC);
            $AVGCones = $row['AVG(nota_Review)'];
 
            $AVGRound = round($AVGCones, 0);
            if (empty($info['img_Trufa'])){
                $imagem = "no-image.png";
            }else{
                $imagem = $info['img_Trufa'];
            }
        ?>
        <div class="produto">
            <?php
            if (!empty($_SESSION['logado'])) { 
                $favoritos = [];
            foreach ($verif_Sabor as $verifs_Sabor) {
                $favoritos[] = $verifs_Sabor['sabor_Fav'];
            } ?>
            <?php
                if (in_array($info['nome_Trufa'], $favoritos)) { ?>
                    <form class="favoritos" action="redirect.php" method="post" onclick="this.submit()">
                    <label for="favName" class="clicked"><i class="fa-solid fa-heart"></i></label>
                    <input type="hidden" id="favName" name="favDel" value="<?php echo $info['nome_Trufa']; ?>">
            <?php } else { ?>
                    <form class="favoritos" action="redirect.php" method="post" onclick="this.submit()">
                    <label for="favName"><i class="fa-regular fa-heart"></i></label>
                    <input type="hidden" id="favName" name="favAdd" value="<?php echo $info['nome_Trufa']; ?>">
            <?php  } ?>
            </form>
            <?php } ?>
            <div class="nota">
                <i class="fa-solid fa-star"></i>
                <span class="modalInfo"> <?php echo $AVGRound ?> </span>
            </div>
            <img class="prodImg modalInfo_img" src="imagens/<?php echo $imagem; ?>">
            <div class="prodInfos">
                <h2 class="nomeProd modalInfo"> <?php echo $info['nome_Trufa']; ?> </h2>
                <h3 class="descProd modalInfo"> <?php echo $info['descricao_Trufa']; ?> </h3>
                <div class="prodBtns">
                    <h2 class="valorProd modalInfo"> <?php echo $info['valor_Trufa']; ?> R$</h2>
                    <form class="carrinho" action="redirect.php" method="post">
                        <button type="submit" class="btnAdd">Adicionar</button>
                        <input type="hidden" id="carProd" name="carProd" value="<?php echo $info['nome_Trufa']?>">
                    </form>
                    <button type="button" class="btnVer" onclick="verMais(this)">Ver mais</button>
                </div>
            </div>
            <input type="hidden" class="saborProd modalInfo_sabor" name="prodSabor" value="<?php echo $info['sabor_Trufa']; ?>">
            <input type="hidden" class="notaProd" name="notaProd" value="<?php echo $AVGRound ?>">
           
            <div class="hiddenReview" style="display: none;">
                <?php
                    //Adicionei o AND
                    $stmt = $pdo->prepare("SELECT * FROM reviews WHERE sabor_Review = :sabor AND tipo_Review = '$Cone_Trufa'");
                    $stmt->bindParam(':sabor', $info['sabor_Trufa'], PDO::PARAM_STR);
                    $stmt->execute();
                    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
                   
                    if(isset($reviews)){
                        foreach($reviews as $review){
                            ?>
                            <input type="hidden" value="<?php echo $review['nome_Review']; ?>">
                            <input type="hidden" value="<?php echo $review['text_Review']; ?>">
                            <input type="hidden" value="<?php echo $review['nota_Review']; ?>">
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
     <?php
     endforeach;
     ?>
     </div>
     </div>
    <?php else : ?>
    <h1>Não há itens disponíveis.</h1>
    <?php endif;
   
    include "modalProdutos.php";
    include "modalAdm.php";

    closure();
    ?>