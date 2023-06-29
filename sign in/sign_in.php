<!DOCTYPE html>
<html>

<head>
    <title> Sign In</title>
   
    <link rel="stylesheet" href="sign_n.css">
    
    <!--box icons-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    </div>
   
</head>

<body>
    <?php
    session_start();
    ?>
     <?php
    $um='';$fu='';$lu='';$pu='';$au='';$mu='';$cmu='';
    require('..\connection.php');
    if(isset($_POST["login"])){
        header('Location: ../login/login.php');
    }
    if(isset($_POST["sign_in"])){

        if ($_POST["user_name"]!="" && $_POST["firstname_user"]!="" 
        && $_POST["lastname_user"]!="" && $_POST["phone_user"]!="" 
        && $_POST["address_user"]!="" && $_POST["mdp_user"]!="" && $_POST["confirm_mdp_user"]!="" ){
           $usr=$_POST['user_name'];
            $_reqq="SELECT `pseudo_name` FROM `users` WHERE pseudo_name='$usr'";
            $t=$conn->query($_reqq);
            $tab=$t->fetch();
            if(!isset($tab[0])){
                                if($_POST["mdp_user"] == $_POST["confirm_mdp_user"]){ 
                                        $req="INSERT INTO `users`(`pseudo_name`, `name_user`, `lastname_user`, `phone_number`, `address_user`, `mdp_user`) 
                                        VALUES (?,?,?,?,?,?)";
                                        $stm=$conn->prepare($req);
                                        $stm->bindValue(1,$_POST["user_name"]);
                                        $stm->bindValue(2,$_POST["firstname_user"]);
                                        $stm->bindValue(3,$_POST["lastname_user"]);
                                        $stm->bindValue(4,$_POST["phone_user"]);
                                        $stm->bindValue(5,$_POST["address_user"]);
                                        $stm->bindValue(6,$_POST["mdp_user"]);
                                        $stm->execute();
                                        header('Location: ../login/login.php');
                                }
                                else{
                                        echo '<script>alert("Not Same Password")</script>';
                                        $um=$_POST["user_name"];$fu=$_POST["firstname_user"];$lu=$_POST["lastname_user"];$pu=$_POST["phone_user"];$au=$_POST["address_user"];$mu=$_POST["mdp_user"];$cmu=$_POST["confirm_mdp_user"];
                                }
                            }else{
                                echo '<script>alert("There Is Already A User With Same User Name")</script>'; 
                                $um=$_POST["user_name"];$fu=$_POST["firstname_user"];$lu=$_POST["lastname_user"];$pu=$_POST["phone_user"];$au=$_POST["address_user"];$mu=$_POST["mdp_user"];$cmu=$_POST["confirm_mdp_user"];

                            }
                        
        }else{
            echo '<script>alert("All Field Should Be Filled")</script>'; 
            $um=$_POST["user_name"];$fu=$_POST["firstname_user"];$lu=$_POST["lastname_user"];$pu=$_POST["phone_user"];$au=$_POST["address_user"];$mu=$_POST["mdp_user"];$cmu=$_POST["confirm_mdp_user"];

        }
                
    }    
    ?>
    <!--Header-->
    <header>
        <!-- nav-->
        <div class="nav ">
            <p class="logo">Ecommerce</p>
        </div>
    </header>
    <div class="container_login">
        <!-- <img src="../img/LOGIN.jpg" /> -->
        <form method='POST' >
            <h1 style=" border-bottom:#fd4646 solid 5px">Sign In </h1>
            
            <div class="form-input">
                <input type="text" name="user_name" placeholder="Enter User Name" value=<?php echo $um;?>>
            </div>
            
            <div class="form-input">
                <input type="text" name="firstname_user"  placeholder="Enter  First Name"value=<?php echo $fu;?>>
            </div>
            
            <div class="form-input">
                <input type="text" name="lastname_user"  placeholder="Enter  Last Name" value=<?php echo $lu;?> >
            </div>
            
            <div class="form-input">
                <input type="text" name="phone_user" placeholder="Enter Phone Number" value=<?php echo $pu;?>  >
            </div>
            
            <div class="form-input">
                <input type="text" name="address_user"  placeholder="Enter E-mail" value=<?php echo $au;?> >
            </div>
            
            
            <div class="form-input">
                <input type="password" name="mdp_user"  placeholder="Password" value=<?php echo $mu;?> >
            </div>
            
            <div class="form-input">
                <input type="password" name="confirm_mdp_user" placeholder="Confirm Password"  value=<?php echo $cmu;?> >
            </div>
            <input type="submit" value="LOGIN" class="btn-login" name="login"/>
            <input type="submit" value="SIGN IN" class="btn-login" name="sign_in"/>
            <input type="reset" value="RESET" class="btn-login" />
        </form>
   
</body>

</html>