</html>
<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="cart.css">
<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <title>cart</title>
</head>
<style>
#maintable{
     width: 50%; 
    margin-top: 180px;
    margin-left: 142px;
    text-align: center;
}
.totaltable{
    position:relative;
    left:50%;
}
.btnch{
    position:relative;
    left:50%;
    border: none;
    margin: 1.5rem auto 0 auto;
    padding: 12px 20px;
    background: #fd4646;
    color: white;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
}
    tr{
        
        border:5px solid #fd4646;
    }
    td{
        border:5px solid #fd4646;
    }
    th{
        border:5px solid #fd4646;
    }
</style>
<body>
<?php
    session_start();
    if(!isset($_SESSION["user_name"])){
        header('Location:../login/login.php');
    }
    require('..\connection.php');
    ?>
    <header>
        <!-- nav-->
        <div class="nav container">
            <a href="../main_page/index.php" class="logo">Ecommerce</a>
            <?php
                echo'<p  style="font-size: x-large;">WELCOME |<span style="color:#fd4646; text-transform:uppercase;">'.$_SESSION["user_name"].'</span>|</p><a href="../logout/logout.php?id=404"><i class="bx bx-log-out bx-sm" name="log_out"></i></a><a href="../user_profile/user_profile.php"><i class="bx bxs-user-account bx-sm" ></i></a>'
            ?>
            
        </div>
    </header>
    <?php if(isset($_GET["id"])){
        $id=$_GET["id"];
        $req="DELETE  FROM cart WHERE num_produit=$id";
        $conn->exec($req);
        
    }?>
    <form action="" method="GET">
    <?php
        $req="SELECT `num_produit`, `id_client`, `id_produit`, `title_produit`, `prix`, `img_produit` FROM `cart`";
        $tab = $conn->query($req);
    ?>
    <table id="maintable">
            <tr>
                <th>THUMBNAIL</th>
                <th>PRODUCT</th>
                <th>PRIX</th>                
                <th>REMOVE</th>
            </tr>;
    <?php  while($row = $tab->fetch()) {
            $reqq="SELECT `id_produit`, `title_produit`, `description`, `prix_produit`, `img_produit` FROM `produit` WHERE `id_produit`=$row[img_produit]";
            $t=$conn->query($reqq);
            $taa=$t->fetch();
            $id=$taa['id_produit'] ;            
    ?>
            <tr><td><img width="100" height="100" class='impa' src="data:image;base64,<?php echo base64_encode($taa['img_produit']);?>"></td><td><?php echo $row['title_produit']?></td><td><?php echo $row['prix']?>$</td><td><a href="cart.php?id=<?php echo $id;?>">REMOVE</a></td>
        </tr>
        <?php
        }
        ?>
    </table>
    </form>
   
    <?php
    
        $req="SELECT SUM(prix) FROM cart";
        $t=$conn->query($req);
        $taa=$t->fetch();
        
        ?>
        <div>
            <form action="../checkout/checkout.php" method="get">
            <table border=1 class="totaltable">
                <tr><td>Sub Total</td><td><?php echo $taa[0]?><input type="hidden"value="<?php echo $taa[0]?>" name="s" >$</td></tr>
                <tr><td>Shipping</td><td>30$</td></tr>
                <tr><td>Total</td><td><?php echo $taa[0]+30?>$</td></tr>
            </table>
            <input type="submit" value="Checkout" class="btnch" name="checkout">
        </form>
                </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>