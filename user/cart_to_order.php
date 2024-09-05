<?php 
session_start ();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

$email = $_SESSION['email'];

include '../connection.php'; 
if (!$dbConn) {
    echo "Connection Error: " . mysqli_connect_error();
}

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



$array = $_POST['order_product_id'];
$delivery_types = $_POST['delivery_method'];
$payment_method = $_POST['payment_method'];
$payment_status = "Paid";
$order_status = "Packing";

foreach ($array as $orderProductID) {
    $sql = "SELECT * FROM carts WHERE product_id = ? AND cus_id = ?";
    $stmt_sql = $dbConn->prepare($sql);
    $stmt_sql->bind_param("ii", $orderProductID, $id);
    $stmt_sql->execute();
                     
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $order_date = date("Y-m-d");

    $result_cart = $stmt_sql->get_result();

    if ($row = $result_cart->fetch_assoc()) {
        $productQuantity = $row['product_quantity'];
        $productCartTotal = $row['cart_total'];
        $productSubtotal = $row['product_subtotal'];

        $insert = "INSERT INTO orders (cus_id, product_id, product_quantity, product_subtotal, order_total, delivery_types, payment_method, payment_status, order_status, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $dbConn->prepare($insert);
        $stmt_insert->bind_param("iiiddsssss", $id, $orderProductID, $productQuantity, $productSubtotal, $productCartTotal, $delivery_types, $payment_method, $payment_status, $order_status, $order_date);
        $stmt_insert->execute() ;
    }
}

echo '<script> alert("You have made the order successfully!"); 
window.location.href = "shop.php"</script>';
$stmt_insert->close();
exit();
