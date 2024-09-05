<?php
include '../connection.php';


session_start();
// Validate and sanitize session ID
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

include 'header.php';
$order_id = $_GET['id']


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../staff/kopi.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" type="image/png" href="../image/KopiCraftingLogo.png">
    <title>Review - Kopi Crafting</title>
    <style>
        .review_wrap {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80%;
            padding-top: 100px;
        }

        .wrapper {
            background-color: white;
            padding: 2rem;
            max-width: 576px;
            width: 100%;
            border-radius: .75rem;
            box-shadow: 2px 5px 14px #888888;
            text-align: center;
            align-items: center;
        }

        .wrapper h2 {
            font-size: 2rem;
            margin-bottom: 1.2rem;
        }

        
        .rate {
            height: 46px;
            width: 100%;
            padding: 0 150px;
        }

        .rate:not(:checked) > input {
            position: absolute;
            top: -9999px;
        }
        .rate:not(:checked) > label {
            float:right;
            width:1.5em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
        }

        .rate:not(:checked) > label:before {
            content: ' ★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc700;    
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;  
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }
        .review_wrap .wrapper textarea {
            width: 100%;
            background-color: #f5f5f5;
            padding: 1rem;
            border-radius: .5rem;
            border: none;
            outline: none;
            resize: none;
            margin-bottom: 2rem;
            text-transform: none;
        }

        .btn-group button {
            text-decoration: none;
            font-size: 1.4rem;
            color: #f8e2c7;
            background-color: var(--black); 
            cursor: pointer;
            text-align: center;
            padding: .9rem 2rem;
            border-radius: .5rem;
            transition: transform 0.3s ease-in-out;
        }

        .btn-group button:hover {
            transform: scale(1.1);
        }

        .btn-group .btn.submit {
            color: #f8e2c7;
            background-color: var(--black); 
        }

        .btn-group .btn.cancel {
            color: var(--black);
            background-color: #f8e2c7;
        }
    </style>
    <script src="script.js" defer></script>
</head>
<body>
    <div class="review_wrap">
        <div class="wrapper">
            <h2>Review</h2>
            <form action="review_to_database.php" method="POST" onsubmit="return validateForm()">
            <div class="rate">
                <input type="radio" id="star5" name="rate" value="5"/>
                <label for="star5" title="text"></label>
                <input type="radio" id="star4" name="rate" value="4"/>
                <label for="star4" title="text"></label>
                <input type="radio" id="star3" name="rate" value="3"/>
                <label for="star3" title="text"></label>
                <input type="radio" id="star2" name="rate" value="2"/>
                <label for="star2" title="text"></label>
                <input type="radio" id="star1" name="rate" value="1"/>
                <label for="star1" title="text"></label>
                <input type="hidden" name="order_id" value="<?php echo $order_id?>">
            </div>
                <textarea name="opinion" cols="30" rows="5" placeholder="Your Review..."></textarea>
                <div class="btn-group">
                    <button type="submit" class="btn submit">Submit</button> &nbsp; &nbsp;
                    <a href="purchase.php?order_status=delivered">
                        <button type="button" class="btn cancel">Cancel</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php include '../footer.php'; ?>