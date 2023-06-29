<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce</title>
    <link rel="stylesheet" href="thank_you.css">
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
                echo'<a href="../logout/logout.php?id=404"><i class="bx bx-log-out bx-sm" name="log_out"></i></a>'
            ?>
        </div>
    </header>
    <article>
        <form action="" method="get"><div class="content">Thank You For Using Our web Site :<span class="user"><?php echo $_SESSION["user_name"];?></span><input type="submit" class="first" value="Back to shop" name="back"></div> </form>
        <?php if(isset($_GET["back"])){
            header('Location:../main_page/index.php');
        } 
        ?>
    </article>
    
    
    </body>
</html> 