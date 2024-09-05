 <?php

//Include database connection configuration
require 'connection.php';

//Check if the form is submintted
if(isset($_POST["sub"])) {
    //Retrieve user and password from the form
    $user = $_POST["email"];
    $pass = $_POST["password"];

    //SQL query to select user from the database with provided info
    $sql = "SELECT cus_email, cus_password FROM customers WHERE cus_email='$user' AND cus_password='$pass'";

    //Execute SQL
    $result = $dbConn ->query($sql);

    //Check if any row returned from query
    if($result->num_rows > 0){
        //Starting a session to manage user login state by email
        session_start();
        $_SESSION["email"] = $user;

        //Redirect user to the other page after successful login
        echo "<script>alert('Login Success. Welcome! '); window.location.href='user/menu.php';</script>";
        exit();
    } else {
        //If user not found in customers table, try finding in staffs table
        $sql = "SELECT * FROM staffs WHERE staff_email='$user' AND staff_password='$pass'";
    
    // Execute SQL
    $result = $dbConn->query($sql);

    // Check if any row returned from query
    if ($result->num_rows > 0) {
        // Fetch the row
        $row = $result->fetch_assoc();
        
        // Check user status
        if ($row['staff_status'] == 'Admin') {
            // Starting a session to manage user login state by email
            session_start();
            $_SESSION["email"] = $user;
            // Redirect admin to admin home page
            echo "<script>alert('Admin Login Success. Welcome! '); window.location.href='admin/menu_staff.php';</script>";
            exit();
        } else if ($row['staff_status'] == 'Staff') {
            session_start();
            $_SESSION["email"] = $user;
            // Redirect staff to staff home page
            echo "<script>alert('Staff Login Success. Welcome! '); window.location.href='staff/menu_staff.php';</script>";
            exit(); 
        }
    } else {
        // Displaying an error message if login is incorrect 
        echo "<script>alert('Username and Password do not match')</script>";
    }
}

// Close the connection
$dbConn->close();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" type="image/png" href="image/KopiCraftingLogo.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<title>Login</title>
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body{
        display: flex;
        justify-content: center;
        align-items: center;
        background: url('image/background.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: repeat;
    }

    .wrapper{
        top: 15px;
        position: relative;
        width: 400px;
        height: 495px;
        background: transparent;
        border: 2px solid rgba(255,255,255,.5);
        border-radius: 20px;
        backdrop-filter: blur(20px);
        box-shadow: 0 0 30px rgba(0,0,0,.5);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .wrapper .form-login{
        width: 100%;
        padding: 40px;
    }

    .form-login h2{
        font-size: 1.5em;
        color: #281b12;
        text-align: center;
    }

    .form-login .logo{
        padding-top: 10px;
    }

    .form-login .logo img{
        width: 150px;
        height: 150px;
    }
    .input{
        position: relative;
        width: 100%;
        height: 50px;
        border-bottom: 2px solid #281b12;
        margin: 30px 0;
    }
    .input label{
        position: absolute;
        top: 50%;
        left: 5px;
        transform: translateY(-50%);
        font-size: 1em;
        color: #281b12;
        font-weight: 500;
        pointer-events: none;
        transition: .5s;
    }

    .input input:focus~label, .input input:valid~label{
        top: -5px;
    }

    .input input{
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        font-size: 1em;
        color: #281b12;
        font-weight: 600;
        padding: 0 35px 0 5px;
    }

    .input .icon i{
        position: absolute;
        right: 8px;
        font-size: 1.2em;
        color: #281b12;
        line-height: 57px;
    }

    .forgot{
        font-size: .9em;
        color: #281b12;
        font-weight: 500;
        margin: -15px 0 15px;
        text-align: center;
    }

    .forgot label input{
        accent-color: #281b12;
    }

    .forgot a{
        color: #281b12;
        text-decoration: none;
    }

    .forgot a:hover{
        text-decoration: underline;
    }

    .login_button{
        width: 100%;
        height: 45px;
        background: #281b12;
        border: none;
        outline: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 1em;
        color: #f8e2c7;
        font-weight: 500;
    }
    .register{
        font-size: .9em;
        color: #281b12;
        text-align: center;
        font-weight: 500px;
        margin: 10px 0 10px;
    }

    .register_link, .login_link{
        color: #281b12;
        text-decoration: none;
        font-weight: 600;
    }

    .register_link:hover, .login_link:hover{
        text-decoration: underline;
    }

</style>
</head>
<body>
<div class="wrapper">
    <div class="form-login">
        <div class="logo">
            <center><img src="image/KopiCraftingLogo.png" alt="logo"></center>
        </div>
        <h2>Login</h2>
        <form method="post" id="loginForm">
            <div class="input">
                <span class="icon"><div><i class="fa-solid fa-envelope"></i></div></span>
                <input type="email" name="email" required>
                <label>Email</label>
            </div>
            <div class="input">
                <span class="icon"><i class="fa-solid fa-lock"></i></span>
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <div class="forgot">
                <a href="passwordreset.html">Forgot Password?</a>
            </div>
            <button type="submit" class="login_button" name="sub">Login</button>
            <div class="register">
                <p>Don't have an account? <a href="signup.php" class="register_link">Sign In</a></p>
            </div>
        </form>
    </div>
</body>
</html>


