<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
        :root {
        --color1: #281b12;
        --color2: #f8e2c7;
        --color3: #9c8b79;
        --color4: #7e6956;
        --color5: #afa097;
        --color6: #89745a;
        --color7: #faf1e5;
        --color8: #74746c;
        --color9: #b3aca1;
        --black: #000;
        --white: #fff;
    }
    .footer {
        box-sizing: border-box;
        width: 100%;
        text-align: left;
        margin-top: 80px;
        padding-left :50px; 
        padding-top: 20px; 
        padding-bottom:10px;
        padding-right: 40px;
        background-color: var(--color7);
    }
    .footer, .footer .footer_left, .footer .footer_center, .footer .footer_right{
        display: inline-block;
        vertical-align: top;
    }
    .footer .footer_left{
        width: 20%;
    }
    .footer .footer_left .name h2{
        text-transform: uppercase;
        font-size: 20px;
    }
    .footer .footer_left p{
        padding-top: 5px;
        font-size: 15px;
    }
    .footer .footer_left .contact i{
        color: var(--color1);
        font-size: 1.3rem;
        text-transform: none;
        padding-top: 1px;
    }
    .footer .footer_center{
        width: 33%;
        margin-left: 7rem;

    }
    .footer .footer_center i{
        color: var(--color1);
        display: inline-block;
        padding-top: 2rem;
        padding-left: 4.5rem;
        transition: 0.5s;
    }
    .footer .footer_center i{
        transform: translateY(10px);
    }
    .footer .footer_right{
        width: 34%;
    }
    .footer .footer_right .footer_logo{
        height: 9.5rem;
        float: right;
    }

    .footer .copyright{
        float:right ;
    }

</style>

<footer class="footer">

        <div class="footer_left">

            <div class="name">
                <h2>Kopi Crafting</h2>
            </div>
        
            <p>Kopi Crafting, Jalan Teknologi 5,<br>
                Taman Teknologi Malaysia,<br>
                57000 Kuala Lumpur,<br>
                Wilayah Persekutuan Kuala Lumpur. <br>
            </p>
            <div class="contact">
            <p><a href="tel:+6016-23678790"><i>+60 16-23678790</i></a></p>
            <p><a href="mailto:kopicrafting@gmail.com"><i>kopicrafting@gmail.com</i></a></p>
            </div>
        </div>

        <div class="footer_center">
            <a href="http://www.facebook.com"><i class="fa fa-facebook-square fa-3x" aria-hidden="true"></i></a>
            <a href="http://www.instagram.com"><i class="fa fa-instagram fa-3x" aria-hidden="true"></i></a>
            <a href="http://www.twitter.com"><i class="fa fa-twitter-square fa-3x" aria-hidden="true"></i></a>        
        </div>

        <div class="footer_right">
            <img src="../image/KopiCraftingLogo.png" alt="" class="footer_logo">
    
        </div>
        <i class="copyright"> &copy; Copyright Kopi Crafting Sdn. Bhd 2024</i>
</footer>