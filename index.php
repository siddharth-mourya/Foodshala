<?php
   session_start();
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
    <link rel="stylesheet" href="css/homepage/homepage.css">

    <!-------------- swiper -------------->
    <link rel="stylesheet" href="css/homepage/swiper.min.css">


</head>
<body onload="typeWriter()">
<?php 
    if(isset($_SESSION['restaurant']))
    {
        echo "<script> location.href='/foodorder/restaurant-admin.php'; </script>";
    }
    else 
    {
?>

<?php
   
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
        $sql = "SELECT * FROM menu";
        $result = $conn->query($sql);
        
    
    ?>
    <!----------------------- navbar ----------------------------->
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
                        <a class="nav-link" href="searched.php">Menu</a>
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

    <!----------------------- header with blue image below navbar -------------------------------->
    <div class="header-front"> 
        <div class="header-bg" >
            <img src="img/homepage/headerbg.jpg"  alt="" srcset="">
        </div>
        <div style= "position:absolute; left:30%;top:40%">
            <h1 class=" font-weight-bold text-white" href="#">FoodShala</h1>
            <h2 id="heading"  style="color:white; "></h2>
        </div>               
    </div>
    

    <!--------------------------------- search bar for restaurent and dishes search ------------------------>
    <div class="container search-bar  p-4">
        <form action="searched.php" method="POST" id="search" >
            <input type="text" name ="search" id="searchInput" placeholder ="Search fo restaurents or dishes..."></input>
            <input type="submit" name ="submit" id="searchBtn" value="search" class="btn btn-primary mb-2"></input>
        </form>
    </div>
   
    <div class="mb-4"></div>

    <!-------------------------------- Famous Cuisines in the city ------------------------------------->
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <h3>Famous Cuisines in the city</h3>
            <div class="buttons d-flex align-items-baseline">
                <div class="swiper-button-prev mr-3"></div>
                <pre>  </pre>
                <div class="swiper-button-next mr-4"></div>
            </div>
        </div>
    </div>
    <br>

    <!--------------------------- cusiine slider ------------------------------>

    <div class="container-fluid">
    <div id="famous-dish-slider" class="swiper-container">
        <div class="swiper-wrapper">   
        <?php 
        
            if ($result->num_rows > 0) 
            {
                $i = 0;
            while($row = $result->fetch_assoc()) 
            {
                if($i > 10)
                {
                    break;
                }
                $item_id = $row['id'];
                $name = $row['name'];
                $price = $row['price'];
                $description = $row['description'];
                $resid = $row['resid'];
                $rname= "";

                $sql2 = "SELECT * FROM restaurant where id='$resid'";
                $result2 = $conn->query($sql2);
                
                if ($result2) 
                {
                    while($row2 = $result2->fetch_assoc()) 
                    {
                        $rname = $row2['resname'];
                    }
                }
                $dish = $name;
                str_replace(',', ' ', $name);
                $disharr = explode(' ',trim($name));
        ?>
            <div class="swiper-slide card border-0 text-left">
                <img src="img/homepage/d1.jpg" class="card-img-top" alt="...">
                <div class="card-body pl-0">
                    <h5 class="card-title"><a href="restaurant-menu.php?resid=<?php echo $resid ?>&item-id=<?php echo $item_id ?>#item-id<?php echo $item_id ?>"><?php echo $name ?></a></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $rname ?> </h6>
                    <p class="card-text"><?php echo substr($description,0,60) ?></p>
                    <div class=" d-flex">
                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a  href="cart.php?item-no=<?php echo $item_id ?>&resid=<?php echo $resid ?>" class="card-link">Order Now</a>
                        <p>Rs <?php echo $price ?></p>
                    </div>
                   
                    
                </div>
            </div>
        <?php
            $i=$i+1;
            }
        } 
        ?>
            <div class="swiper-slide card border-0">
                <img src="https://source.unsplash.com/1600x900/?food" class="card-img-top " alt="...">
                <div class="card-body">
                  <h5 class="card-title font-weight-bold">Want more food like this....</h5>
                  <p class="card-text"><a href="searched.php">click here</a></p>
                </div>
            </div>

            
        </div>
        
    </div>
    </div>
    

    <!------------------------------------------------category slider ------------------------>

  <!--  <div id="category-slider" class="container-fluid pt-4"> 
        <div class="row ml-0 mr-0">
            <h2>Categories you can try</h2>
        </div>
        <br>
        <div class="row ">
            <div class="col d-flex flex-column ">
                <img src="img/homepage/d2.jpg" alt="...">
                <h5>Chinese</h5>
            </div>
            <div class="col d-flex flex-column ">
                <img src="img/homepage/d2.jpg" alt="...">
                <h5>Chinese</h5>
            </div>
            <div class="col d-flex flex-column ">
                <img src="img/homepage/d2.jpg" alt="...">
                <h5>Chinese</h5>
            </div>
            <div class="col d-flex flex-column ">
                <img src="img/homepage/d2.jpg" alt="...">
                <h5>Chinese</h5>
            </div>
            <div class="col d-flex flex-column ">
                <img src="img/homepage/d2.jpg" alt="...">
                <h5>Chinese</h5>
            </div>
            <div class="col d-flex flex-column ">
                <img src="img/homepage/d2.jpg" alt="...">
                <h5>Chinese</h5>
            </div>
            <div class="col d-flex flex-column ">
                <img src="img/homepage/d2.jpg" alt="...">
                <h5>Chinese</h5>
            </div>
            <div class="col d-flex flex-column ">
                <img src="img/homepage/d2.jpg" alt="...">
                <h5>Chinese</h5>
            </div>
            <div class="col d-flex flex-column ">
                <img src="img/homepage/d2.jpg" alt="...">
                <h5>Chinese</h5>
            </div>
            <div class="col d-flex flex-column ">
                <img src="img/homepage/d2.jpg" alt="...">
                <h5>Chinese</h5>
            </div>
        </div>
    </div> -->

    <!---------------------------------- Eat Safe Eat -------------------------------------->
    <div id="eat-safe-container-fluid" class="pt-4 pb-4 mb-4 container-fluid">
    <div id="eat-safe-container" class="container mt-4 mb-4 pt-4">
        <div class="row justify-content-center">
                <h2>Eat Good, Eat Safe. Always! Now with the EatSure promise. </h2>
                <p class="bg-primary text-white">To keep your food safe and hygienic, here are some proactive steps that we have been taking.</p>
        </div>
        <div class="mt-3 d-flex align-items-center justify-content-around flex-wrap">
            <div class="justify-content-md-center mb-3">
                <div class="d-flex align-items-baseline">
                    <h2><i class="fa fa-thermometer-half h2 text-danger mr-1" aria-hidden="true"></i></h2>
                    <h5>Real-time Temperature Tracking of delivery staff</h5>
                </div>
                <div class="d-flex align-items-baseline">
                    <h2><i class="	fa fa-hand-stop-o h2 text-success mr-2" aria-hidden="true"></i></h2>
                    <h5>Contactless Delivery</h5>
                </div>
                <div class="d-flex align-items-baseline">
                    <h2><i class="fa fa-user-md h2 text-primary mr-2" aria-hidden="true"></i></h2>
                    <h5>Regular health check-ups for all the staff members</h5>
                </div>
            </div>
            <div class="">
                <iframe width="300" height="200" src="https://www.youtube.com/embed/pVRHkZ0fZ4U">
                </iframe>
            </div>
        </div>
    </div>
    </div>

    

    <!-------------------------------- Famous restaurant in the city ------------------------------------->
    <div class="container-fluid mt-4 pt-4 ">
        <div class="d-flex justify-content-between">
            <h2>Famous Restaurants in the city</h2>
            <h4><a href="searched.php#restaurant" class="mr-4"> See All</a></h4>
        </div>
    </div>
    <br>

    <!----------------------------------- famous restaurent slider----------------------------------->
    <div id="famous-restaurant-slider-container" class="container-fluid">
        <div class="row">
            <?php 
             $sql2 = "SELECT * FROM restaurant";
             $result2 = $conn->query($sql2);
            if ($result2) 
            {
                $i = 0;
                while($row = $result2->fetch_assoc()) 
                {
                    if($i > 8)
                    {
                    break;
                    }
                    $rname = $row['resname'];
                    $address = $row['address'];
                    $cur_rid = $row['id'];
                    //$price = $row['price'];
             
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                <div class="card border-0 text-left">
                    <img src="https://source.unsplash.com/1600x900/?hotel" class="card-img-top" alt="...">
                    <div class="card-body pl-0">
                        <h5 class="card-title"><a href="restaurant-menu.php?resid=<?php echo $cur_rid ?>"><?php echo $rname ?></a></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $address?> </h6>
                        <p class="card-text">Indian , italian , chinese , south-indian, cold-cafe , afgani......</p>
                        <div class=" d-flex">
                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                            <i class="fa fa-star-o text-dark" aria-hidden="true"></i>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a  href="restaurant-menu.php?resid=<?php echo $cur_rid ?>" class="card-link">Order Now</a>
                            <p>Rs 200/person</p>
                        </div>
                    
                        
                    </div>
                </div>
            </div>

        <?php       $i= $i+1;  
                }
            } 
        ?>
            
        </div>
    </div>

    <br><br><br>

    <!-------------------------------- footer ----------------------------------------->
    <div id="footer-container-fluid" class="container-fluid">
        <div id="footer-container" class="container">
            <div class="row pt-4 mt-3 text-light d-flex">
                <div class="column text-light p-3 m-2 flex-fill">
                    <h4 class="font-weight-bold">FoodShala</h4>
                    <a href="#"><p>AboutUs</p></a>
                    <a href="#"><p>News Room</p></a>
                    <a href="#"><p>FoodScene</p></a>
                    <a href="#"><p>Careers</p></a>
                    <a href="#"><p>Restaurent Sign up</p></a>
                    <a href="#"><p>Become a Rider</p></a>
                </div>
                <div class="column p-3 m-2 flex-fill">
                    <h4 class="font-weight-bold">Legal</h4>
                    <a href="#"><p>Terms And Conditions</p></a>
                    <a href="#"><p>privacy</p></a>
                    <a href="#"><p>Cookies</p></a>
                    <a href="#"><p>Modern Service Statements</p></a>
                </div>
                <div class="column p-3 m-2 flex-fill">
                    <h4 class="font-weight-bold">Help</h4>
                    <a href="#"><p>Contact</p></a>
                    <a href="#"><p>FAQs</p></a>
                    <a href="#"><p>Cuisines</p></a>
                    <a href="#"><p>Brands</p></a>
                    <a href="#"><p>Site map</p></a>
                </div>
                <div class="column p-3 m-2 flex-fill">
                    <h4 class="font-weight-bold">FoodShala with you</h4>
                    <a href="#"><img src="img/homepage/app.png"  alt=""></a>
                </div>
            </div>

            <div class="row mt-2 d-flex p-2 justify-content-between">
                <div class="d-flex">
                    <h3><a href="#"><i class="fa fa-twitter text-white mr-3" aria-hidden="true"></i></a></h3>
                    <h3><a href="#"><i class="fa fa-linkedin text-white mr-3" aria-hidden="true"></i></a></h3>
                    <h3><a href="#"><i class="fa fa-facebook text-white mr-3" aria-hidden="true"></i></a></h3>
                </div>
                <footer class="text-light"> &copy; Copyright 2020 FoodShala</footer>
            </div>
        </div>
    </div>

<!--======================================== scripts ========================================-->

<script src="js/swiper.min.js"></script>
<script src="js/homepage/myswiper.js"></script>

<!----------------------------------   typing effect js --------------------------------->
    <script>
        var i = 0;
        var txt = 'Hi Foodiee....';
        var txt2 = "Happy to see you here..."
        var speed = 100;
        var textSwitch =0; 

        function typeWriter() 
        {
            if (i < txt2.length) 
            {
                if(textSwitch == 0)
                    document.getElementById("heading").innerHTML += txt.charAt(i);
                else
                    document.getElementById("heading").innerHTML += txt2.charAt(i);
                i++;
                setTimeout(typeWriter, speed);

            }
            else
            {
                i=0;
                if(textSwitch == 1)
                {
                    textSwitch = 0;
                }
                else
                    textSwitch = 1;
                
                document.getElementById("heading").innerHTML="";
                setTimeout(typeWriter,400);
            }
        }
    </script>

</body>

</html>

<?php } ?>