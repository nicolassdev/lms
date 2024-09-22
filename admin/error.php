<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Error </title>
  <link rel="icon" type="png" href="../assets/img/csi.png">
  <link
    href="../assets/css/bootstrap.min.css"
    rel="stylesheet" />
  <style>
    body,
    html {
      height: 100%;
    }

    .error-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      text-align: center;
    }

    .error-title {
      font-size: 202px;
      font-weight: bold;
      color: #1a75ff;
    }

    .error-message {
      font-size: 24px;
      margin-top: 20px;
      color: #666;
    }

    .btn-home {
      margin-top: 30px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row error-container">
      <div class="col-md-6">
        <h1 class="error-title">404</h1>
        <p class="error-message">
          Oops! The page you're looking for doesn't exist.
        </p>
        <a href="index.php" class="btn btn-primary btn-home">Back to Home</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>