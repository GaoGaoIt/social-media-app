<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iK+eaW/m6O2/jxADL4M6Bqj9nv0DzPk5d+2uUZ5PqFfEAsv5C84N2Ubx" crossorigin="anonymous">
  <title>EventsWave Email</title>
  <style type="text/css">
    body {
      background-color: #6c757d;
      color: #ffffff;
      height: 100vh;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .container {
      padding: 0rem;
    }

    .card-container {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .card {
      flex: 1;
      background-color: #343a40;
      border: none;
      margin: 0 10px 20px;
      text-decoration: none;
      color: #ffffff;
    }

    .card .images {
      width: 100%;
      height: 200px;
      /* Set a fixed height for the card images */
      object-fit: cover;
      /* Ensure images maintain aspect ratio and cover the container */
    }

    .card-body {
      padding: 20px;
    }

    .btn-primary,
    .btn-secondary {
      display: block;
      width: 100%;
      margin-top: 10px;
    }

    .btn-primary img,
    .btn-secondary img {
      margin-right: 10px;
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    .btn-secondary {
      background-color: #6c757d;
      border: none;
    }

    .btn-secondary:hover {
      background-color: #545b62;
    }

    .beautiful-text {
      font-size: 24px;
      font-weight: bold;
      text-align: center;
      color: #ffffff;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="card mb-3">
      <div class="d-flex justify-content-center align-items-center">
        <img src="./assets/images/login_request/logo.png" class="">
      </div>
    </div>
    <div class="card-container">
      <a href="https://synergycollege.edu.my" class="card">
        <img src="./assets/images/login_request/logo.png" class="card-img-top images" alt="Sunset Over the Sea" />
        <div class="card-body">
          <p class="beautiful-text">Join Our College. We are...</p>
        </div>
      </a>
      <a href="login.php" class="card">
        <img src="./assets/images/login_request/231-2310013_mott-community-college-student-life-logo-college-students.png" class="card-img-top images" alt="Sunset Over the Sea" />
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </a>
    </div>
  </div>

  <!-- Bootstrap JS and Popper.js (for Bootstrap features) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ea8HMl1hS3iD/ZD4ZtP1Vsd5l9TTmIs9gZTD2Rmg/6q2ZGoU/KdLxoZNQrXb5gbU" crossorigin="anonymous"></script>
</body>

</html>