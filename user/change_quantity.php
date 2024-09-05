<?php
session_start ();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}
include '../connection.php';


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

if (!$dbConn) {
    die("Connection Error: " . mysqli_connect_error());
}

if (isset($_POST['product_id']) && isset($_POST['new_quantity'])) {
    $productId = $_POST['product_id'];
    $newQuantity = $_POST['new_quantity'];

    // Update product_quantity
    $updateSql = "UPDATE carts SET product_quantity = ? WHERE product_id = ? AND cus_id = ?";
    $updateStmt = $dbConn->prepare($updateSql);
    $updateStmt->bind_param("iii", $newQuantity, $productId, $id);
    $updateStmt->execute();

    // Update cart_total by multiplying product_quantity with product_subtotal
    $updateTotalSql = "UPDATE carts SET cart_total = product_quantity * product_subtotal WHERE product_id = ? and cus_id = ?";
    $updateTotalStmt = $dbConn->prepare($updateTotalSql);
    $updateTotalStmt->bind_param("ii", $productId, $id);
    $updateTotalStmt->execute();

    echo "Quantity updated successfully.";
} else {
    echo "Error: Missing parameters.";
}

mysqli_close($dbConn);