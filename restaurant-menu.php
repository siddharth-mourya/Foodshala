<?php
   session_start();
   if(isset($_SESSION['restaurant']))
   {
        echo "<script> location.href='/foodorder/restaurant-admin.php'; </script>";
   }
   else {
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
    <link rel="stylesheet" href="css/restaurant-menu/restaurant-menu.css">

    <!-------------- swiper -------------->
    <link rel="stylesheet" href="css/homepage/swiper.min.css">


</head>
<body >

    <?php

    if(isset($_GET['resid']))
        $resid = $_GET['resid'];
    if(isset($_GET['item-id']))
        $item_id = $_GET['item-id'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "foodshala";

        
        // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }     
    $sql = "SELECT * FROM menu where resid='$resid'";
    $result = $conn->query($sql);

    

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
                            <a class="nav-link" href="myorder.php">My Orders</a>
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
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="cart.php"><i class="fa fa-shopping-cart text-dark" aria-hidden="true"></i></a>
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
<?php
    $sql2 = "SELECT * FROM restaurant where id='$resid'";
    $result2 = $conn->query($sql2);
    if ($result2) 
    {
        while($row = $result2->fetch_assoc()) 
        {
            $rname = $row['resname'];
            $raddress = $row['address'];
        }
    }
?>
    <!-------------------------------------------- header ----------------------------------------------->
    <div id="restaurant-info-fluid" class="container-fluid">
        <div class="container ">
            <div class="d-flex justify-content-start  flex-wrap">
                <div id="img-div">
                    <img src="img/restaurant-menu/sagar.jpg" alt="">
                </div>
                <div id="restaurant-info" class="">
                    <div>
                        <h2><?php echo $rname ?></h2>
                        <h6>Chinese , Italian , Afhgani , Fast-food , Indian</h6>
                        <h5><?php echo $raddress ?></h5>
                    </div>                    
                    <div id="restaurant-info-star" class="d-flex justify-content-between ">
                        <h6>3.6 Star</h6>
                        <h6>48 minutes <br> <span style="color: rgb(211, 211, 211);"> Delivery Time</span> </h6>
                        <h6>Rs 300/ person</h6>
                    </div>
                </div>          
            </div>
        </div>
    </div>

    <div id="heading-menu" class="d-flex justify-content-center m-3">
        <h4><i class="fa fa-cutlery" aria-hidden="true"></i>     Menu    <i class="fa fa-cutlery" aria-hidden="true"></i></h4>
    </div>
    
    <!--------------------------------------- menu -------------------------------------------->
    <div id="cuisines" class="container">
        <div class="row "> 
            <div class="col-md-12">
                    <!-------------------------- internal dishes of restauant ------------------------>
                    <?php if ($result->num_rows > 0) 
                            {
                            while($row = $result->fetch_assoc()) 
                                { 
                    ?>    
                    <div class="food-item-row row d-flex flex-wrap justify-content-between align-items-center pt-3 pl-3 pr-3">
                        <div class="w-75">
                            <h5 id="item-id-<?php $item_id ?>"> 
                                <?php if($row['veg'] == 'Veg') 
                                {?>
                                    <i class="fa fa-dot-circle-o text-success" aria-hidden="true"></i>
                                <?php } else { ?>
                                    <i class="fa fa-dot-circle-o text-danger" aria-hidden="true"></i>
                                <?php }
                                    echo $row['name'];?>
                            </h5>
                            <p><?php  echo $row['price'];?> $</p>
                            <p><?php  echo $row['description'];?></p>
                        </div>
                        <div class="add-cuisine-class">
                            <a id="order<?php echo $row['id'] ?>"  href="cart.php?item-no=<?php echo $row['id'] ?>&resid=<?php echo $resid ?>"  class="btn btn-success">Order</a>
                            <img src="img/searched/si.jpg" alt="">
                        </div>
                    </div>
                    <hr>
                    <?php
                                }
                            }
                    ?>
                 
                 
                </div>
        </div>
    </div>


</body>
</html>

<?php } ?>