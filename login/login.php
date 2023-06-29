<!DOCTYPE html>
<html>

<head>
    <title> login</title>
    <link rel="stylesheet" href="login.css">
    <!--box icons-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php
    session_start();
    require('..\connection.php');

  
    ?>
    <!--Header-->
    <header>
        <!-- nav-->
        <div class="nav ">
            <p class="logo">Ecommerce</p>
        </div>
    </header>
    <div class="container_login">
        <img src="../img/LOGIN.jpg" />
        <form method='POST' action='#'>
            <div class="form-input">
                <input type="text" name="name_user" placeholder="Enter User Name"  />
            </div>
            
            <div class="form-input">
                <input type="password" name="mdp_user" placeholder="Password"  />
            </div>
            <input type="submit" value="LOGIN" class="btn-login" name="login"/>
            <input type="submit" value="SIGN IN" class="btn-login" name="sign_in"/>
        </form>
    </div>
    <?php
    if(isset($_POST["login"])){
        $k=$_POST["name_user"];
        $q="SELECT `id_client` FROM `users` WHERE pseudo_name='$k'";
        $tb=$conn->query($q);
        if($tb->rowCount()>0){
        $l=$tb->fetch();
        $_SESSION['idcli']=$l[0];
        }
        if(($_POST["mdp_user"]=="123456789root" && $_POST["name_user"]=="nasser")||($_POST["mdp_user"]=="123456789root" && $_POST["name_user"]=="simo")||($_POST["mdp_user"]=="123456789root" && $_POST["name_user"]=="ayoub")){
            $_SESSION["user_name"]=$_POST["name_user"];
            $_SESSION['idcli']=$row['id_client'];
            
            
        }else{
                $req="SELECT  `id_client`, `pseudo_name`, `lastname_user`, `mdp_user` FROM `users` ";
                $table = $conn->query($req);
                    // output data of each row
                    while($row = $table->fetch()) {

                        if(($_POST["name_user"] != $row["pseudo_name"])&&($_POST["mdp_user"] == $row["mdp_user"])){
                            echo '<script>alert("User  Name incorrect")</script>';                            
                        }else if(($_POST["name_user"] == $row["pseudo_name"])&&($_POST["mdp_user"] != $row["mdp_user"])){
                            echo '<script>alert("Password incorrect")</script>';  
                        }else if(($_POST["name_user"] == $row["pseudo_name"])&&($_POST["mdp_user"] == $row["mdp_user"])){
                            $_SESSION["user_name"]=$_POST["name_user"];
                            header('Location: ../main_page/index.php');
                        }
                    }
        }
    }
    if(isset($_POST["sign_in"])){
        header('Location: ../sign in/sign_in.php');
    }
    ?>
</body>

</html>