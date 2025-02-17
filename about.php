<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>About Us</title>
    <link rel="website icon" type="webp" href="assets/img/csi.webp">

    <!-- MDB Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            background-color: #1e1e1e;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        .container-custom {
            width: 90%;
            max-width: 750px;
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 25px;
            border-radius: 12px;
            backdrop-filter: blur(12px);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
            margin-top: 20px;
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



        /* Mobile Adjustments */
        @media (max-width: 768px) {
            .nav-links {
                top: 10px;
                right: 10px;
                flex-direction: column;
                align-items: flex-end;
            }

            .container-custom {
                width: 95%;
                padding: 20px;
                margin-top: 10px;
            }

            .btn-custom {
                font-size: 14px;
                padding: 8px 15px;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation Links -->
    <div class="nav-links">
        <a href="login.php"><i class="fa-solid fa-sign-in-alt"></i> Login</a>
        <a href="contact.php"><i class="fa-solid fa-envelope"></i> Contact Us</a>
    </div>
    <!-- About Section -->
    <div>
        <div class="d-flex align-items-center justify-content-center vh-150">
            <div class="container-custom">
                <h2 class="fw-bold">About Us</h2>

                <p>
                    Welcome to the <strong>Learning Management System (LMS)</strong> of Computer Systems Institute.
                    Our platform enhances learning and streamlines academic processes, offering an engaging way for
                    students and educators to connect.
                </p>

                <p>
                    The LMS serves as a centralized hub where <strong>teachers</strong> can upload learning modules,
                    create interactive quizzes, and set up exams with automated scoring, ensuring hassle-free grading
                    and instant feedback.
                </p>

                <p>
                    <strong>Students</strong> can access materials, submit assignments, take quizzes, and complete exams
                    directly in the system, benefiting from real-time assessment.
                </p>

                <p>
                    With <strong>automated scoring</strong>, the system instantly evaluates quiz and exam responses,
                    reducing the workload for educators and providing students with immediate results.
                </p>

                <p>
                    Whether you're an instructor managing course materials or a student tracking academic progress, our LMS
                    supports your educational journey with efficiency and ease.
                </p>

                <a href="login.php" class="btn btn-custom mt-3"><i class="fa-solid fa-arrow-left"></i> Back to Login</a>
            </div>
        </div>
    </div>
</body>

</html>