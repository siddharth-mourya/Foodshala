<?php
    $email = $password = "";
    $msg = " ";
    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $email = test_input($_POST["email"]);
        $upassword = test_input($_POST["password"]);

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

        $sql = "SELECT name,email,password FROM customer where email = '$email'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) 
        {
          while($row = $result->fetch_assoc()) 
          {
            $rname = $row['name'];
            $remail = $row['email'];
            $rpassword = $row['password'];
            
            if(password_verify($upassword, $rpassword))
            {
                $conn->close();
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $rname;
                echo "<script> location.href='/foodorder/index.php'; </script>";
                exit;
            }
          }
        } 
        $conn->close();
        echo "<script> location.href='/foodorder/login.php'; </script>";
        exit;

    }
    
    ?>