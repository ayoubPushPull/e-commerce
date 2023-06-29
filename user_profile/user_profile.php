<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="user_profile.css">
    <!--box icons-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <script>if(windows.history.replaceState){
        windows.history.replaceState(null,null,window.location.href);
        }
    </script>
</head>
<body>
<?php
require('..\connection.php');
    session_start();
    if(!isset($_SESSION["user_name"])){
        header('Location:../login/login.php');
    }
    ?>
    <!--Header-->
    <header>
        
        <div class="nav container">
            <a href="../main_page/index.php" class="logo">Ecommerce</a>
            <?php
                echo'<a href="../logout/logout.php?id=404"><i class="bx bx-log-out bx-sm" name="log_out"></i></a>';
            ?>
        </div>
    </header> 
    <?php
    $user='"'.$_SESSION['idcli'].'"';
    
    $req="SELECT `id_client`, `pseudo_name`, `name_user`, `lastname_user`, `phone_number`, `address_user`, `mdp_user` 
    FROM `users` 
    WHERE `id_client` = $user";
    $table = $conn->query($req);
    $row = $table->fetch();
    ?>
    <article>
        <div class="content">
            <form action="" method="post">
                <fieldset><legend>My account</legend>
                <table>
                    <tr><td><label for="id">My ID : </label></td><td><input type="text" value="<?php echo $row["id_client"] ?>" name="id" disabled></td></tr>
                    <tr><td><label for="">Pseudo Name : </label></td><td><input type="text" value="<?php echo $row["pseudo_name"] ?>" name="ps_name"></td></tr>
                    <tr><td><label for="">First Name : </label></td><td><input type="text" value="<?php echo $row["name_user"] ?>" name="n_user"></td></tr>
                    <tr><td><label for="">Last Name : </label></td><td><input type="text" value="<?php echo $row["lastname_user"] ?>" name="l_name"></td></tr>
                    <tr><td><label for="">Phone Number : </label></td><td><input type="text" value="<?php echo $row["phone_number"] ?>" name="ph_name"></td></tr>
                    <tr><td><label for="">Email</label></td><td><input type="text" value="<?php echo $row["address_user"] ?>" name="email"></td></tr>
                    <tr><td><label for="">Current Password : </label></td><td><input type="password" value="<?php echo $row["mdp_user"] ?>" ></td></tr>
                    <tr><td><label for="">New Password : </label></td><td><input type="text" name="pass"></td></tr>
                    <tr><td></td><td><input type="submit" value="Modify" name="mod"></td></tr>
                </table>
                </fieldset>
            </form> 
        </div> 
    </article>
    <?php
    //modifier
if(isset($_POST["mod"])){
    $req="  UPDATE `users` 
            SET 
                `pseudo_name`   ='$_POST[ps_name]',
                `name_user`     ='$_POST[n_user]',
                `lastname_user` ='$_POST[l_name]',
                `phone_number`  ='$_POST[ph_name]',
                `address_user`  ='$_POST[email]',
                `mdp_user`      ='$_POST[pass]' 
            WHERE 
                `id_client`=$user";
                header('Location:../user_profile/user_profile.php');
    $conn->exec($req);
}

    ?>
</body>
</html> 