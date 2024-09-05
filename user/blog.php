<?php
session_start ();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}


require "../connection.php";
require "header.php";
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../staff/kopi.css">
    <title>Blog - Kopi Crafting</title>
    <link rel="shortcut icon" type="image/png" href="../image/KopiCraftingLogo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5; /* Background color */
            color: #281b12; /* Text color */
        }

        .blog .blog_header{
            
        }

        .blog .blog_header h1{
            top: 110px;
            text-align: center;
            font-weight: bold;
            position:relative;
            font-size: 5rem;
            text-transform: uppercase;
            padding: 1.5rem 0 2rem;
            color: var(--color1);
        }

        .blog h1 span{
            text-transform: uppercase;
            color: #7e6956;
        }

        .blog .container {
            max-width: 1000px;
            margin: 0 auto; 
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* Three-column grid layout */
            grid-gap: 20px; /* Gap between grid items */
        }
        

        .post {
            margin-top: 130px;
            background-color: #f8e2c7; /* Post background color */
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .post .title {
            font-size: 24px;
            font-weight: bold;
            color: #281b12; /* Post title color */
            margin-bottom: 10px;
        }

        .post .content {
            color: #281b12; /* Post content color */
            line-height: 1.6;
            margin-bottom: 10px;
            font-size: 15px;
        }

        
    </style>
</head>
<body>
    <section class="blog">
        <div class="blog_header">
            <h1><span>Kopi Crafting</span> Blog</h1>
        </div>
        <div class="container">
            <?php
                    // SQL query to select blog posts
                    $sql = "SELECT * FROM blogs";
                    $result = $dbConn->query($sql);
            
                    // Check if there are any results
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            // Output HTML content dynamically using PHP
                            echo '<div class="post">';
                            echo '<div class="image"><center><img src="../blog/'.$row['blog_image'].'" style="width:250px; padding: 1.5rem;"></center></div>'; 
                            echo '<div class="title">' . $row["blog_title"] . '</div>';
                            echo '<div class="content">' . $row["blog_description"] . '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "No blog posts found.";
                    }
            
                    // Close the database connection
                    $dbConn->close();
                    ?>

            
        </div>
        
    </section>
    
</body>
</html>

<?php require '../footer.php'; ?>