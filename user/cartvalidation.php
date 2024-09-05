<?php
session_start ();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

include '../connection.php';

if (!$dbConn) {
    echo 'Connection Failed:' . mysqli_connect_error();
    exit(); // Exit the script if connection fails
}

// Validate and sanitize session ID
if (!isset($_SESSION['email'])) {
    echo "Session email is not set.";
    exit();
}

if (!isset($_POST['product_id'])) {
    header("Location: shop.php");
    exit();
}

//Retrive the customer id from validate it from customer email
$sql = "SELECT cus_id FROM customers WHERE cus_email = ? ";
$stmt = mysqli_prepare($dbConn, $sql);
mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $id);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if (! $id) {
    echo "Customer ID not found";
    exit();
}


$tableName = "carts";
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];
$cart_total = $_POST['total_paid'];
$product_price = $_POST['product_price'];


    // Check if the product already exists in the cart
    $sql_select = "SELECT product_id FROM carts WHERE product_id = ? and cus_id = ?";
    $stmt_select = $dbConn->prepare($sql_select);
    $stmt_select->bind_param("ii", $product_id, $id);
    $stmt_select->execute();
    $result_select = $stmt_select->get_result();

    if ($result_select->num_rows > 0) {
        // Product already exists in the cart, update the quantity and total
        $row = $result_select->fetch_assoc();
        $cartID = $row["cart_id"];
        $update = "UPDATE carts SET product_quantity = product_quantity + ?, 
                    cart_total = cart_total + ?
                    WHERE product_id = ? AND cus_id = ?";
        $stmt_update = $dbConn->prepare($update);
        $stmt_update->bind_param("idii", $quantity, $cart_total, $product_id, $id);
        if ($stmt_update->execute()) {
            echo '<script>
            alert("You had update your cart sucessfully!");
            window.close();
            </script>';
        } else {
            echo "Error updating record: " . $stmt_update->error;
        }
        // Close the update statement
        $stmt_update->close();
    } else {
        // Product does not exist in the cart, insert a new record
        $sql_insert = "INSERT INTO carts (product_id, cus_id, product_quantity, product_subtotal, cart_total) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = $dbConn->prepare($sql_insert);
        $stmt_insert->bind_param("iiidd", $product_id, $id, $quantity, $product_price, $cart_total);
        if ($stmt_insert->execute()) {
            echo '<script>
            alert("You had add item to your cart sucessfully!");
            window.close();
            </script>';
        } else {
            echo "Error inserting record: " . $stmt_insert->error;
        }
        // Close the insert statement
        $stmt_insert->close();
    }

    // Close the select statement
    $stmt_select->close();


// Close connection
$dbConn->close();