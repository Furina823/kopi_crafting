<?php
session_start ();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}
include '../connection.php';
include 'header.php';

if (!$dbConn) {
    echo "Connection error:" . mysqli_connect_error();
}

// Starting a PHP session
if (isset($_SESSION['email'])) {
    // Access session variable
    $email = $_SESSION['email'];

    $sql ="SELECT * FROM customers WHERE cus_email = ?";
    $stmt = $dbConn ->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt-> get_result();

    if($result-> num_rows > 0){
        $row = $result->fetch_assoc();
        $id=$row['cus_id'];
        $name=$row['cus_name'];
        $address=$row['cus_address'];
        $email=$row['cus_email'];
        $phone_number=$row['cus_phone_number'];
    }

} else {
    // Handle case where session variable 'id' is not set
    echo "Session variable 'id' is not set.";
}


// Initialize an array to store cart items with product names
$cart_items_with_names = array();


// Checking if product IDs are passed in the URL
if (isset($_GET['cart_product_id'])) {
    // Retrieving the product IDs from the URL
    $product_ids = $_GET['cart_product_id'];

    // Loop through each product ID
    foreach ($product_ids as $product_id) {
        // Prepare a SELECT query to retrieve the cart item with product name
        $query = "SELECT carts.*, products.product_name, products.product_image
                  FROM carts
                  JOIN products ON carts.product_id = products.product_id 
                  WHERE carts.product_id = $product_id AND carts.cus_id = $id";

        // Execute the query
        $result = mysqli_query($dbConn, $query);

        // Check if the query was successful
        if ($result) {
            // Fetch the row as an associative array and store it in the $cart_items_with_names array
            $cart_item_with_name = mysqli_fetch_assoc($result);
            $cart_items_with_names[] = $cart_item_with_name;
        } else {
            // Handle query error
            echo "Error retrieving cart item for product ID: $product_id - " . mysqli_error($dbConn);
        }
    }
} else {
    // Redirect back to the previous page if no product is selected
    echo "<script>alert('You haven\'t selected any product to checkout');</script>";
    echo "<script>window.history.back();</script>";
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
    <title>Check Out - Kopi Crafting</title>
    <style>
        .check_out{
            padding: 120px 100px 10px 100px;
        }
        .check_out h2{
            font-size: 2.5rem;
            padding-bottom: 20px;
            text-transform: uppercase;
        }

        .check_out h2 span{
            color: #7e6956;
            text-transform: uppercase;
        }

        .check_out .container{
            margin: 0;
            min-height: 10vh;
            flex-direction: row;
            box-sizing: border-box;
            width: 100%;
            display: flex;
            padding: 20px;
            background-color: white;
            border-radius: 1.5rem;
            box-shadow: 2px 5px 14px #888888;
        }

        .check_out .container .left_side{
            flex: 0 0 300px;
            border-right: 0.2rem solid rgba(175,160,151); 
        }

        .left_side p{
            padding: 10px;
            font-size: 1.5rem;
            text-transform: none;
        }

        .left_side strong{
            color: #7e6956;
        }

        .check_out .container .right_side{
            flex: 1;
            padding: 20px;
            width: 500px;
            
        }

        .right_side .product{
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.5rem;
        }


        .product_details img{
            width: 200px;
            height: auto;
            padding-bottom: 10px;
        }

        .right_side_bottom{
            padding: 20px;
            margin-top: 50px;
            
        }

        .right_side_bottom table{
            width: 1000px;
        }

        .right_side_bottom table td{
            padding: 10px;
            font-size: 1.5rem;
        }

        .right_side_bottom table td:first-child{
            border-bottom: 0.2rem solid rgba(175,160,151);
        }

        .right_side_bottom table td:last-child{
            margin-left: auto;
            margin-right: 30px;
        }

        input[type="submit"]{
            width: 140px;
            height: 30px;
            text-transform: uppercase;
            font-size: 1.3rem;
            color: #f8e2c7;
            background-color: var(--black); 
            cursor: pointer;
            border-radius: .5rem;
            padding: .8rem 1rem .8rem 1rem;
        }

        select{
            font-size: 1.5rem;
        }

    </style>
</head>
<body>
    <div class="check_out">
        <center>
            <div>
                <h2><span>Your</span> Order</h2>
            </div>
        </center>
        <div class="container"> <!--Layout-->
            <div class="left_side"> <!--Left side-->
                <p><strong>Username</strong> <br><?php echo htmlspecialchars($name);?></p>
                <p><strong>Address</strong> <br><?php echo htmlspecialchars($address);?></p>
                <p><strong>Email</strong> <br><?php echo htmlspecialchars($email);?></p>
                <p><strong>Phone Number</strong> <br><?php echo htmlspecialchars($phone_number);?></p>
            </div>
            <?php $total_cart_value = 0;?>
            <form action="cart_to_order.php" method="POST">
            <?php foreach ($cart_items_with_names as $index => $cart):?>
                <div class="right_side"> <!--Right Side-->  
                    <div class="product">
                        <div class="product_details">
                            <img src="../product/<?php echo $cart['product_image']; ?>" alt="Product image" width="160px" height="160px">
                            <input type="hidden" name="order_product_id[]" id="<?php echo htmlspecialchars($cart['product_id']);?>" value="<?php echo htmlspecialchars($cart['product_id']);?>">
                        </div>
                        <div class="order_details">
                                <p class="name"><b><?php echo htmlspecialchars($cart['product_name']);?></b></p>
                                <br>
                                <p>Quantity: <?php echo htmlspecialchars($cart['product_quantity']);?></p>
                                <br>
                                <p>Subtotal: <?php echo htmlspecialchars($cart['cart_total']);?></p>
                        </div>
                    </div>
                </div>
                <?php $total_cart_value += $cart['cart_total'];?>
                <?php endforeach;?>
                <div class="right_side_bottom">
                        <table>
                            <tr>
                                <td><strong>Subtotal</strong></td>
                                <td>RM <?php echo number_format($total_cart_value,2);?></td>
                            </tr>
                            <tr>
                                <td style="border:none;"><strong>Shipping Option:</strong></td>
                                <td><input type="radio" name="delivery_method" required="required" value="Delivery"> Delivery</td>
                            </tr>
    
                            <tr>
                                <td></td>
                                <td><input type="radio" name="delivery_method" required="required" value="Self Pickup"> Self Pickup</td>
                            </tr>
    
    
                            <tr>
                                <td><strong>Payment Method:</strong></td>
                                <td><select name="payment_method" id="payment_method">
                                    <option value="Online banking">Online Banking</option>
                                    <option value="Touch 'n Go ">Touch 'n Go</option>
                                    </select>
                                </td>
                            </tr>
    
                            <tr>
                                <td><strong>Total:</strong></td>
                                <td id="total">RM <?php echo number_format($total_cart_value,2); ?></td>
                            </tr>
                            
                        </table>
                        <br><br>
                        <input type="submit" value="Place Order" class="submit">
                </div>
            </form>
        </div>    
    </div>
    
</body>
</html>

<?php include '../footer.php'?>