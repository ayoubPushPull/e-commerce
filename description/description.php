<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Details About Product</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="description.css">
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
        <div class="nav ">
            <a class="logo" href="../main_page/index.php">Ecommerce</a><a class="btn" href="../cart/cart.php" target="_blank" style="text-decoration:none;color:inherit;"><i class='bx bx-shopping-bag bx-lg' id="cart_icon"></i></a><a href="../logout/logout.php?id=404"><i class="bx bx-log-out bx-md" name="log_out"></i></a><a href="../user_profile/user_profile.php"><i class="bx bxs-user-account bx-lg" ></i></a>
        </div>
		
    </header>
	<div class="container">
		<?php
		require('..\connection.php');
        $req ="SELECT `id_produit`, `title_produit`, `description`, `prix_produit`, `img_produit` FROM `produit` WHERE `id_produit`=$_GET[i]";
        $table = $conn->query($req);
		while($row = $table->fetch()) {
			echo '<div class="card">';;
			echo	'<div class="container-fliud">';
			echo		'<div class="wrapper row">';
			echo			'<div class="preview col-md-6">';						
			echo				'<div class="preview-pic tab-content">';
			echo				'<form method="POST">';
			echo				'<input type="hidden" value="'.$row["id_produit"].'" name="id_produit">';
			echo				'<div class="tab-pane active" id="pic-1"><img src="data:image;base64,'.base64_encode($row['img_produit']).'" /></div>';
			echo'				</div>';				
			echo			'</div>';
			echo			'<div class="details col-md-6">';
			echo				'<h3 class="product-title">'.$row['title_produit'].'</h3>';
			echo				'<input type="hidden" name="title_produit" value="'.$row["title_produit"].'">';
			echo				'<p class="product-description">'.$row['description'].'.</p>';
			echo				'<h4 class="price">current price: <span>'.$row['prix_produit'].'$</span></h4>';
			echo    			'<input type="hidden" name="prix_produit" value="'.$row["prix_produit"].'">';
			echo				'<div class="action">';
			echo					'<input class="add-to-cart btn btn-default" type="submit" value="Add cart" name="add_cart">';
			echo					'</form>';
			echo				'</div>';
			echo			'</div>';
			echo		'</div>';
			echo	'</div>';
			echo'</div>';
		}
		
		if(isset($_POST["add_cart"])){
			$count=0;
			$stmt=$conn->prepare("SELECT `num_produit` FROM `cart` WHERE  num_produit=?");
			$stmt->execute(array($_POST['id_produit'])) ;
			$row=$stmt->fetch();
			$count=$stmt->rowCount();
					// output data of each row
					if($count==0){
							$req="INSERT INTO `cart`(`num_produit`, `id_client`, `title_produit`, `prix`)
							VALUES (?,?,?,?)";
							$stm=$conn->prepare($req);
							$stm->bindValue(1,$_POST["id_produit"]);
							$stm->bindValue(2,$_SESSION['idcli']);		
							$stm->bindValue(3,$_POST["title_produit"]);
							$stm->bindValue(4,$_POST["prix_produit"]);
							
							$stm->execute();							
					}else if($count!=0){
							echo '<script>alert("Item Already In Your Cart")</script>'; 
					}
		}		
		?>
	</div>
</body>
</html>