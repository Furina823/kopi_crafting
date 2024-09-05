<?php
session_start ();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}
    include '../connection.php';
    include '../staff/popup.php';
    include 'header_admin.php';

    if(isset($_POST['add_product'])) {
        $product_image = $_FILES['product_image']['name'];
        $product_image_temp_name = $_FILES['product_image']['tmp_name'];
        $product_image_folder = "../product/".$product_image;
        $product_name = $_POST['product_name'];
        $product_type = $_POST['product_type'];
        $product_description = $_POST['product_description'];
        $product_quantity = $_POST['product_quantity'];
        $product_price = $_POST['product_price'];

        // Prepare the INSERT statement
        $stmt = $dbConn->prepare("INSERT INTO `products` (product_name, product_type, product_image, product_description, product_quantity, product_price) VALUES (?, ?, ?, ?, ?, ?)");

        // Bind parameters
        $stmt->bind_param("ssssdd", $product_name, $product_type, $product_image, $product_description, $product_quantity, $product_price);

        // Execute the statement
        if($stmt->execute()) {
            move_uploaded_file($product_image_temp_name, $product_image_folder);
            $display_message = "Product added successfully";
            function_alert($display_message);
            header('location:product_admin.php');
        } else {
            $display_message = "There was an error adding the product";
            function_alert($display_message);
            header('location:product_admin.php');
        }

        // Close statement
        $stmt->close();
    }
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product - Kopi Crafting</title>
    <link rel="shortcut icon" type="image/png" href="../image/KopicraftingLogo.png">
    <link rel="stylesheet" href="../staff/kopi.css">
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
        <h1><span>New</span> Product</h1>
        <div class="each_product_container">
            <form action="" method="post" enctype = "multipart/form-data">
                <div class="product">
                    <div class="image">
                        <h3>Product Image:</h3>
                        <input type = "file" name = "product_image" accept = "image/png, image/jpg, image/jpeg" style="padding: 60px 0 60px 10px;" required><br><br>
                        <h3>Product Name:</h3>
                        <input type = "text" name = "product_name" placeholder = "Enter Product Name" required><br><br>
                        <h3>Product Type:</h3>
                        <input type = "text" name = "product_type" placeholder = "Enter Product Type" required>
                    </div>
                    <div class="right_side">
                        <div class="product_information">
                            <h3>Product Description:</h3>
                            <textarea name="product_description" placeholder="Enter Product Description" cols="30" rows="5"></textarea><br><br>
                            <h3>Product Quantity:</h3>
                            <input type = "number" min = "0" name = "product_quantity" placeholder = "Enter Quantity" required><br><br>
                            <h3>Product Price(RM):</h3>
                            <input type = "float" min = "0" step="0.01" name = "product_price" placeholder = "Enter Price" required><br><br>
                            <input type="submit" name="add_product" value="Add Product" class="cart_btn">&nbsp;&nbsp;
                            <a href="product_admin.php">
                                <button type="button" class="cart_btn" style="background-color: red;">Cancel</button>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>   
</html>

<?php include "../footer.php"?> 