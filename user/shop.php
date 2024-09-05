<?php

include '../connection.php';

    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: ../login.php");
        exit();
    }

    if(isset($_POST['order'])) {
        $order = $_POST['order'];
        $sql = "SELECT * FROM products ORDER BY product_price $order ";
    } elseif(isset($_POST['product_type'])) {
        $type = $_POST['product_type'];
        $sql = "SELECT * FROM products WHERE product_type = '$type'";
    } else {
        $sql = 'SELECT * FROM products';
    }

    $result = mysqli_query($dbConn, $sql);

    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    $sql = 'SELECT DISTINCT product_type FROM products';

    $result = mysqli_query($dbConn, $sql);

    $products_type = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    mysqli_close($dbConn);
    ?>

<?php
    include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../staff/kopi.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Shop - Kopi Crafting</title>
    <link rel="shortcut icon" type="image/png" href="image/KopiCraftingLogo.png">
    <style>
        body{
            background-color: #f5f5f5;
        }
        
        #product_list{
            margin: 0;
            height: 100vh;
            flex-direction: row;
            padding: 0;
            box-sizing: border-box;
            width: 100%;
        }

        .nav_bar{
            flex: 0 0 250px;
            top: 80px;
            position: fixed;
            width: 250px;
            height: 100vh;
            padding: 15px;
            background-color: white;
        }

        .nav_bar h3{
            display: block;
            font-size: 18px;
            padding: 10px 0;
            color: #281b12 ;
        }

        .nav_bar button{
            background-color: transparent;
            padding: 10px 24px;
            margin-bottom: 15px;
            font-size: 15px;
            color: #281b12;
            cursor: pointer;
            border: 0.2rem solid rgba(175,160,151);
            border-radius: 1rem;
            width: 150px;
        }

        .nav_bar button:hover{
            background-color: #281b12;
            color: #f8e2c7;
            border: 0.2rem solid #281b12;
        }
        
        .right_side{
            flex: 1;
            padding: 20px;
            padding-left: 270px;
            box-sizing: border-box;
            width: 100%;
        }

        .right_side h1{
            padding-left: 30px;
            font-size: 3rem;
            text-transform: uppercase;
            color: #7e6956;
            margin-bottom: 20px;
            margin-top: 100px;
        }
        
        
        .product_container{
            display: grid;
            grid-template-columns: repeat(auto-fit, 23rem);
            gap: 2rem;
        }

        .product_container .content{
            text-align: center;
            padding: 2rem;
            border: 0.2rem solid rgba(175,160,151);
            border-radius: 0.5rem;
            background-color: white;
            box-shadow: 2px 5px 14px #888888;
        }

        .product_container .content img{
            width: 100%;
            margin: 0 auto;
        }
        
        .content h3{
            margin: 1rem 0;
            font-size: 1.5rem;
            color: var(--black);
            text-transform: uppercase;
            height: 4rem;
        }

        .content .price{
            font-size: 1.7rem;
            color: var(--color1);
            margin: 1rem 0;
        }
        

        .cart_btn{
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

        .cart_btn:hover{
            transform: scale(1.1);
        }

        .right_footer{
            margin-left: 250px;
        }

    </style>
    <script src="script.js"></script>
</head>
<body>
    <div id="product_list">
        <div class="layout_shop">
            <div class="nav_bar">
                <br><br>
            <h3>Category</h3>
            <br>
            <nav>
                <h3>Sort By Price</h3>
                <button type="button" onclick="sortProducts('ASC')">Ascending</button>
                <br>
                <button type="button" onclick="sortProducts('DESC')">Descending</button>
                <br>
                <!-- Form for sorting by type -->
                <h3>Sort By Type</h3>
                <?php foreach ($products_type as $product_type): ?>
                        <button type="button" onclick="filterProducts('<?php echo htmlspecialchars($product_type['product_type'])?>')">
                            <?php echo htmlspecialchars($product_type['product_type']);?>
                        </button>
                        <br>
                <?php endforeach; ?>
            </nav>
            </div>
            <div class="right_side">
                <h1>Shop</h1>
                <div class="product_container">
                    <?php foreach($products as $product): ?>
                    <div class="content">
                        <img src="../product/<?php echo $product['product_image']; ?>" alt="product image">
                        <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
                        <div class="price"><?php echo "RM " . number_format($product['product_price'], 2);?></div>
                        <a href="product.php?id=<?php echo htmlspecialchars($product['product_id']); ?>" target="_blank"><button class="cart_btn">Add To Cart</button></a>
                    </div>
                    <?php endforeach; ?>
                </div>
            
            </div>
            <div class="right_footer">
                    <?php include '../footer.php'?>
            </div>
        </div>
    </div>

</body>
</html>


          