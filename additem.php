<?php

    session_start();
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


    // define variables and set to empty values
    $name = $price = $description = $veg  = $file ="";
    $msg = " ";
    function test_input($data) 
    {
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $price = test_input($_POST["price"]);
    $description = test_input($_POST["description"]);
    $veg = test_input($_POST["veg"]);
    $fileName = "";

    // file upload here.....
    if (isset($_FILES['item-img']) && $_FILES['item-img']['error'] === UPLOAD_ERR_OK) 
    {
     
        $fileTmpPath = $_FILES['item-img']['tmp_name'];
        $fileName = $_FILES['item-img']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));    
        

        $allowedfileExtensions = array('jpg', 'gif', 'png' , 'jpeg');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = './img/uploads/';
            $dest_path = $uploadFileDir . $fileName;
            
            if(move_uploaded_file($fileTmpPath, $dest_path))
            {
                echo "hhhhh";
                $message ='File is successfully uploaded.';
            }
            else
            {
                $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            }
        }
    }
    // file upload finished... 
    echo $fileName;
    // prepare and bind
    $stmt = $conn->prepare("INSERT INTO menu(name, price , description , veg , resid , file) VALUES (?, ?, ?, ?, ? , ?)");
    $stmt->bind_param('ssssss',$name, $price, $description, $veg, $_SESSION['resid'] , $fileName);
    if($stmt->execute())
    {
        $msg="success";
    }


    $stmt->close();
    $conn->close();
    echo "<script> location.href='/foodorder/restaurant-admin.php'; </script>";
    exit;

    }
    ?>