<?php 
session_start ();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}
include "../connection.php";
if (isset($_GET['del']))
{
    $delete_id = intval($_GET['del']);
    $delete_query = mysqli_query($dbConn, "DELETE from `products` WHERE product_id=$delete_id")
    or die("Query Failed");
    if($delete_query)
    {
        echo "<script>
                alert('Delete successful');
                window.location.href='product_admin.php';
            </script>";
    }
    else
    {
        echo "<script>
                    alert('Delete unsuccessful');
                    window.location.href='product_admin.php';
                </script>";
    }
}
?>