<?php 
session_start ();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}
include "../connection.php";
if (isset($_GET['del']))
{
    $delete_id = $_GET['del'];
    $delete_query = mysqli_query($dbConn, "DELETE from blogs WHERE blog_id=$delete_id")
    or die("Query Failed");
    if($delete_query)
    {
        //echo "Blog deleted";
        header('location:blog_staff.php');
        exit();
    }
    else
    {
        //echo "Deletion failed";
        header('location:blog_staff.php');
        exit();
    }
}
?>