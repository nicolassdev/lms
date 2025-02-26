<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Contact</title>
    <link rel="website icon" type="webp" href="assets/img/csi.webp">

    <!-- MDB Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap");

        body {
            background-color: #1e1e1e;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            text-align: center;
        }

        .container-custom {
            width: 90%;
            max-width: 600px;
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 12px;
            backdrop-filter: blur(12px);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .container-custom:hover {
            transform: translateY(-3px);
        }

        .btn-custom {
            background-color: #17a2b8;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            font-weight: bold;
            letter-spacing: 0.5px;
            font-size: 16px;
        }

        .btn-custom:hover {
            background-color: #138496;
            transform: scale(1.05);
        }

        .nav-links {
            position: fixed;
            top: 15px;
            right: 20px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .nav-links a {
            color: white;
            font-weight: bold;
            text-decoration: none;
            margin-left: 5px;
            font-size: 14px;
            transition: color 0.3s, transform 0.3s;
        }

        .nav-links a:hover {
            color: #17a2b8;
            transform: scale(1.1);
        }

        .contact-info {
            font-size: 16px;
            line-height: 1.8;
        }

        .contact-info i {
            color: #17a2b8;
            margin-right: 8px;
        }
    </style>
</head>

<body>

    <!-- Navigation Links -->
    <div class="nav-links">
        <a href="login.php"><i class="fa-solid fa-sign-in-alt"></i> Login</a>
        <a href="about.php"><i class="fa fa-info-circle"></i> About</a>
    </div>

    <!-- Contact Section -->
    <div class="d-flex align-items-center justify-content-center" style="margin-top: 150px;">
        <div class="container-custom">
            <h2 class="fw-bold mb-4">Contact Us</h2>

            <p class="contact-info">
                <i class="fa-solid fa-envelope"></i> <strong>Email:</strong> csilegazpi@gmail.com
            </p>

            <p class="contact-info">
                <i class="fa-solid fa-phone"></i> <strong>Tel:</strong> (052) 481-1534
            </p>

            <p class="contact-info">
                <i class="fa-solid fa-mobile-alt"></i> <strong>Mobile:</strong> +63 928-028-0579
            </p>

            <hr style="border-color: rgba(255, 255, 255, 0.2);">

            <p>Copyright © 2024 : Learning Management System</p>

            <!-- <a href="login.php" class="btn btn-custom mt-3"><i class="fa-solid fa-arrow-left"></i> Back to Login</a> -->
        </div>
    </div>
</body>

</html>