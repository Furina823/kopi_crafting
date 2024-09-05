<?php 
session_start ();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}


include 'header_staff.php'; 
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Kopi Crafting</title>
    <link rel="shortcut icon" type="image/png" href="../image/KopiCraftingLogo.png">
    <style>
        .text{
            line-height: 2.0;
            padding-left: 80px;
            padding-right: 80px;
            text-align: justify;
        }
        
        .head{
            padding-top: 120px;
        }

        .head img, .section img{
            width: 100%;
            right: 0;
            bottom: 0;
            filter: contrast(50%) brightness(100%) saturate(100%);
        }


        .head h1{
            text-align: center;
            font-size: 5rem;
            text-transform: uppercase;
            color: #281b12;
            padding-bottom: 1rem;
        }

        .head h1 span{
            text-transform: uppercase;
            color: #7e6956;
        }

       

        
    </style>
</head>
<body>
  

    <!-- About Us Page -->
            
            <section class="home">
                <div class="head">
                    <h1><span>ABOUT</span> US</h1>
                    <img src="../image/aboutus1.jpg" alt="">

                </div>  
            </section>
            
            <div class="text" >
                <br> <br>
                <h1>Our History</h1>
                <b><p style="font-size: 15px; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">Kopi Crafting, which has its roots in our mutual love of coffee, is more than just an online community; it's a digital oasis carefully designed to meet the demands of both coffee lovers and entrepreneurs. This aims to carve a digital footprint that mirrors the essence of its physical coffee sanctuary. The web development project is poised to narrate the intricate story of coffee, tracing its cultural evolution and highlighting the craftsmanship embedded in each brew. Through intuitive design and immersive content, the website aspires to transport visitors into a realm where the aroma of freshly ground beans mingles with the echoes of coffee's storied past. Seamlessly blending educational elements with the allure of specialty offerings, the platform beckons aficionados to explore the origins of diverse coffee beans, discover brewing techniques, and indulge in a curated selection of artisanal beverages.
                <br><br>
                    With an eye towards enhancing user engagement, the project incorporates interactive features and multimedia elements, inviting patrons to embark on a sensory voyage. Through responsive design and streamlined navigation, the website endeavors to captivate visitors from all walks of life, inviting them to linger and delve deeper into the world of Kopi Crafting History. Whether perusing the virtual shelves for coffee beans or immersing oneself in the captivating tales of coffee's journey, the website endeavors to serve as a digital haven where passion, history, and flavor converge in a celebration of coffee culture.</p></b>
                    <br> <br>
            </div>
        </div>

        <!-- Section 2: Text on the left, Image on the right -->
        <div class="section">    
            <div class="image">
                <img style="position:inherit; width:100%; height:450px;" src="../image/aboutus2.jpg" alt="Image">
            </div><br>
            <div class="text">
                <b><p style="font-size: 15px; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">These coffee beans import from Indonesia, Combodia. At Kopi Crafting History, we take immense pride in sourcing our coffee beans from the lush landscapes of Indonesia and the rich soils of Cambodia. Our commitment to quality begins at the origin, where we carefully select beans cultivated by local farmers who share our passion for excellence. In Indonesia, renowned for its Sumatran and Javanese coffee varieties, we traverse verdant plantations to handpick beans imbued with distinct flavors and aromas. From the earthy notes of Aceh Gayo to the velvety richness of Java Arabica, each bean tells a story of heritage and tradition.
                <br><br>
                    Meanwhile, our journey through Cambodia's coffee-growing regions unveils a tapestry of flavors that captivate the senses. Amidst the rolling hills and tropical climates, we forge partnerships with growers dedicated to sustainable practices and community empowerment. From the floral nuances of Mondulkiri to the bold profiles of Ratanakiri, our Cambodian beans embody the country's emerging coffee renaissance. Through our commitment to fair trade and direct relationships, we not only ensure the highest quality standards but also contribute to the livelihoods of farmers and the preservation of indigenous coffee cultures. At Kopi Crafting History, our passion for coffee extends beyond the cup – it's a journey of discovery, connection, and appreciation for the remarkable beans that unite us across continents.</p></b>
            </div>

        </div>
</body>
</html>


<?php include ('../footer.php'); ?>