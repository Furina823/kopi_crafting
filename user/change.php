<?php
session_start ();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}
// Establishing database connection
include_once '../connection.php';


// Check if 'id' session variable is set
if (isset($_SESSION['email'])) {
    // Access session variable
    $email = $_SESSION['email'];

    $sql ="SELECT cus_id FROM customers WHERE cus_email = ?";
    $stmt = $dbConn ->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt-> get_result();

    if($result-> num_rows > 0){
        $row = $result->fetch_assoc();
        $id=$row['cus_id'];
    }

} else {
    // Handle case where session variable 'id' is not set
    echo "Session variable 'id' is not set.";
}


// Checking connection
if (!$dbConn) {
    die("Connection Error: " . mysqli_connect_error());
}

// Function to remove product from cart
if(isset($_POST['remove_product_id'])) {
    $removeProductId = $_POST['remove_product_id'];
    $removeSql = "DELETE FROM carts WHERE product_id = ?";
    $removeStmt = $dbConn->prepare($removeSql);
    $removeStmt->bind_param("i", $removeProductId);
    $removeStmt->execute();
    exit; // Terminate after removal
}

$tableName = "carts";

// Query to select all products from the cart
$sql = "SELECT * FROM $tableName where cus_id = $id";
$result = mysqli_query($dbConn, $sql);

// Checking if there are any products in the cart
if (mysqli_num_rows($result) > 0) {
    // Fetching all products from the cart
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    // Closing the previous result set
    mysqli_free_result($result);
    
    // Variable to store total subtotal
    $totalSubtotal = 0;
    
    // Array to store product names
    $productNames = array();
    
    // Looping through each product in the cart
    foreach ($products as $product) {
        $product_id = $product['product_id'];
        
        // Query to fetch product name based on product_id
        $select = 'SELECT product_name, product_image FROM products WHERE product_id = ?';
        $stmt = $dbConn->prepare($select);
        
        // Binding parameters and executing query
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        
        // Getting result
        $result_product = $stmt->get_result();
        
        // Fetching product name
        if ($row = $result_product->fetch_assoc()) {
            // Append product name to the array
            $productNames[] = $row["product_name"];
            $productImages[] = $row["product_image"];
        } else {
            echo "Product not found.<br>";
        }
        
        // Freeing result set
        $result_product->free();
    }
} else {
    // Cart is empty, redirect to emptycart.php
    header("Location: emptycart.php");
    exit();
}

// Closing database connection
mysqli_close($dbConn);
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
    ::-webkit-scrollbar{
        margin-right: 2px;
        width: 1rem;
    }

    ::-webkit-scrollbar-track{
        background: transparent;
    }

    ::-webkit-scrollbar-thumb{
        background: lightgrey;
        border-radius: 5rem;
    }
    .container_temporary_cart {
        width: 100%;
        margin: auto;
        box-sizing: border-box;
        background-color: #f5f5f5;
        overflow-y: auto;
        height: 85%;
    }

    .container_cart {
        float: right;
        width: 100%;
        background-color: #f5f5f5;
    }

    .container_cart h2 {
        font-size: 2rem;
        padding: 10px;
        padding-left: 30px;
        color: #7e6956;
    }

    .cart_item{
        padding: 5px;
    }

    .table_design{ 
        background-color: white;
        padding: 7px;
        width: 100%;
        border-radius: 10px;
    }

    .cart_container{
        padding-bottom: 7px;
    }

    .cart_container td{
        padding: 7px;
        vertical-align: middle;
        text-align: left;
        font-size: 1.2rem;
    }

    .cart_container input[type="number"]{
        text-align: center;
        font-size: 1.2rem;
        border: none;
        color: #281b12;
        width: 70px;
    }

    .cart_container span{
        color: #7e6956;
    }

    .cart_container button{
        text-decoration: none;
        font-size: 1rem;
        color: white;
        background-color: red; 
        cursor: pointer;
        text-align: center;
        padding: .9rem 2rem;
        border-radius: .5rem;
        transition: transform 0.3s ease-in-out;
    }

    .cart_container button:hover{
        transform: scale(1.1);
    }
    

    .container_subtotal {
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #7e6956;
        padding: 10px;
    }

    .container_subtotal .subtotal h3{
        font-size: 1.5rem;
        display: inline-block;
        padding-bottom: 5px;  
    }


    .container_subtotal input{
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

    .cart_item:last-child{
        margin-bottom: 210px;
    }

    
</style>
</head>
<body>
        <div class="container_cart" id="container_cart">
            <div class="cart"></div><!--Risde Side Box-->
            <form action="checkout.php" method="get">
                
                <div class="container_subtotal"> <!-- Container below cart/Subtotal Container -->
                    <h2>Cart</h2>
                    <div class="subtotal">
                        <h3>Subtotal: </h3>
                        <h3>RM<span id="total" >0.00</span></h3>
                        <div class="checkout">
                        <input type="submit" value="Checkout">
                        </div>
                    </div>
                    
                </div>
                <?php foreach($products as $index => $product): ?>
                <div class="cart_item">
                    <div class="cart_container">
                        <table class="table_design">
                            <tr>
                                <td width="10%">
                                    <input type="checkbox" name="cart_product_id[]" value="<?php echo $product['product_id']; ?>" id="checkbox_<?php echo $product['product_id']; ?>" class="button" onclick="calculateTotalSubtotal(<?php echo $product['cart_total']; ?>, this.checked)">
                                </td>
                                <td width="25%">
                                    <img src="../product/<?php echo htmlspecialchars($productImages[$index]); ?>" alt="Product Image" width="100px">
                                    <br><br>
                                    <h3><?php echo htmlspecialchars($productNames[$index]); ?></h3>
                                </td>
                                <td width="30%">
                                    Quantity: <br><input type="number" min="1" max="99" onchange="updateQuantity('<?php echo $product['product_id']; ?>', this.value)" value="<?php echo htmlspecialchars($product['product_quantity']); ?>">
                                    <br><br><br>
                                    <p><span><strong>Subtotal:</strong></span><br> RM <?php echo htmlspecialchars(number_format($product['cart_total'], 2)); ?></p>
                                </td>
                                <td width="10%"><button type="button" onclick="removeProduct('<?php echo $product['product_id']; ?>')">Remove</button></td>
                            </tr>  
                        </table>
                    </div>
                </div>      
                <?php endforeach; ?>
                
                
            </form>
            </div>
        </div>
    <script src="script.js"></script>
</body>
</html>