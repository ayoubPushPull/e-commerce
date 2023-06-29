<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce</title>
    <link rel="stylesheet" href="index.css">
    <!--box icons-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <script>if(windows.history.replaceState){
        windows.history.replaceState(null,null,window.location.href);
        }
    </script>
</head>
<body>
<?php
    session_start();
    if(!isset($_SESSION["user_name"])){
        header('Location:../login/login.php');
    }
    ?>
    <!--Header-->
    <header>
        <!-- nav-->
        <div class="nav container">
            <a href="../main_page/index.php" class="logo">Ecommerce</a>
            <?php
                echo'<p  style="font-size: x-large;">WELCOME |<span style="color:#fd4646; text-transform:uppercase;">'.$_SESSION["user_name"].'</span>|</p><a href="../logout/logout.php?id=404"><i class="bx bx-log-out bx-sm" name="log_out"></i></a><a href="../user_profile/user_profile.php"><i class="bx bxs-user-account bx-sm" ></i></a>'
            ?>
            <!--Cart-Icon-->
            <a class="btn" href="../cart/cart.php" target="_blank" style="text-decoration:none;color:inherit;"><i class='bx bx-shopping-bag' id="cart_icon"></i></a> 
        </div>
    </header>
    <!--shop-->
    <section class="shop container">
        <!--content-->
        <div class="shop_content">
        <?php
        require('..\connection.php');
        $req ="SELECT `id_produit`, `title_produit`, `prix_produit`, `img_produit` FROM `produit`";
        $table = $conn->query($req);
            // output data of each row
            while($row = $table->fetch()) {
                echo '<form action="" method="POST">';
                echo    "<div class='product_box'><a href=../description/description.php?i=$row[id_produit]>";
                echo    '<input type="hidden" name="id_produit" value="'.$row['id_produit'].'">';
                echo    '<img src="data:image;base64,'.base64_encode($row['img_produit']).'" alt="Image" class="product_img" name="img_produit">';
                echo    '<input type="hidden" value="'.$row['id_produit'].'" name="img_produit">';
                echo    '<input type="hidden" name="title_produit" value="'.$row["title_produit"].'">';
                echo    '<h2 class="product_title">'.$row['title_produit'].'</h2>';
                echo    '<input type="hidden" name="prix" value="'.$row["prix_produit"].'">';
                echo    '<span class="prix" name="prix">'.$row["prix_produit"]. '$</span>';
                echo    '<input type="submit" value="ADD TO CART" class="buy_btn" name="add_cart">';
                echo    '</a></div>';
                echo '</form>';
            }
            if(isset($_POST["add_cart"])){
                $count=0;
                $stmt=$conn->prepare("SELECT `num_produit` FROM `cart` WHERE  num_produit=?");
                $stmt->execute(array($_POST['id_produit'])) ;
                $row=$stmt->fetch();
                $count=$stmt->rowCount();
                        // output data of each row
                        if($count==0){
                                $req="INSERT INTO `cart`(`num_produit`, `id_client`, `title_produit`, `prix`, `img_produit`)
                                VALUES (?,?,?,?,?)";
                                $stm=$conn->prepare($req);
                                $stm->bindValue(1,$_POST["id_produit"]);
                                $stm->bindValue(2,$_SESSION['idcli']);
                                $stm->bindValue(3,$_POST["title_produit"]);
                                $stm->bindValue(4,$_POST["prix"]);
                                $stm->bindValue(5,$_POST["img_produit"]);
                                $stm->execute();							
                        }else if($count!=0){
                                echo '<script>alert("Item Already In Your Cart")</script>'; 
                        }

            }
        ?>
        </div>
    </section>

</body>
</html>