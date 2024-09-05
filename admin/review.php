<?php
session_start ();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}
include '../connection.php';
include 'header_staff.php';
?>


<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review</title>
    <link rel="shortcut icon" type="image/png" href="../image/KopiCraftingLogo.png">
    <link rel="stylesheet" href="../staff/kopi.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script type='text/javascript'>
        function checkAlert(id){
            message = confirm('Are you sure you want to delete this review?')
            if(message){
                window.location.href= `delete_review.php?del=${id}`;
            }
        }
    </script>
</head>
<body>
    <!--Review List (Admin View)-->
    <section class="review">
        <div class="review_list">
            <div class="review_header">
                <div class="spacer">&nbsp;</div>
                <table class="table_design">
                    <tr>
                        <th></th>
                        <th>Product</th>
                        <th>Review Rating</th>
                        <th>Review Description</th>
                        <th>Action</th>
                    </tr>
                </table>
                <div class="spacer">&nbsp;</div>
            </div>
            <div class="review_data">
            <?php
                    $sql = 'SELECT reviews.*, products.product_name, orders.order_id, orders.cus_id, orders.product_quantity, orders.order_date, products.product_image
                            FROM reviews
                            INNER JOIN orders ON reviews.order_id = orders.order_id
                            INNER JOIN products ON orders.product_id = products.product_id
                            ORDER BY reviews.order_id DESC';

                    $result = mysqli_query($dbConn, $sql);

                    while($rows = mysqli_fetch_array($result)){
                        $date = $rows['order_date'];
                        $newDate = date('d-M-Y', strtotime($date));
                        echo '<div class="each_review">';
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
                        echo "<p> Order ID: ".$rows['order_id']."</p>";
                        echo '<p>Created Date: '.$newDate.'</p>'; //Database did not add date
                        echo '</div>';
                        echo '</div>';
                        
                        //Review Details
                        echo '<div class="review_details">';
                        echo '<table class="table_design">';
                        echo '<tr>';
                        echo '<td></td>';
                        echo '<td>';
                        echo '<img src="../product/'. $rows['product_image'].'" alt="" width="90px">'; //Product Image
                        echo '<br>';
                        echo "<strong>".$rows['product_name']."</strong>";
                        echo '</td>';
                        echo '<td>';
                        echo '<div class="star-outer">'; //Star Rating (drawn with icons)
                        echo '<div class="star-inner" style="width: '.($rows['review_rating'] * 20).'%;"></div>';
                        echo '</div> <br>';
                        echo "<strong>Stars: </strong><span class='star-value'>".$rows['review_rating']."</span>";
                        echo '</td>';
                        echo '<td>';
                        echo $rows['review_description'];
                        echo '</td>';
                        echo '<td>';
                        echo '<div class="action">';
                        echo "<a href='javascript:void()' onClick='checkAlert(".$rows['order_id'].")' style='background-color: red;'>Delete Review</a>";
                        echo '</div>';
                        echo '</td>';
                        echo '</tr>';
                        echo '</table>';
                        echo '</div>';

                        echo '</div>';
                        echo '</div>';
                    }

                ?> 
                  
            </div>
        </div>
        <?php 
            include '../footer.php';
        ?>
    </section>
    
</body>
</html>

