
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

    <!------------- my css --------------->
    <link rel="stylesheet" href="css/register/register.css">


</head>
<body>
    <!----------------------------------------- this file registers customer --------------------------------->

    <?php
   
    $name = $email = $password = $city = $address = $phone ="";
    $msg = " ";
    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $upassword = test_input($_POST["password"]);
    $phone = test_input($_POST["phone"]);
    $city = test_input($_POST["city"]);
    $address = test_input($_POST["address"]);
    $hashed_password = password_hash($upassword, PASSWORD_DEFAULT);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "foodshala";

        
        // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        echo "here";
    die("Connection failed: " . $conn->connect_error);
    }

    // prepare and bind
    $stmt = $conn->prepare("INSERT INTO customer(name, phone, email , password, city , address) VALUES (?, ?, ?,?, ?, ?)");
    $stmt->bind_param('sissss',$name, $phone, $email, $hashed_password, $city, $address);
    $msg="";
    if($stmt->execute())
    {
        $msg="successfully registered..... now login";
    }

    $stmt->close();
    $conn->close();

    }
    
    ?>
    <!----------------------- navbar ----------------------------->
    <nav class="navbar navbar-fixed-top navbar-expand-md bg-white navbar-light d-flex align-items-baseline">
        <div class="container">
            <a class="h2 font-weight-bold text-dark" href="index.php">Food<span class="text-primary" >Shala</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto nav-login">
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" href="restaurant-register.php">Restaurant Registration</a>
                    </li>
                    
                </ul>
            </div>  
        </div>
    </nav>

    
    <!------------------------------------ used login form  template here also -------------------------------->
    <div class="container c-register-container">
            <div class=" row d-flex justify-content-around">
                <div class="c-register-form">
                    <div class="d-flex justify-content-center p-1 bg-light">
                        <h4 class="text-success"><?php echo $msg ?></h4>
                    </div>
                    <h2>Customer Registration</h2>
                    <form name="c-register-form" method="post" action="customer-register.php" onsubmit="return validateform()">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Your Name " name="name" value="" />
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Your Email " name="email" value="" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password You wanna set...." name="password" value="" />
                        </div>
                        <div class="form-group d-flex">
                            <input type="tel" class="form-control w-50 mr-2" placeholder="Your Phone number" name="phone" value="" />
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="city">
                                <option>Bhopal</option>
                                <option>Indore</option>
                                <option>Bangalore</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="5" placeholder="Your Address..." name="address" id="comment"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Register" />
                        </div>
                    </form>
                </div>
            </div>
    </div>
   
    <script>
        function validateform()
        {            
            console.log("in here1");
            var name = document.forms["c-register-form"]["name"].value;
            var email = document.forms["c-register-form"]["email"].value;
            var password = document.forms["c-register-form"]["password"].value;
            var phone = document.forms["c-register-form"]["phone"].value;
            var address = document.forms["c-register-form"]["address"].value;
            if (name == "" ||email == "" || password == "" || phone == "" || address == "" ) {
                console.log("in here 2");
                alert("All the fields must be filled out");
                return false;
            }
            // all feilds written now 
            
        }
    </script>
</body>
</html>