<?php
session_start();
include '../connection.php';
include 'header_staff.php';
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order - Kopi Crafting</title>
    <link rel="shortcut icon" type="image/png" href="../image/KopicraftingLogo.png">
    <link rel="stylesheet" href="kopi.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script type='text/javascript'>
        function checkAlert(id){
            message = confirm('Are you sure you want to delete this order?');
            if(message){
                window.location.href= `delete_order.php?del=${id}`;
            }
        }

        function checkStatus(id){
            message = confirm('Are you sure you want to update above order status?');
            if(message){
                window.location.href= `update_order.php?id=${id}`;
            }
        }
 
    </script>
    <style>
        .order .table_header_background, .order .table_data_background{
            padding-left: 20px;
            padding-right: 20px;
        }

        .order .table_header_background{
            padding-top: 20px;
            margin-right: 0;
        }

        .right_footer{
            margin-top: 250px;
        }
    </style>
</head>
<body>
    <!--Order List (Admin View)-->
    <div class="order_list">
        <div class="filter">
            <br><br>
            <h1 style='padding-left: 15px;'>ORDERS</h1>
            <br><br>
            <a href="order.php?order_status=all">All</a>
            <a href="order.php?order_status=to_ship">TO SHIP</a>    
            <a href="order.php?order_status=shipping">SHIPPING</a>
            <a href="order.php?order_status=delivered">DELIVERED</a>
            <a href="order.php?order_status=reviewed">REVIEWED</a>
        </div>  
        <div class="order">
            <div class="table_header_background">
                <div class="table_header" style="width:81.4%;">
                    <div class="spacer">&nbsp;</div>
                    <table class="table_design" style="width:">
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
                                ORDER BY orders.order_id DESC";
                    }
                    elseif($statusFilter == 'to_ship'){
                        $sql = "SELECT orders.*, products.product_name, products.product_description, products.product_image
                                FROM orders
                                INNER JOIN products ON orders.product_id = products.product_id
                                WHERE order_status = 'Packing'
                                ORDER BY orders.order_id DESC";
                    }
                    elseif($statusFilter == 'shipping'){
                        $sql = "SELECT orders.*, products.product_name, products.product_description, products.product_image
                                FROM orders
                                INNER JOIN products ON orders.product_id = products.product_id
                                WHERE order_status = 'Shipping'
                                ORDER BY orders.order_id DESC";
                    }
                    elseif($statusFilter == 'delivered'){
                        $sql = "SELECT orders.*, products.product_name, products.product_description, products.product_image
                                FROM orders
                                INNER JOIN products ON orders.product_id = products.product_id
                                WHERE order_status = 'Delivered'
                                ORDER BY orders.order_id DESC";
                    }
                    elseif($statusFilter == 'reviewed'){
                        $sql = "SELECT orders.*, products.product_name, products.product_description, products.product_image
                                FROM orders
                                INNER JOIN products ON orders.product_id = products.product_id
                                WHERE order_status = 'Reviewed'
                                ORDER BY orders.order_id DESC";
                    }

                    $result = mysqli_query($dbConn, $sql);

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
                        echo "<p style='font-size:1rem;'>".$rows['product_description']."</p>";
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
                        if($rows['order_status'] === 'Packing'){
                            echo '<a href="javascript:void()" onClick="checkStatus('.$rows['order_id'].')">Ready To Ship</a> <br> <br>';
                        }
                        elseif($rows['order_status'] === 'Shipping'){
                            echo '<a href="javascript:void()" onClick="checkStatus('.$rows['order_id'].')">Delivered</a> <br> <br>';
                        }
                        if($rows['order_status'] !== 'Delivered' && $rows['order_status'] !== 'Reviewed'){
                            echo '<a href="javascript:void()" onClick="checkAlert('.$rows['order_id'].')" style="background-color: red;">Cancel Shipment</a>';
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
</html>

