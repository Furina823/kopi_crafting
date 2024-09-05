<?php
session_start ();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}
    include '../connection.php';
    include 'popup.php';

    //edit function
    if(isset($_POST['edit_product']))
    { 
        $edit_id = $_GET["id"];
        $edit_product_name=$_POST['edit_product_name'];
        $edit_product_type=$_POST['edit_product_type'];
        $edit_product_description=$_POST['edit_product_description'];
        $edit_product_price=$_POST['edit_product_price'];
        $edit_product_quantity=$_POST['edit_product_quantity'];

        //edit query
        // Prepare the SQL statement
        $stmt = mysqli_prepare($dbConn, "UPDATE `products` 
        SET product_name = ?, 
            product_type = ?,
            product_description = ?,
            product_price = ?, 
            product_quantity = ?
        WHERE product_id = ?");

        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "sssssi", $edit_product_name, $edit_product_type, $edit_product_description, $edit_product_price, $edit_product_quantity, $edit_id);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        if($result) {
        $display_message = "Product edited successfully.";
        function_alert($display_message);
        header('location:product_staff.php');
        } else {
        $display_message = "There was an error editing the product.";
        function_alert($display_message);
        header('location:product_staff.php');
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    }
    include 'header_staff.php';
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product - Kopi Crafting</title>
    <link rel="shortcut icon" type="image/png" href="../image/KopicraftingLogo.png">
    <link rel="stylesheet" href="kopi.css">
    <link rel="stylesheet" href="../user/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body{
            background-color: #f5f5f5;
        }

        .each_product{
            padding-top: 120px;
        }

        h1{
            text-align: center;
            font-weight: bold;
            position: relative;
            font-size: 4rem;
            text-transform: uppercase;
            padding: .5rem 0 1rem;
            color: var(--color1);
        
        }

        h1 span{
            text-transform: uppercase;
            color: #7e6956;
        }


        .each_product_container{
            margin: auto;
            width: 80%;
            margin-bottom: 40px;
            border-radius: 2rem;
            padding: 70px 0;
            background: url(../image/product_frame.png);
            background-size: cover;
            background-color: white;
            background-position: center;
            box-shadow: 2px 5px 14px #888888;
        }

        .product{
            display: flex;
            flex-direction: row;
            box-sizing: border-box;
            align-items: center;
        }

        .image{
            padding: 70px 10px 70px 200px;
            flex: 1;
        }


        .image img{
            width: 100px;
            height: auto;
        }

        .right_side{
            padding: 70px 200px 70px 10px;
            flex: 1;
        }

        h3{
            font-size: 1.5rem;
            text-align: left;
            color: var(--header);
        }

        input, textarea{
            font-size: 1.3rem;
            text-align: left;
            border: none;
            color: #281b12;
            padding: 10px;
            background-color: #f5f5f5;
            text-transform: none;
            border-radius: 1rem;
            resize: none;
        }


        .cart_btn{
            text-decoration: none;
            font-size: 1.5rem;
            color: #f8e2c7;
            background-color: var(--black); 
            cursor: pointer;
            text-align: center;
            padding: .9rem 2rem;
            border-radius: .5rem;
            transition: transform 0.3s ease-in-out;
        }

        .cart_btn:hover{
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="each_product">
        <h1><span>Product</span> Update</h1>
        <div class="each_product_container">
        <?php 
            if(isset($_GET["id"]))
            {
                $edit_id = $_GET["id"];
                $edit_query = mysqli_query($dbConn,"SELECT * FROM `products` WHERE product_id=$edit_id");
                if (mysqli_num_rows($edit_query)>0)
                {
                    $fetch_data = mysqli_fetch_assoc($edit_query);
                    
                    ?>
                    <!--edit form-->    
            <form action="" method="post" enctype = "multipart/form-data">
                <div class="product">
                    <div class="image">
                        <h3>Product ID: <?php echo $fetch_data['product_id']?></h3>
                        <img src="../product/<?php echo $fetch_data['product_image']?>" alt="Product Image"><br><br>
                        <h3>Product Name:</h3>
                        <input type = "text" name = "edit_product_name" required value="<?php echo $fetch_data['product_name']?>"><br><br>
                        <h3>Product Type:</h3>
                        <input type = "text" name = "edit_product_type" required value="<?php echo $fetch_data['product_type']; ?>">
                    </div>
                    <div class="right_side">
                        <div class="product_information">
                            <h3>Product Description:</h3>
                            <textarea name="edit_product_description" cols="30" rows="5"><?php echo $fetch_data['product_description']; ?></textarea><br><br>
                            <h3>Product Quantity:</h3>
                            <input type = "number" min = "0" name = "edit_product_quantity" required value="<?php echo $fetch_data['product_quantity']?>"><br><br>
                            <h3>Product Price(RM):</h3>
                            <input type = "float" min = "0" step="0.01" name = "edit_product_price" required value="<?php echo $fetch_data['product_price']?>"><br><br>
                            <input type="submit" name="edit_product" value="Save" class="cart_btn">&nbsp;&nbsp;
                            <a href="product_staff.php">
                                <button type="button" class="cart_btn" style="background-color: red;">Cancel</button>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
            <?php 
                }   
            }
                    ?>
        </div>
    </div>
    <?php include "../footer.php"?> 
</body>   
</html>