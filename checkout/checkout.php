<?php
    session_start();
    if(!isset($_SESSION["user_name"])){
        header('Location:../login/login.php');
    }
    require('..\connection.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial;
            font-size: 17px;
            padding: 8px;
        }
        
        * {
            box-sizing: border-box;
        }
        
        .row {
            display: -ms-flexbox;
            /* IE10 */
            display: flex;
            -ms-flex-wrap: wrap;
            /* IE10 */
            flex-wrap: wrap;
            margin: 0 -16px;
        }
        
        .col-25 {
            -ms-flex: 25%;
            /* IE10 */
            flex: 25%;
        }
        
        .col-50 {
            -ms-flex: 50%;
            /* IE10 */
            flex: 50%;
        }
        
        .col-75 {
            -ms-flex: 75%;
            /* IE10 */
            flex: 75%;
        }
        
        .col-25,
        .col-50,
        .col-75 {
            padding: 0 16px;
        }
        
        .container {
            background-color: #f2f2f2;
            padding: 5px 20px 15px 20px;
            border: 1px solid lightgrey;
            border-radius: 3px;
        }
        
        input[type=text] {
            width: 100%;
            margin-bottom: 20px;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type=tel] {
            width: 100%;
            margin-bottom: 20px;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type=month] {
            width: 100%;
            margin-bottom: 20px;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        
        label {
            margin-bottom: 10px;
            display: block;
        }
        
        .icon-container {
            margin-bottom: 20px;
            padding: 7px 0;
            font-size: 24px;
        }
        
        .btn {
            background-color: #fd4646;
            color: white;
            padding: 12px;
            margin: 10px 0;
            border: none;
            width: 100%;
            border-radius: 3px;
            cursor: pointer;
            font-size: 17px;
        }
        
        .btn:hover {
            background-color: #45a049;
        }
        
        a {
            color: #2196F3;
        }
        
        hr {
            border: 1px solid lightgrey;
        }
        
        span.price {
            float: right;
            color: grey;
        }
        
        @media (max-width: 800px) {
            .row {
                flex-direction: column-reverse;
            }
            .col-25 {
                margin-bottom: 20px;
            }
        }
    </style>
    <title>Checkout</title>
</head>

<body>
<?php
if(!isset($_GET["s"]) or empty($_GET["s"])){
    header('Location:../cart/cart.php');
}
?>
    <h2>Checkout </h2>

    <div class="row">
        <div class="col-75">
            <div class="container">
                <form method="POST">

                    <div class="row">
                        <div class="col-50">
                            <h3>Billing Address</h3>
                            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                            <input type="text" id="fname" name="fname">
                            <label for="email"><i class="fa fa-envelope"></i> Email</label>
                            <input type="text" id="email" name="email">
                            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                            <input type="text" id="adr" name="address">
                            <label for="city"><i class="fa fa-institution"></i> City</label>
                            <input type="text" id="city" name="city">

                            <div class="row">
                                
                                <div class="col-50">
                                    <label for="phone"><i class="fa fa-phone"></i> phone</label>
                                    <input type="tel" id="phone" name="phone">
                                </div>
                            </div>
                        </div>

                        <div class="col-50">
                            <h3>Payment</h3>
                            <label for="fname">Accepted Cards</label>
                            <div class="icon-container">
                                <i class="fa fa-cc-visa" style="color:navy;"></i>
                                <i class="fa fa-cc-amex" style="color:blue;"></i>
                                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                <i class="fa fa-cc-discover" style="color:orange;"></i>
                            </div>
                            <label for="cname">Name on Card</label>
                            <input type="text" id="cname" name="cardname">
                            <label for="ccnum">Credit card number</label>
                            <input type="text" id="ccnum" name="cardnumber">
                            <label for="expmonth">Exp date</label>
                            <input type="month" id="expmonth" name="expdate">
                            <div class="row">
                                
                                <div class="col-50">
                                    <label for="cvv">CVV</label>
                                    <input type="text"  id="cvv" name="cvv">
                                    <input type="hidden" name="total" value="<?php echo $_GET["s"]+30?>">
                                </div>
                            </div>
                        </div>

                    </div>
                    <label>
                    
                    </label>
                    <input type="submit" value="Continue to checkout" class="btn" name="out">
                    <input type="submit" value="Back To Cart" class="btn" name="cart">
                </form>
                
            </div>
        </div>
        <div class="col-25">
            <div class="container">
                <h4>Cart <span class="price" style="color:black"> </span></h4>
                <p>Sub Total <span class="price"><?php echo $_GET["s"]?>$</span></p>
                <p>Shiping <span class="price">30$</span></p>
                <hr>
                <p>Total <span class="price" style="color:black"><b><?php echo $_GET["s"]+30?>$</b></span></p>
            </div>
        </div>
    </div>
    <?php 
                if(isset($_POST["out"])){
                    if($_POST["fname"]=="" or $_POST["email"]=="" or $_POST["address"]=="" or $_POST["city"]=="" or $_POST["phone"]=="" or $_POST["cardname"]=="" or $_POST["cardnumber"]=="" or $_POST["expdate"]=="" or $_POST["cvv"]=="" or $_POST["total"]==""){
                        echo "<script>
                        alert('all fields shaould be filled')
                        </script>";
                    }else{
                    $req="INSERT INTO `checkout`( `full_name`, `email_address`, `address`, `city`, `phone`, `card_bank`, `card_num`, `exp_date`, `cvv`, `total`) 
                    VALUES (?,?,?,?,?,?,?,?,?,?)";
                    $stm=$conn->prepare($req);
                    $stm->bindValue(1,$_POST["fname"]);
                    $stm->bindValue(2,$_POST["email"]);
                    $stm->bindValue(3,$_POST["address"]);
                    $stm->bindValue(4,$_POST["city"]);
                    $stm->bindValue(5,$_POST["phone"]);
                    $stm->bindValue(6,$_POST["cardname"]);
                    $stm->bindValue(7,$_POST["cardnumber"]);
                    $stm->bindValue(8,$_POST["expdate"]);
                    $stm->bindValue(9,$_POST["cvv"]);
                    $stm->bindValue(10,$_POST["total"]);
                    $stm->execute();
                     ?>
                    <script>
                        location.href='../thank_you/thank_you.php';
                    </script>
                <?php } }
                if(isset($_POST["cart"])){?>
                    <script>
                        location.href='../cart/cart.php';
                    </script>
                <?php
                }
                ?>
</body>

</html>