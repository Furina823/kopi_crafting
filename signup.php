<?php
if (isset($_POST['sub'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $psw = $_POST['pass'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    include('connection.php');

    // Validate phone number format
    if (!preg_match('/^\d{3}-\d{7,8}$/', $phone)) {
        echo "<script>alert('Error: Phone number must be in the format XXX-XXXXXXX or XXX-XXXXXXXX, and contain 10 or 11 digits.')</script>";
    } else {
        // Check if email already exists
        $check_email_query = "SELECT cus_email FROM customers WHERE cus_email='$email'";
        $check_email_result = $dbConn->query($check_email_query);
        if ($check_email_result->num_rows > 0) {
            // Email already exists, display error
            echo "<script>alert('Error: Email already registered')</script>";
        } else {
            // Email does not exist, proceed with insertion
            $insert_query = "INSERT INTO customers (cus_name, cus_email, cus_password, cus_phone_number, cus_address) VALUES ('$name', '$email', '$psw', '$phone', '$address')";
            if (mysqli_query($dbConn, $insert_query)) {
                echo "<script>alert('Signup successfully')</script>";
            } else {
                echo "Error: " . $insert_query . "" . mysqli_error($dbConn);
            }
        }
    }
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
    <title>Sign Up</title>
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
            top: 10px;
            position: relative;
            width: 700px;
            height: 520px;
            background: transparent;
            border: 2px solid rgba(255,255,255,.5);
            border-radius: 20px;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 30px rgba(0,0,0,.5);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .wrapper .form-register{
            width: 100%;
            padding: 10px 30px 10px 30px;
        }

        .form-register h2{
            font-size: 1.5em;
            color: #281b12;
            text-align: center;
        }

        .form-register .logo img{
            width: 150px;
            height: 150px;
        }
        .input{
            position: relative;
            width: 100%;
            height: 50px;
            border-bottom: 2px solid #281b12;
            margin: 6px 0;
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

        .input-group {
            display: grid;
            grid-template-columns: 1fr 1fr; /* Two columns */
            grid-column-gap: 20px; /* Gap between columns */
            margin-bottom: 30px;
        }

        .input-column {
            display: flex;
            flex-direction: column;
            gap: 10px; /* Gap between inputs */
        }


    </style>
</head>
<body>
    <body>
        <div class="wrapper">
            <div class="form-register">
                <div class="logo">
                    <center><img src="image/KopiCraftingLogo.png" alt="logo"></center>
                </div>
                <h2>Sign In</h2>
                <form method="post">
                    <div class="input-group">
                        <div class="input-column">
                            <div class="input">
                                <input type="text" name="name" required />
                                <label>Name</label>
                            </div>
                            <div class="input">
                                <input type="email" name="email" required />
                                <label>Email</label>
                            </div>
                            <div class="input">
                                <input type="password" name="pass" required />
                                <label>Password</label>
                            </div>
                        </div>
                        <div class="input-column">
                            <div class="input">
                                <input type="text" name="phone" required />
                                <label>Phone Number</label>
                            </div>
                            <div class="input">
                                <input type="text" name="address" required />
                                <label>Address</label>
                            </div>
                        </div>
                    </div>
                    <div class="forgot">
                        <label><input type="checkbox">Agree to Terms & Conditions</label>
                    </div>
                    <button type="submit" class="login_button" name="sub">Sign Up</button>
                    <div class="register">
                        <p>Already have an account? <a href="login.php" class="login_link">Log In</a></p>
                    </div>
                </form>
            </div>
        </div>
    </body>
    
</body>
</html>

