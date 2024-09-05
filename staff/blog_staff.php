<?php
session_start ();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}
    include '../connection.php';

    include 'header_staff.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Kopi Crafting</title>
    <link rel="stylesheet" href="kopi.css">
    <link rel="shortcut icon" type="image/png" href="../image/KopiCraftingLogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .blog{
            margin: 0;
            height: 100vh;
            padding: 0;
            box-sizing: border-box;
        }

        .blog .blog_list{
            padding: 20px;
            box-sizing: border-box;
        }

        .blog .blog_list .blog_header{
            margin-top: 80px;
            position: fixed;
            width: calc(100% - 40px);
            padding-bottom: 5px;
            z-index: 900;
        }

        .blog .blog_list .blog_header tr{
            text-align: left;
        }

        .blog .blog_list .blog_header th{
            font-size: 1.3rem;
            color: var(--header);
            padding-left: 10px;
        }

        .blog .blog_list .blog_header i{
            font-size: 2rem;
            color: var(--header);
            transition: transform 0.3s ease-in-out;
        }


        .blog .blog_list .blog_header i:hover{
            transform: scale(1.1);
        }
        .blog .blog_list .blog_data{
            margin-top: 150px;
        }

        .blog .blog_list .blog_data .each_blog{
            padding-bottom: 15px;
        }

        .blog .blog_list .blog_data .each_blog .id{
            display: flex;
            font-size: 1.2rem;
            margin-right: auto;
            align-items: center;
        }

        .id i, .id p{
            padding-left: 10px;
        }

        .each_blog .blog_details td{
            vertical-align: middle;
            text-align: left;
            font-size: 1.4rem;
            padding-left: 10px;
        }

        .each_blog .blog_details .action a{
            text-decoration: none;
            color: #fff;
            background-color: var(--header);
            border-radius: 5px;
            padding: 5px;
        }

        .blog .table_design th:nth-child(1), .blog .table_design td:nth-child(1){
            width: 2%;
        }
        .blog .table_design th:nth-child(2), .blog .table_design td:nth-child(2){
            width: 10%;
        }
        .blog .table_design th:nth-child(3), .blog .table_design td:nth-child(3){
            width: 10%;
        }
        .blog .table_design th:nth-child(4), .blog .table_design td:nth-child(4){
            width: 30%;
        }
        .blog .table_design th:nth-child(5), .blog .table_design td:nth-child(5){
            width: 10%;
        }
        .blog .table_design th:nth-child(6), .blog .table_design td:nth-child(6){
            width: 3%;
        }
    </style>
    <script>
        function checkAlert(id){
            message = confirm('Are you sure you want to delete this blog?')
            if(message){
                window.location.href= `delete_blog.php?del=${id}`;
            }
        }
    </script>
</head>
<body>
    <section class="blog">
        <div class="blog_list">
            <div class="blog_header">
                <div class="spacer">&nbsp;</div>
                <table class="table_design">
                    <tr>
                        <th></th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                        <th><a href="add_blog.php"><i class="fa-solid fa-circle-plus"></i></a></th>
                    </tr>
                </table>
                <div class="spacer">&nbsp;</div>
            </div>
            <div class="blog_data">
            <?php 
                $display_blog = mysqli_query($dbConn,"SELECT * FROM blogs");
                while($row = mysqli_fetch_assoc($display_blog)){
                    ?>
                <div class="each_blog">
                    <div class="table_design">
                        <div class="id">
                            <i class="fa-solid fa-comments"></i>
                            <p>Blog ID: <?php echo $row['blog_id']?></p>
                        </div>
                        <div class="blog_details">
                            <table class="table_design">
                                <tr>
                                    <td></td>
                                    <td>
                                        <img src="../blog/<?php echo $row['blog_image']?>" alt="Blog image" width="90px">
                                    </td>
                                    <td><?php echo $row['blog_title']?></td>
                                    <td><?php echo $row['blog_description']?></td>
                                    <td>
                                        <div class="action">
                                            <a href="edit_blog.php?id=<?php echo $row['blog_id']?>">Edit Blog</a> <br><br>
                                            <a href="javascript:void()" onClick='checkAlert(<?php echo $row['blog_id']?>)' style="background-color: red;">Delete Blog</a>
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
        <?php include "../footer.php"?> 
    </section>
</body>
</html>