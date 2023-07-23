<?php
   session_start();
   if(isset($_SESSION['restaurant']))
   {
        echo "<script> location.href='/foodorder/restaurant-admin.php'; </script>";
   }
   else if(isset($_SESSION['email'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--------------- bootstrap ---------------------->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-----------------font awesome ----------------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

     <!------------- my general css --------------->
     <link rel="stylesheet" href="css/general/general.css">
    
    <!------------- my css --------------->
    <link rel="stylesheet" href="css/cart/cart.css">

    <!-------------- swiper -------------->
    <link rel="stylesheet" href="css/homepage/swiper.min.css">


</head>
<body >

<?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "foodshala";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }     
        
        $resid = "";
        $item_id = "";
        $semail=$_SESSION['email'];
        
        if(isset($_GET['resid']))
        {
            $resid = $_GET['resid'];
            //update resid and itemid
            $sql = "UPDATE customer SET resid='$resid' WHERE email='$semail'";
            $conn->query($sql);
        }
        if(isset($_GET['item-no']))
        {
            $item_id = $_GET['item-no'];
            $sql = "UPDATE customer SET item_id='$item_id' WHERE email='$semail'";
            $conn->query($sql);
        }

        if(!isset($_GET['resid']) && !isset($_GET['item-no']))
        {
            
            $sql = "SELECT * FROM customer where email='$semail'";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) 
            {
                $resid = $row['resid'];
                $item_id = $row['item_id'] ;
            }
        }

?>

    <!----------------------------------------------- navbar ------------------------------------------->
    <nav class="navbar navbar-fixed-top navbar-expand-md bg-white navbar-light d-flex align-items-baseline">
        <div class="container">
            <a class="h2 font-weight-bold text-dark" href="index.php">Food<span class="text-primary" >Shala</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Help</a>
                    </li>
                    <?php if(isset($_SESSION['email']))
                        { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="myorder.php">My orders</a>
                        </li>
                    <?php } ?>
                </ul>
                <ul class="navbar-nav ml-auto nav-login">
                    <?php
                        if(isset($_SESSION['email']))
                        {
                    ?>
                         <li class="nav-item">
                            <div class="dropdown show">
                                <a class="nav-link font-weight-bold dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Hi <?php echo $_SESSION['name'] ?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Settings</a>
                                    <a class="dropdown-item" href="logout.php">Logout</a>
                                </div>
                            </div>
                        </li>
                    <?php } else { ?>
                       
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown show">
                                <a class="nav-link font-weight-bold dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Register
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="customer-register.php">Customer</a>
                                    <a class="dropdown-item" href="restaurant-register.php">Restaurant</a>
                                </div>
                            </div>
                        </li>
                    <?php  } ?>
                </ul>

            </div>  
        </div>
    </nav>

    <?php if($resid != "0" && $item_id!= "0")
    {   $item_name="";
        $veg="";
        $price="";
        $rname="";
        $caddress="";

        
        $sql = "SELECT * FROM menu where id='$item_id'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) 
        {
            $veg = $row['veg'];
            $item_name = $row['name'];
            $price = $row['price'];
        }
        $sql = "SELECT * FROM restaurant where id='$resid'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) 
        {
            $rname = $row['resname'];
        }
        $cemail = $_SESSION['email'];
        $sql = "SELECT * FROM customer where email='$cemail'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) 
        {
            $caddress = $row['Address'];
        }
        ?>
    <div id="order" class="container">
        <div class="row pt-4 mb-2 justify-content-center">
           <h3 class="">Cart</h3>
           <h5 class="ml-auto "><a class="text-danger" href="cart.php?item-no=0&resid=0"> Clear Cart</a></h5>
        </div>
        <div class="row border "> 
        <div class="col-md-12 pl-4 bg-light ">
                <div class="row pt-4 pl-4 flex-column">
                    <h4>Delivery Status</h4>
                    <div class="d-flex align-items-baseline">
                        <i class="fa fa-check text-success mr-3" aria-hidden="true"></i>
                        <p>Ordered</p>
                    </div>
                    <div class="d-flex align-items-baseline">
                        <i class="fa fa-check text-success mr-3" aria-hidden="true"></i>
                        <p>Food Prepared</p>
                    </div>
                    <div class="d-flex align-items-baseline">
                        <i class="fa fa-check text-success mr-3" aria-hidden="true"></i>
                        <p>Food Picked</p>
                    </div>
                    <div class="d-flex align-items-baseline">
                        <i class="fa fa-check text-success mr-3" aria-hidden="true"></i>
                        <p>Food Delivered</p>
                    </div>
                </div>
                </div>
                <div class="col-md-12">
                    <div class="row bg-light d-flex flex-wrap justify-content-start align-items-center pt-3 pl-3 pr-3">
                        <img src="img/searched/si.jpg" alt="">
                        <div>
                            <h5><?php echo $rname ?></h5>
                            <p>Italian , South India , Labenese</p>
                        </div>
                    </div>
                    <!-------------------------- internal dishes of restauant ------------------------>
                    <div class="food-item-row row d-flex flex-wrap justify-content-between align-items-center pt-3 pl-3 pr-3">
                        <div>
                            <?php if($veg == 'Veg') { ?>
                                <i class="fa fa-dot-circle-o text-success" aria-hidden="true"></i>
                            <?php } else { ?>
                                <i class="fa fa-dot-circle-o text-danger" aria-hidden="true"></i>
                            <?php } ?>
                            <h5><?php echo $item_name ?></h5>
                            <p><?php echo $price ?> $ per</p>
                        </div>
                        <div class="counter-class d-flex align-items-baseline">
                            <div class="border font-weight-bold item-counter d-flex mr-2 p-2">
                                <a href="#"> <i class="fa fa-minus text-success" ></i> </a>
                                <p class="p-0"> 3 </p>
                                <a href="#"> <i class="fa fa-plus text-success" ></i> </a>
                            </div>
                            <p><?php echo $price ?> Rs.</p>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <div class="container bg-light p-4 mb-3">
        <div class="row d-flex p-4 flex-column">
            <div class="d-flex justify-content-between">
                <h5>Total Amount</h5>
                <p>Rs. <?php echo $price ?></p>
            </div>
            <div class="d-flex  text-success justify-content-between">
                <h5>Discout</h5>
                <p>Rs. 0</p>
            </div>
            <div class="d-flex justify-content-between">
                <h5>Final Amount</h5>
                <p>Rs. <?php echo $price ?></p>
            </div>
        </div>
    </div>

    <div id="delivery-address" class="container p-4 mb-3 bg-light">
        <div class="row p-4 d-flex justify-content-between">
            <div class="mr-4">
                <h4>Delivery Address</h4>
                <p><?php echo $caddress ?></p>
            </div>       
            <div>
                <h4>Payment Mode</h4>
                <p class="text-success">Cash On Delivery</p>
            </div>   
        </div>
    </div>

    <div class="container">
        <div class="d-flex justify-content-center">
            <a href="track.php" class="btn btn-success"> CheckOut (<span> Rs. <?php echo $price ?></span>) </a>
        </div>
    </div>

    <?php }
    else {?>
        <div id="cart-empty" class="">
            <img src="img/cart/st.png" alt="">
            <h3>Arrey Foodiee...... Cart kya check kr rhe ho Order Karo</h3>
        </div>
    <?php
    }
    ?>
    

<br><br><br>

</body>
</html>

<?php }
else{
    echo "<script> location.href='/foodorder/login.php'; </script>";
    exit;
} ?>