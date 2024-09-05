<?php
session_start ();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../staff/kopi.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="shortcut icon" type="image/png" href="../image/KopiCraftingLogo.png">
    <style>
        .container_empty{
            position: absolute;
            width: 100%;
            margin: auto;
            height: 100%;
            display: flex;
            background-color: #f5f5f5;
            z-index: 100;
        }
        .right_side_empty {
            width: 100%;
            box-sizing: border-box;
            float: left;
            height: 100%;
        }

        .right_side_empty h2 {
            font-size: 2rem;
            padding: 10px;
            padding-left: 30px;
            color: #7e6956;
        }

        .right_side_empty p{
            font-size: 1.5rem;
        }
        .content_empty {
            height: auto;
            margin-top: 2%;
        }

        .content_empty button{
            text-decoration: none;
            font-size: 1.5rem;
            color: #f8e2c7;
            background-color: var(--black); 
            cursor: pointer;
            text-align: center;
            padding: .9rem 2rem;
            border-radius: .5rem;
            transition: transform 0.3s ease-in-out;
        }

        .content_empty button:hover{
            transform: scale(1.1);
        }

    </style>
</head>
<body>
    <div class="container_empty"> <!--Page Layout-->

        <div class="right_side_empty"><!--Right Side-->
            <h2>Cart</h2>
            <div class="content_empty">
                <center>
                <img src="../image/KopiCraftingLogo.png" alt="" width="200px" height="200px">
                <p>Your shopping cart is empty</p>
                <br>
                <form action="shop.php">
                <button>Go to Shop Now</button>
                <br> <br> <br>
                </form>
                </center>
            </div>
        </div>
    </div>

</body>
</html>