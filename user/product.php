<?php

session_start ();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}
include '../connection.php';
include 'header.php';

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

    if (isset($_GET['id'])) {
        // Get the product_id from the URL parameter
        $product_id = $_GET['id'];
        // Query to fetch product data based on the product ID
        $sql = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $dbConn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Check if product with the given ID exists
        if ($result->num_rows > 0) {
            // Product found, display product details
            $row = $result->fetch_assoc();
            $productName = $row["product_name"];
            $productDescription = $row["product_description"];
            $productImage = $row["product_image"];
            $productprice = $row["product_price"];
        } else {
            echo "Product not found.";
        }
    } else {
        echo "No product selected.";
    }
    
    // Debug: Print any SQL errors
    if ($stmt->error) {
        echo "SQL error: " . $stmt->error;
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../staff/kopi.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title><?php echo htmlspecialchars($productName);?> - Kopi Crafting</title>
    <link rel="shortcut icon" type="image/png" href="../image/KopiCraftingLogo.png">
    <style>
        body{
            background-color: #f5f5f5;
        }
        
        .each_product{
            padding-top: 120px;
        }
        .each_product_container{
            margin: auto;
            width: 70%;
            margin-bottom: 40px;
            border-radius: 2rem;
            padding: 70px 0;
            background: url(../image/product_frame.png);
            background-size: cover;
            background-color: white;
            background-position: center;
            box-shadow: 2px 5px 14px #888888;
            
        }

        .product{
            display: flex;
            flex-direction: row;
            box-sizing: border-box;
            align-items: center;
        }

        .image{
            padding: 70px 10px 70px 150px;
            flex: 1;
            
        }

        .image img{
            width: 90%;
            border-radius: .5rem;
        }

        .right_side{
            padding: 70px 150px 70px 10px;
            flex: 1;
        }

        .right_side .quantity{
            font-size: 1.5rem;
            align-items: center;
        }

        .quantity input[type="number"]{
            text-align: center;
            font-size: 1.5rem;
            border: none;
            color: #281b12;
        }

        .quantity p{
            font-size: 1.5rem;
        }

        .quantity strong{
            color: #7e6956;
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

    </style>
    <script>
        // Function to calculate and update the total price
        function calculateTotalPrice() {
        // Get the quantity input value
        var quantity = document.getElementById("quantity").value;

        // Get the product price fetched from PHP
        var productPrice = <?php echo $productprice; ?>;

        // Calculate the total price
        var totalPrice = productPrice * quantity;

        // Update the total price display
        document.getElementById("totalPrice").textContent = totalPrice.toFixed(2);

        // Update the total paid amount in the hidden input field
        document.getElementById("total_paid").value = totalPrice.toFixed(2);

    }
        
        // Function to initialize total price when the page loads
        window.onload = function() {
            calculateTotalPrice(); // Calculate and display total price initially
        };

    </script>
</head>
<body>
    <div class="each_product">
    <div class="each_product_container"> <!--Main Layout-->
        <div class="product"> <!--Content Container-->
            <div class="image"> <!--Image-->
                <img src="../product/<?php echo htmlspecialchars($productImage); ?>" alt="Logo">
            </div>
            <div class="right_side">
                <div class="product_information"> <!--Product Information-->
                    <h1><?php echo htmlspecialchars($productName);?></h1>
                    <br><br>
                    <h2><?php echo htmlspecialchars($productDescription);?></h2>
                </div>
                <br>
                <div class="quantity">
                    <div>
                    <form action="cartvalidation.php" method="post">
                    <label for="quantity"><b>Quantity:</b></label> &nbsp; &nbsp;
                    <input type="number" value="1" name="quantity" id="quantity" min="1" max="99" onchange="calculateTotalPrice()">
                    <!-- Include hidden input field to pass total paid amount -->
                    <input type="hidden" name="product_id" id="product_id" value="<?php echo $product_id; ?>">
                    <input type="hidden" name="total_paid" id="total_paid" value="0">
                    <input type="hidden" name="product_price" id="product_price" value="<?php echo $productprice;?>">
                    <br><br>
                    <p><strong>Total Price:</strong>&nbsp; &nbsp;RM<span id="totalPrice">0</span></p>
                    <br>
                    <input type="submit" value="Add Cart" class="cart_btn">
                  </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>

<?php include '../footer.php' ?>
