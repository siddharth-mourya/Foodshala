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
    <link rel="stylesheet" href="css/searched/searched.css">

    <!-------------- swiper -------------->
    <link rel="stylesheet" href="css/homepage/swiper.min.css">


</head>
<body >


<?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "foodshala";
        $search_item ="";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }     
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            $search_item = $_POST["search"];
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
                                    <a class="dropdown-item" href="#Sorry-page-not-made-yet">Settings</a>
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

    <!--------------------------------- search bar for restaurent and dishes search ------------------------>
    <div class="container justify-content-center search-bar  p-3">
        <form action="searched.php" method="POST" id="search" >
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search for restaurents or dishes..." id="search-item" name="search">
            <div class="input-group-append">
                <button type="submit" name ="submit" class="input-group-text">submit</button>
            </div>
        </div>
        </form>
    </div>
   
    <!---------------------------------- switch tabs res and dish ------------------------------------->
    <div class="container filter-tab-container">
        <div class="row p-3 d-flex justify-content-between">       
            <ul class="nav">
                <li><a class="active"  data-toggle="tab" href="#cuisines">Cuisines</a></li>
                <li ><a data-toggle="tab" href="#restaurant">Restaurants</a></li>
            </ul>
        </div>
    </div>



    <!-------------------------------------- searched result ------------------------------------------>
    <div class="container pt-4 tab-content">
        <div id="restaurant" class="tab-pane fade ">
            <div class="row ">
                <?php  
                    $sql3 = "SELECT * FROM restaurant where resname like '%$search_item%'";
                    $result3 = $conn->query($sql3);
                    while($row3 = $result3->fetch_assoc()) 
                    {
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                    <div class="card border-0 text-left">
                        <img src="https://source.unsplash.com/1600x900/?restaurant" class="card-img-top" alt="...">
                        <div class="card-body pl-0">
                            <h5 class="card-title"><?php echo $row3['resname'] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo $row3['address'] ?></h6>
                            <p class="card-text">Indian , italian , chinese , south-indian, cold-cafe , afgani......</p>
                            <div class=" d-flex">
                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                <i class="fa fa-star-o text-dark" aria-hidden="true"></i>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="restaurant-menu.php?resid=<?php echo $row3['id'] ?>" class="card-link">Order Now</a>
                                <p>Rs 200/person</p>
                            </div>                            
                        </div>
                    </div>
                </div>
                <?php
                    } ?>
            </div>
        </div>

        <div id="cuisines" class="tab-pane fade show active">
            <!---------------------------per res cuisine ------------------------------------->
            <div class="row border "> 
                <div class="col-md-12">
                    <?php 
                         $sql = "SELECT * FROM restaurant";
                         $result = $conn->query($sql);
                         while($row = $result->fetch_assoc()) 
                         {
                             $rname = $row['resname'];
                             $rid = $row['id'];
                             
                            $sql2 = "SELECT * FROM menu WHERE resid = '$rid' and  name LIKE '%$search_item%'";
                            $result2 = $conn->query($sql2);
                            if($result2 ->num_rows > 0)
                            {
                                
                    ?>
                            <div class="row bg-light d-flex flex-wrap justify-content-between align-items-center pt-3 pl-3 pr-3">
                                <div>
                                    <h5><?php echo $row['resname'] ?></h5>
                                    <p>Italian , South India , Labenese</p>
                                    <p>57 mins ~ 200 for two</p>
                                </div>
                                <a href="restaurant-menu.php?resid=<?php echo $rid ?>"> See Menu</a>
                            </div>
                    <!-------------------------- internal dishes of restauant ------------------------>
                    <?php
                            while($row2 = $result2->fetch_assoc()) 
                            {
                                $name = $row2['name'];
                                $id = $row2['id'];
                                $price=$row2['price'];
                                $veg=$row2['veg'];

                    ?>
                                <div class="food-item-row row d-flex flex-wrap justify-content-between align-items-center pt-3 pl-3 pr-3">
                                    <div>
                                    <?php if($veg == 'Veg') { ?>
                                        <i class="fa fa-dot-circle-o text-success" aria-hidden="true"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-dot-circle-o text-danger" aria-hidden="true"></i>
                                    <?php } ?>
                                        <h5><?php echo $name ?></h5>
                                        <p><?php echo $price ?> $</p>
                                    </div>
                                   
                                    <div class="add-cuisine-class">
                                        <a id="order<?php echo $row['id'] ?>" href="cart.php?item-no=<?php echo $row2['id'] ?>&resid=<?php echo $rid ?>" class="btn btn-success">Order</a>
                                        <img src="img/uploads/<?php echo $row2['file'];?>" alt="" onerror="this.onerror=null; this.src='img/searched/si.jpg'" >
                                    </div>
                                </div>
                                   
                                <hr>

                    <?php   }
                        }
                        
                    ?>
                  
                <?php
                    }
                ?>
                </div>
            </div>

        </div>
    </div>


</body>
</html>

<?php } ?>