<?php
session_start ();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}
    include "../connection.php";
    include "popup.php";
    if(isset($_POST['edit_blog']))
    { 
        $edit_id = $_GET["id"];
        $edit_blog_title=$_POST['edit_blog_title'];
        $edit_blog_description=$_POST['edit_blog_description'];

        // Prepare the update statement
        $stmt = $dbConn->prepare("UPDATE `blogs` SET blog_title=?, blog_description=? WHERE blog_id=?");
        
        // Bind parameters
        $stmt->bind_param("ssi", $edit_blog_title, $edit_blog_description, $edit_id);
        
        // Execute the statement
        if($stmt->execute()) {
            $display_message = "Blog edited successfully.";
            function_alert($display_message);
            header('location:blog_staff.php');
        } else {
            $display_message = "There was an error editing the blog.";
            function_alert($display_message);
            header('location:blog_staff.php');
        }

        // Close statement
        $stmt->close();
    }

    include 'header_staff.php';
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Kopi Crafting</title>
    <link rel="stylesheet" href="kopi.css">
    <link rel="stylesheet" href="../user/style.css">
    <link rel="shortcut icon" type="image/png" href="../image/KopiCraftingLogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body{
            background-color: #f5f5f5;
        }

        .each_blog{
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

        .each_blog_container{
            margin: auto;
            width: 90%;
            margin-bottom: 40px;
            border-radius: 2rem;
            padding: 70px 0;
            background: url(../image/product_frame.png);
            background-size: cover;
            background-color: white;
            background-position: center;
            box-shadow: 2px 5px 14px #888888;
        }

        .blog{
            display: flex;
            flex-direction: row;
            box-sizing: border-box;
            align-items: center;
        }

        .image{
            padding: 70px 10px 70px 250px;
            flex: 1;
        }

        .image img{
            width: 100px;
            height: auto;
        }

        .right_side{
            padding: 70px 250px 70px 10px;
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
    <div class="each_blog">
        <h1><span>Blog</span> Update</h1>
        <div class="each_blog_container">
        <?php 
            if(isset($_GET["id"]))
            {
                $edit_id = $_GET["id"];
                $edit_query = mysqli_query($dbConn,"SELECT * FROM blogs WHERE blog_id=$edit_id");
                if (mysqli_num_rows($edit_query)>0)
                {
                    $fetch_data = mysqli_fetch_assoc($edit_query);
                    
                    ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="blog">
                    <div class="image">
                        <h3>Blog ID: </h3>
                        <img src="../blog/<?php echo $fetch_data['blog_image']?>" alt="Blog Image"><br><br>
                        <h3>Blog Title:</h3>
                        <input type="text" name="edit_blog_title" style="width: 300px;" required value="<?php echo $fetch_data['blog_title']?>"><br><br>
                    </div>
                    <div class="right_side">
                        <div class="blog_information">
                            <h3>Blog Description</h3>
                            <textarea name="edit_blog_description" cols="40" rows="20"><?php echo $fetch_data['blog_description']; ?></textarea><br><br>
                            <input type="submit" name="edit_blog" value="Save" class="cart_btn">&nbsp;&nbsp;
                            <a href="blog_staff.php">
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
</body>
</html>