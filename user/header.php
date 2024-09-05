<?php
    include 'cart.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../staff/kopi.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="script.js"></script>    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@500;700&display=swap');

        .header{
            position: fixed;
            background: url(../image/header-background.jpg);
            background-size: contain;
            height: 100px;
            width: 100%;
            border-bottom: var(--border);
            white-space: wrap;
            text-align: center;
            z-index: 100000;
        }

        .header span{
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .header .logo img{
            margin-left: 20px;
            height: 90px;
            width: 90px;
        }

        .header .container{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .navigation{
            display: flex;
            align-items: center;
        }

        .header .navigation a{
            font-size: 1.8rem;
            color: var(--black);
            position: relative;
            font-weight: 500;
            margin-left: 60px;
        }

        .navigation a::after{
            content:'';
            position: absolute;
            left: 0;
            bottom: -6px;
            width: 100%;
            height: 3px;
            background: #74746c;
            border-radius: 5px;
            transform-origin: center;
            transform: scaleX(0);
            transition: transform .5s;
        }

        .navigation a:hover::after{
            transform-origin: center;
            transform: scaleX(1);
        }

        .header .container .profile{
            width: 50px;
            height: 50px;
            margin-right: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: transparent;
        }

        .header .container .profile button i{
            color: var(--black);
            font-size: 2rem;
            margin-right: 20px;
            cursor: pointer;
        }

        .header .container .profile button, .header .container .profile button:focus {
            background-color: transparent;
        }

        @media (max-width: 768px){
            .header .navigation a{
                font-size: 15px;
                margin-left: 20px;
            }
        }
    </style>
</head>
<body>
    <!--Header-->
    <header class="header">
        <div class="container">
            <span class="logo"><a href="menu.php"><img src="../image/KopiCraftingLogo.png" alt="logo"></a></span>
            <div class="navigation">
                <a href="shop.php"><strong>SHOP</strong></a>
                <a href="aboutus.php"><strong>ABOUT US</strong></a>
                <a href="blog.php"><strong>BLOG</strong></a>
            </div>
            <div>
            </div>
            <span class="profile">
                <button onclick="toggleCart()"><i class="fa-solid fa-cart-shopping" id="cart"></i></button>
                <button onclick="toggleProfile()"><i class="fa-solid fa-user" id="profile"></i></button>
            </span>
        </div>
    </header>
</body>

</html>


