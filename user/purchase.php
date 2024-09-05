<?php
session_start ();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}
include '../connection.php';

// Retrive the id
if (isset($_SESSION['email'])) {
    // Access session variable
    $email = $_SESSION['email'];

    $sql ="SELECT cus_id FROM customers WHERE cus_email = ?";
    $stmt = $dbConn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $id = $row['cus_id'];
    }

} else {
    // Handle case where session variable 'id' is not set
    echo "Session variable 'id' is not set.";
    exit; // Exit script if session variable is not set
}

// Retrieve orders for the logged-in customer along with product details
$sql = "SELECT orders.*, products.product_name, products.product_image, products.product_description
        FROM orders
        INNER JOIN products ON orders.product_id = products.product_id
        WHERE orders.cus_id = ?";
$stmt = $dbConn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

include 'header.php';

?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Purchase - Kopi Crafting</title>
    <link rel="shortcut icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="../staff/kopi.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .order{
            padding: 0;
            min-height: 100vh;
        }
        .order .table_header_background, .order .table_data_background{
            padding: 20px;
        }

        .order .table_header_background{
            padding-bottom: 0;
        }

        .order .table_data_background{
            padding-top:0;
        }

        .right_footer{
            margin-top: 150px;
        }
        
    </style>
</head>
<body>
    <!--Order List (Admin View)-->
    <div class="order_list">
        <div class="filter">
            <br><br>
            <h1 style='padding-left: 15px;'>MY PURCHASE</h1>
            <br><br>
            <a href="purchase.php?order_status=all"><strong>All</strong></a>
            <a href="purchase.php?order_status=to_ship"><strong>TO SHIP</strong></a>    
            <a href="purchase.php?order_status=shipping"><strong>SHIPPING</strong></a>
            <a href="purchase.php?order_status=delivered"><strong>DELIVERED</strong></a>
            <a href="purchase.php?order_status=reviewed"><strong>REVIEWED</strong></a>
        </div>  
        <div class="order">
            <div class="table_header_background">
                <div class="table_header" style="width:81.4%;">
                    <div class="spacer">&nbsp;</div>
                    <table class="table_design">
                        <tr>
                            <th width></th>
                            <th width>Product</th>
                            <th width>Total Amount</th>
                            <th width>Delivery</th>
                            <th width>Status</th>
                            <th width>Action</th>
                        </tr>
                    </table>
                    <div class="spacer">&nbsp;</div>
                </div>
            </div>
            <div class="table_data_background">
                <?php
                    //Check status for filtering, by default: all
                    $statusFilter = isset($_GET['order_status']) ? $_GET['order_status'] : 'all';
                    //Filter SQL query
                    if($statusFilter == 'all'){
                        $sql = "SELECT orders.*, products.product_name, products.product_description, products.product_image
                                FROM orders
                                INNER JOIN products ON orders.product_id = products.product_id
                                WHERE orders.cus_id = ?
                                ORDER BY orders.order_id DESC";
                    }
                    elseif($statusFilter == 'to_ship'){
                        $sql = "SELECT orders.*, products.product_name, products.product_description, products.product_image
                                FROM orders
                                INNER JOIN products ON orders.product_id = products.product_id
                                WHERE orders.cus_id = ? AND orders.order_status = 'Packing'
                                ORDER BY orders.order_id DESC";
                    }
                    elseif($statusFilter == 'shipping'){
                        $sql = "SELECT orders.*, products.product_name, products.product_description, products.product_image
                                FROM orders
                                INNER JOIN products ON orders.product_id = products.product_id
                                WHERE orders.cus_id = ? AND orders.order_status = 'Shipping'
                                ORDER BY orders.order_id DESC";
                    }
                    elseif($statusFilter == 'delivered'){
                        $sql = "SELECT orders.*, products.product_name, products.product_description, products.product_image
                                FROM orders
                                INNER JOIN products ON orders.product_id = products.product_id
                                WHERE orders.cus_id = ? AND orders.order_status = 'Delivered'
                                ORDER BY orders.order_id DESC";
                    }elseif($statusFilter == 'reviewed'){
                        $sql = "SELECT orders.*, products.product_name, products.product_description, products.product_image
                                FROM orders
                                INNER JOIN products ON orders.product_id = products.product_id
                                WHERE orders.cus_id = ? AND orders.order_status = 'Reviewed'
                                ORDER BY orders.order_id DESC";
                    }

                    $stmt = $dbConn->prepare($sql);
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    

                    while($rows = mysqli_fetch_array($result)){
                        $date = $rows['order_date'];
                        $newDate = date('d-M-Y', strtotime($date));
                        echo '<div class="each_order">';
                        echo '<div class="table_data">';
                        echo '<div class="table_design">';
                        //Customer Details
                        echo '<div class="customer_order">';
                        echo '<div class="customer_details">';
                        echo '<i class="fas fa-user" id="profile"></i>';
                        echo "<p> Customer No: ".$rows['cus_id']."</p>";
                        echo "<p> Order Quantity: ".$rows['product_quantity']."</p>";
                        echo '</div>';
                        //Order Details
                        echo '<div class="order_details">';
                        echo "<p> Order Number: ".$rows['order_id']."</p>";
                        echo '<p>Created Date: '.$newDate.'</p>'; //Database did not add date
                        echo '</div>';
                        echo '</div>';
                        //Product Details
                        echo '<div class="product_details">';
                        echo '<table class="table_design">';
                        echo '<tr>';
                        echo '<td></td>';
                        echo '<td>';
                        echo '<img src="../product/'. $rows['product_image'].'" alt="" width="90px">'; //Product Image
                        echo '<br>';
                        echo "<strong>".$rows['product_name']."</strong>";
                        echo '<br>';
                        echo "<p style='font-size:1rem; padding:10px;'>".$rows['product_description']."</p>";
                        echo '</td>';
                        echo '<td>';
                        echo "RM ".number_format($rows['product_subtotal'],2)."<br>"; //data might not be correct (dummy data)
                        echo "x".$rows['product_quantity']."<br>";
                        echo '<br>';
                        echo "<strong>Total:</strong>RM ".number_format($rows['order_total'],2);
                        echo "<p style='color:#7e6956'>".$rows['payment_method']."</p>";
                        echo '</td>';
                        echo "<td>".$rows['delivery_types']."</td>";
                        echo '<td>';
                        echo "<strong>".$rows['order_status']."</strong>";
                        echo '</td>';
                        echo '<td>';
                        echo '<div class="action" data-order-id="'.$rows['order_id'].'">';
                        //Action links based on order status
                        if($rows['order_status'] === 'Delivered'){
                            echo '<a href="user_review.php?id='.$rows['order_id'].'">To Review</a> <br> <br>';
                        }
                        
                        echo '</div>';
                        echo '</td>';
                        echo '</tr>';
                        echo '</table>';
                        echo '</div> ';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        
                    }
                ?>
                
            </div>
            <div class="right_footer">
                <?php include '../footer.php'?>
            </div>
        </div>
    </div>
    
</body>

