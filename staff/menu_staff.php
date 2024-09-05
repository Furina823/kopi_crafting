<?php 
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

include '../connection.php';

include 'header_staff.php';
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="kopi.css">
    <link rel="stylesheet" href="../user/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Home - Kopi Crafting</title>
    <link rel="shortcut icon" type="image/png" href="../image/KopiCraftingLogo.png">
    <style>
        body{
            background-color: #f5f5f5;
        }
        .home{
            min-height: 100vh;
            align-items: center;
        }
        section{
            padding-top: 2rem;
            margin: 0;
        }

        .head{
            display: flex;
            flex-wrap: wrap;
        }

        .background-clip{
            flex: 1 1 90%;
            width: 100%;
            right: 0;
            bottom: 0;
        }

        .head_content{
            padding: 2rem;
            position: absolute;
            margin-right: 15rem;
            z-index: 1;
        }

        .head_content h2{
            font-size: 9rem;
            padding-top: 150px;
            text-transform: uppercase;
            color: white;
        }

        .head_content h2 span{
            text-transform: uppercase;
            color: #f8e2c7;
        }

        .head_content h3{
            font-size: 6rem;
            text-transform: uppercase;
            color: white;
        }

        .head_content p{
            font-size: 2rem;
            line-height: 1.8;
            padding: 1rem 0;
            color: white;
        }

        h1{
            text-align: center;
            font-weight: bold;
            position: relative;
            font-size: 5rem;
            text-transform: uppercase;
            padding: 1.5rem 0 2rem;
            color: var(--color1);
        
        }

        h1 span{
            text-transform: uppercase;
            color: #7e6956;
        }

        .product_container{
            display: grid;
            grid-template-columns: repeat(auto-fit, 30rem);
            gap: 2rem;
            justify-content: center;
        }

        .product_container .content{
            text-align: center;
            padding: 2rem;
            border: var(--border);
            border-radius: 0.5rem;
            background-color: var(--white);
            box-shadow: 2px 5px 14px #888888;
        }

        .product_container .content img{
            width: 100%;
            margin: 0 auto;
        }

        .content h3{
            margin: 1rem 0;
            font-size: 1.5rem;
            color: var(--black);
            text-transform: uppercase;
        }

        .content .price{
            font-size: 1.7rem;
            color: var(--color1);
            margin: 1rem 0;
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

        .ads_one{
            padding-top: 10rem;
            padding-left: 1.5rem;
            width: 100%;
            position: inherit;
            right: 0;
            bottom: 0;
        }

        .ads_one th{
            width: 40%;
        }

        .ads_one img{
            position: cover;
            width: 100%;
        }

        .ads_one h1{
            text-align: left;
            position: inherit;
            font-size: 4.3rem;
            margin-left: 5rem;
            padding-bottom: 3rem;
            padding-right: 10px;
            text-transform: uppercase;
            justify-content: center;
            color: var(--color1);
        }

        .ads_one p{
            text-align: justify;
            position: inherit;
            font-size: 2rem;
            margin-left: 5rem;
            padding-top: 3rem;
            text-transform: none;
            line-height: 1.8;
        }
        
        .review_container{
            width: 100%;
            height: 30rem;
            margin: auto;
            padding-top: 2rem;
            padding-left: 5px;
            display: grid;
            grid-auto-flow: column;
            grid-auto-columns: 26%;
            gap: 2rem;
            overflow-x: scroll;
            overscroll-behavior-inline: contain;
            white-space: nowrap;
        }

        .review_container::-webkit-scrollbar{
            display: none;
        }

        .review_container .content{
            height: 15rem;
            padding: 2rem;
            border: var(--border);
            border-radius: .5rem;
            background-color: var(--white);
            box-shadow: 2px 5px 14px #888888;
        }

        .review_container .content i{
            padding: 1rem;
            padding-right: 1rem;
        }

        .review_container .content td{
            align-items: center;
            justify-content: center;
            padding-left: 2rem;
        }

        .review_container .content h3{
            font-size: 1.5rem;
            text-align: justify;
            justify-content: center;
        }

        .review_container .content p{
            padding-left: 1rem;
            font-size: 2rem;
        }

        .content th i{
            font-size: 4rem;
        }

        .content .star_rating{
            display: inline-block;
            width: auto;
        }

        .content .star_rating .list_line{
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .content .star_rating .list_line .list_inline_item{
            color: var(--color1);
            display: inline-block;
            justify-content: center;
            padding-top: 1rem;
            font-size: 1.5rem;
            align-items: center;
        }

        .fa-star{
            padding: 1rem;
            color: gold;
        }

        .average_rating{
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!--Menu (Home Page)-->
    <section class="home">
        <div class="head">
             <!--Ads 1-->
            <video autoplay loop muted playsinline class="background-clip">
                <source src="../image/ads1.mp4" type="video/mp4">
            </video>
            <div class="head_content">
                <h2><span>Kopi</span> Crafting</h2>
                <h3>What makes our coffee special?</h3>
                <p>Discover the artistry behind our special coffee - meticulously sourced beans, expert roasting, and a commitment to exceptional flavor profiles.</p>
                <p>Sip perfection with every cup, crafted for coffee enthusiasts.</p>
            </div> 
        </div>  
    </section>
    <section class="product">
        <h1><span>Top 3</span> Best Selling Product</h1>
        <div class="product_container">
            <?php
                include '../connection.php';

                $select_products=mysqli_query($dbConn, "SELECT * FROM products WHERE product_id <= 3");
                if(mysqli_num_rows($select_products)>0){
                    while($fetch_product=mysqli_fetch_array($select_products)){
                        ?> 
                        <div class="content">
                            <img src="../product/<?php echo $fetch_product['product_image']?>" alt="Coffee Product" class="coffee_img">
                            <h3><?php echo $fetch_product['product_name'] ?></h3>
                            <div class="price">RM <?php echo number_format($fetch_product['product_price'], 2)  ?></div>
                        </div>
                    <?php
                    }
                }
                else{
                    echo 'No product';
                }

            ?>
        </div>
    </section>           
    <section>
        <div class="ads_one">
            <table>
                <tr>
                    <th><img src="../image/ads1.jpg" alt="" style="padding-left: 2rem;"></th>
                    <td style="padding-right: 3rem;">
                        <h1>Classic no 9. Specialty Coffee Bean</h1>
                        <p>Kopi Crafting Coffee Bean - Classic NO.9 Specialty Coffee Bean designated by the Specialty 
                            Coffee Association of America are the highest quality green coffee beans and rated as 
                            91-Points Specialty Coffee Bean by Coffee Review.</p>
                    </td>
                </tr>
            </table>
        </div>
    </section>
    <!--Review-->
    <section>
        <h1><span>Customer's</span> Reviews</h1>
        <?php
            $select_rating=mysqli_query($dbConn, "SELECT AVG(review_rating) AS avg_rating FROM reviews");
            if(mysqli_num_rows($select_rating)>0){
                $fetch_rating=mysqli_fetch_array($select_rating);
                $avg_rating = $fetch_rating['avg_rating'];
        ?>
        <form method="post" action="">
            <div class="average_rating">
                <span class="avg_rating"><?php echo number_format($avg_rating, 1);?></span>
                <?php 
                    for ($i = 1; $i <= 5; $i++){
                        if($avg_rating >= $i){
                            echo '<span class="fa fa-star"></span>';
                        }else{
                            echo '<span class="fa-regular fa-star"></span>';
                        }
                    }
                ?>
            </div>
        </form>
        <?php
        }
        ?>

        <div class="review_container">
        <?php
            $select_review=mysqli_query($dbConn, "SELECT * FROM reviews");
            if(mysqli_num_rows($select_review)>0){
                while ($fetch_review=mysqli_fetch_array($select_review)){
        ?>

            <form method="post" action="">
                <div class="content">
                    <table>
                        <th><i class="fa-solid fa-user"></i></th>
                        <td>
                            <h3><?php echo $fetch_review['review_description'] ?></h3>
                            <div class="star_rating">
                                <ul class="list_line">
                                    <?php $start=1;
                                    while ($start <= 5)
                                    {
                                        if($fetch_review['review_rating'] < $start)
                                        {
                                            ?>
                                            <li class="list_inline_item"><i class="fa-regular fa-star"></i></li>
                                            <?php
                                        }else{
                                            ?>
                                            <li class="list_inline_item"><i class="fa fa-star"></i></li>
                                            <?php
                                        }

                                        $start++;
                                    }
                                    ?>
                                </ul>
                            </div>
                        </td>
                    </table>
                </div>
                
            </form>
            <?php
                }
            }
            else{
                echo "No review. Leave a review";
            }
            ?>
        </div>
    </section>
</body>
</html>


<!--Footer-->
<?php include('../footer.php')?>