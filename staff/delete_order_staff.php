<?php
session_start ();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}
include '../connection.php';

    if(isset($_GET['del'])){
        //Get order_id
        $order_id = intval($_GET['del']);
        $sql = "DELETE FROM orders WHERE order_id = $order_id";
        $result = mysqli_query($dbConn, $sql);
        
        if($result) {
            echo "<script>
                    alert('Delete successful');
                    window.location.href='order_staff.php';
                </script>";
        } else{
            echo "<script>
                    alert('Delete unsuccessful');
                    window.location.href='order_staff.php';
                </script>";
        }
    }

?>