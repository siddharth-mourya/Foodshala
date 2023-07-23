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
    <link rel="stylesheet" href="css/restaurant-admin/restaurant-admin.css">

    <!-------------- swiper -------------->
    <link rel="stylesheet" href="css/homepage/swiper.min.css">


</head>
<body >
<?php 
    if(isset($_SESSION['restaurant']))
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
        $restaurant_id = $_SESSION['resid'];
        $sql1 = "SELECT * FROM restaurant where id = '$restaurant_id'";
        $result = $conn->query($sql1);    

        
               
        if ($result->num_rows > 0) 
        {
          while($row = $result->fetch_assoc()) 
          {
            $rname = $row['resname'];
            $raddress = $row['address'];
          }
        }
               


        $sql = "SELECT * FROM menu where resid = '$restaurant_id'";
        $result = $conn->query($sql);
        
    
    ?>
    <! <!----------------------- navbar ----------------------------->
    <nav class="navbar navbar-fixed-top navbar-expand-md bg-white navbar-light d-flex align-items-baseline">
        <div class="container">
            <a class="h2 font-weight-bold text-dark" href="#">Food<span class="text-primary" >Shala</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto nav-login">
                    <?php
                        if(isset($_SESSION['email']))
                        {
                    ?>
                         <li class="nav-item">
                            <div class="dropdown show">
                                <a class="nav-link font-weight-bold dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Hi Owner
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
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
                                    <a class="dropdown-item" href="restaurant-register.php">Restaurant</a>
                                </div>
                            </div>
                        </li>
                    <?php  } ?>
                </ul>

            </div>  
        </div>
    </nav>

    <!-------------------------------------------- header ----------------------------------------------->
    <div id="restaurant-info-fluid" class="container-fluid">
        <div class="container ">
            <div class="d-flex justify-content-start flex-wrap">
                <div id="img-div">
                    <img src="img/restaurant-menu/sagar.jpg" alt="">
                </div>
                <div id="restaurant-info" class="">
                    <div>
                        <h2><?php echo $rname  ?>  <span class="text-warning">Admin Panel</span></h2>
                        <h6>Chinese , Italian , Afhgani , Fast-food , Indian</h6>
                        <h5><?php echo $raddress  ?> </h5>
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

    <!---------------------------------------- switching tabs  ----------------------------------------->
    <div id="heading-menu" class="d-flex justify-content-center m-3">
         <ul class="nav justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active " id="pills-menu-tab" data-toggle="pill" href="#menu" role="tab" aria-selected="true">Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-add-item-tab" data-toggle="pill" href="#add-item" role="tab"  aria-selected="false">Add Item</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-check-order-tab" data-toggle="pill" href="#check-order" role="tab"  aria-selected="false">Check Orders</a>
            </li>
        </ul>
    </div>
    

    

    <!--------------------------------------- menu -------------------------------------------->
    <div id="cuisines" class="container">
        <div class="tab-content row d-flex justify-content-around "> 
            <div class="tab-pane col-md-12 fade show active" id="menu" role="menu" aria-labelledby="pills-menu-tab">
                <!-------------------------- internal dishes of restauant ------------------------>
                    <?php if ($result->num_rows > 0) 
                            {
                            while($row = $result->fetch_assoc()) 
                                { 
                    ?>
                    <div class="food-item-row row d-flex flex-wrap justify-content-between align-items-center pt-3 pl-3 pr-3">
                        <div class="w-75">
                            <h5>
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
                            <!---<a href="#" onclick="deleteMenu(<?php echo $row['id'];?>)" class="btn btn-danger"> Delete</a> -->
                            <img src="img/uploads/<?php echo $row['file'];?>" alt="" onerror="this.onerror=null; this.src='img/searched/si.jpg'">
                        </div>
                    </div><hr>
                    <?php  }
                        }
                    ?>
                    
                   
                    
            </div>
            <div class="tab-pane col-md-12 fade " id="add-item" role="add-item" aria-labelledby="pills-add-item-tab">
                <div class="d-flex justify-content-center">
                <div class="menu-add-form">
                    <h2>Add new menu Item</h2>
                    <form name="add-form" method="post" action="additem.php" onsubmit="return validateform()" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Menu Item Name " name="name"  value="" />
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="price" name="price" value="" />
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="5" placeholder="Desription of Dish..." name="description" id="comment"></textarea>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="veg">
                                <option>Veg</option>
                                <option>Non-veg</option>
                            </select>
                        </div>             
                        <div class="custom-file mb-2">
                            <input type="file" name="item-img" class="custom-file-input">
                            <label class="custom-file-label">Choose file</label>
                        </div>         
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Add Dish" />
                        </div>
                    </form>
                </div>
                </div>
            </div>
            <div class="tab-pane col-md-12 fade " id="check-order" role="check-order" aria-labelledby="pills-check-order-tab">
                <h4 class="text-danger text-center">No order to accept</h4>
            </div>
        </div>
    </div>

    <script>
        function validateAddForm()
        {
            var name = document.forms["add-form"]["name"].value;
            var price = document.forms["add-form"]["price"].value;
            var description = document.forms["add-form"]["description"].value;
            if (name == "" || price == "" || description == "" ) {
                console.log("in here 2");
                alert("some fields are empty :(");
                return false;
            }
            // all feilds written now 
        }
    </script>


</body>
</html>

<?php 

    $conn->close();
    }
    else 
    echo "<script> location.href='/foodorder/login.php'; </script>";
?>
