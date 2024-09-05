<?php 
session_start ();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}
include '../connection.php';


if (isset($_SESSION['email'])) {
    // Access session variable
    $email = $_SESSION['email'];

    $sql ="SELECT * FROM customers WHERE cus_email = ?";
    $stmt = $dbConn ->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt-> get_result();

    if($result-> num_rows > 0){
        $row = $result->fetch_assoc();
        $name=$row['cus_name'];
        $phone=$row['cus_phone_number'];
        $address=$row['cus_address'];
    }

} else {
    // Handle case where session variable 'id' is not set
    echo "Session variable 'id' is not set.";
}

if(!$dbConn) {
    echo 'Connection error:' . mysqli_connect_error();
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../staff/kopi.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="shortcut icon" type="image/png" href="../image/KopiCraftingLogo.png">
    <title>Profile - Kopi Crafting</title>
    <style>
        .profile{
            background-color: #f5f5f5;
            margin: 0;
            height: 100%;
            padding: 0;
            box-sizing: border-box;
        }

        .profile .profile_head{
            padding: 10px 40px 20px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .profile .profile_head .title{
            display: flex;
            align-items: center;
        }

        .profile .profile_head .title i{
            font-size: 2rem;
            color: #7e6956;
        }

        .profile .profile_head .name_title{
            font-size: 1.6rem;
        }


        .profile .profile_details td a{
            text-decoration: none;
            font-size: 1.5rem;
            color: #f8e2c7;
            background-color: var(--black); 
            cursor: pointer;
            text-align: center;
            padding: .9rem 2rem;
            border-radius: .5rem;
        }

        .profile .profile_details{
            padding-left: 30px;
            padding-right: 30px;
            padding-bottom: 15px;
        }

        .profile .profile_details .table_design{
            padding: 15px;
            border-radius: 20px;
        }

        .profile .profile_details .personal_info{
            padding: 15px;
            border: var(--border);
            border-radius: 10px;
        }

        .profile .profile_details h5{
            font-size: 1.6rem;
            padding-bottom: 15px;
            color: var(--header);
        }

        .profile .profile_details .details{
            font-size: 1.3rem;
            text-align: left;
        }

        .profile .profile_details .details td{
            text-transform: none;
            text-align: center;
        }
        
        .profile .profile_details .details th{
            text-align: center;
            padding: 10px;
        }

        .profile .profile_details .details th i{
            color: #b3aca1;
            font-size: 1.5rem;
        }

        .profile .table_design th:nth-child(1), .profile .table_design td:nth-child(1){
            width: 20%;
        }

        .profile .table_design th:nth-child(2), .profile .table_design td:nth-child(2){
            width: 20%;
        }

    </style>
</head>
<body>
    <div class="profile">
        <div class="profile_head"> 
            <div class="name_title">
                <p>Username: <?php echo $name;?></p>
                <p>Title: Customer</p>
            </div>
            <div class="title">
                <i class="fa-solid fa-user"></i>
            </div> 
        </div>
        <div class="profile_details">
            <div class="table_design">
                <div class="personal_info">
                    <h5>Personal Details</h5>
                    <table class="details">
                        <tr>
                            <th><i class="fa-solid fa-envelope"></i></th>
                            <th><i class="fa-solid fa-phone"></i></th>
                        </tr>
                        <tr>
                            <td><?php echo $email;?></td>
                            <td><?php echo $phone;?></td>
                        </tr>
                        <tr>
                            <th><i class="fa-solid fa-house"></i></th>
                        </tr>
                        <tr>
                            <td><?php echo $address;?></td>
                        </tr>
                    </table>
                </div>
            </div>     
        </div>
        <div class="profile_details">
            <div class="table_design">
                <div class="personal_info" style="border:none;">
                    <table class="details">
                        <tr>
                            <td><a href="purchase.php">My Purchase</a></td>
                            <td><a href="../logout.php">Log Out</a></td>
                        </tr>
                    </table>
                </div>
            </div>     
        </div>
    </div>
</body>
</html>