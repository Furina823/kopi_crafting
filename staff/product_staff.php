<?php
    session_start();
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
    <title>Product - Kopi Crafting</title>
    <link rel="stylesheet" href="kopi.css">
    <link rel="shortcut icon" type="image/png" href="../image/KopiCraftingLogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .product{
            margin: 0;
            height: 100vh;
            padding: 0;
            box-sizing: border-box;
        }

        .product .product_list{
            padding: 20px;
            box-sizing: border-box;
        }

        .product .product_list .product_header{
            margin-top: 80px;
            position: fixed;
            width: calc(100% - 40px);
            padding-bottom: 5px;
            z-index: 900;
        }

        .product .product_list .product_header tr{
            text-align: left;
        }

        .product .product_list .product_header th{
            font-size: 1.3rem;
            color: var(--header);
        }

        .product .product_list .product_header i{
            font-size: 2rem;
            color: var(--header);
            transition: transform 0.3s ease-in-out;
        }

        .product .product_list .product_header i:hover{
            transform: scale(1.1);
        }


        .product .product_list .product_data{
            margin-top: 150px;
        }

        .product .product_list .product_data .each_product{
            padding-bottom: 15px;
        }

        .product .product_list .product_data .each_product .id_type{
            display: flex;
            font-size: 1.2rem;
            margin-right: auto;
            align-items: center;
        }

        .id_type i, .id_type p{
            padding-left: 10px;
        }

        .each_product .product_details{
            padding: 10px;
        }

        .each_product .product_details td{
            vertical-align: middle;
            text-align: left;
            font-size: 1.4rem;
        }

        .each_product .product_details .action a{
            text-decoration: none;
            color: #fff;
            background-color: var(--header);
            border-radius: 5px;
            padding: 5px;  
        }

        .product .table_design th:nth-child(1), .product .table_design td:nth-child(1){
            width: 2%;
        }
        .product .table_design th:nth-child(2), .product .table_design td:nth-child(2){
            width: 12%;
        }
        .product .table_design th:nth-child(3), .product .table_design td:nth-child(3){
            width: 12%;
        }
        .product .table_design th:nth-child(4), .product .table_design td:nth-child(4){
            width: 15%;
        }
        .product .table_design th:nth-child(5), .product .table_design td:nth-child(5){
            width: 10%;
        }
        .product .table_design th:nth-child(6), .product .table_design td:nth-child(6){
            width: 10%;
        }
        .product .table_design th:nth-child(7), .product .table_design td:nth-child(7){
            width: 10%;
        }
        .product .table_design th:nth-child(8), .product .table_design td:nth-child(8){
            width: 1%;
        }

        
    </style>
    <script type='text/javascript'>
        function checkAlert(id){
            message = confirm('Are you sure you want to delete this product?')
            if(message){
                window.location.href= `delete_product.php?del=${id}`;
            }
        }
    </script>
</head>
<body>
    <section class="product">
        <div class="product_list">
            <div class="product_header">
                <div class="spacer">&nbsp;</div>
                <table class="table_design">
                    <tr>
                        <th></th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th>
                        <th><a href="add_product.php"><i class="fa-solid fa-circle-plus"></i></a></th>
                    </tr>
                </table>
                <div class="spacer">&nbsp;</div>
            </div>
            <div class="product_data">
                <?php 
                    $display_product = mysqli_query($dbConn,"SELECT * FROM `products`");
                    while($row = mysqli_fetch_assoc($display_product)){
                        ?>
                    
                        <div class="each_product">
                            <div class="table_design">
                                <div class="id_type">
                                    <i class="fa-solid fa-box"></i>
                                    <p>Product ID: <?php echo $row['product_id'];?></p>
                                    <p>Type: <?php echo $row['product_type'];?></p>
                                </div>
                                <div class="product_details">
                                    <table class="table_design">
                                        <tr>
                                            <td></td>
                                            <td>
                                                <img src="../product/<?php echo $row['product_image']?>" alt="Product Image" width="90px">
                                            </td>
                                            <td><?php echo $row['product_name'];?></td>
                                            <td><?php echo $row['product_description'];?></td>
                                            <td style="padding-left:20px"><?php echo $row['product_quantity'];?></td>
                                            <td>RM <?php echo number_format($row['product_price'],2);?></td>
                                            <td>
                                                <div class="action">
                                                    <a href="edit_product.php?id=<?php echo $row['product_id']?>">Edit Product</a> <br><br>
                                                    <a href="javascript:void()" onClick='checkAlert(<?php echo $row['product_id']?>)' style="background-color: red;">Delete Product</a>
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                <?php } ?>
            </div>
              
        </div>
        <?php include "../footer.php"?> 
    </section>
</body>
</html>