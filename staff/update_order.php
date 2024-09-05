<?php
session_start ();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}
include '../connection.php';

    $order_id = $_GET['id'];
    $sql = "SELECT order_status FROM orders WHERE order_id = $order_id";
    $result = mysqli_query($dbConn, $sql);
    if($rows = mysqli_fetch_array($result)){
        $status = $rows['order_status'];
    }
    
    if($status == 'Packing'){
        $new_sql = "UPDATE orders 
                SET order_status = 'Shipping' 
                WHERE order_id = $order_id ";
    } elseif($status == 'Shipping'){
        $new_sql = "UPDATE orders 
                    SET order_status = 'Delivered' 
                    WHERE order_id = $order_id ";
    }

    $new_result = mysqli_query($dbConn, $new_sql);
    if($new_result) {
        echo "<script>
                alert('Update successful');
                window.location.href='order.php';
            </script>";
    } else{
        echo "<script>
                alert('Update unsuccessful');
                window.location.href='order.php';
            </script>";
    }



?>