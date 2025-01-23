<?php
//include('header.php');
include('db.php');
?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Neighborhood Security</title>
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

    <style>
        .custom-bg {
            background-color: rgb(233, 229, 229);
            /* Change to your preferred color */
        }
    </style>

</head>
<div class="custom-bg">
    <div class="text-center">
        <br>
        <img src="image.jpg" height="25%" width="25%" class="img-fluid rounded-circle" alt="Image could'nt be loaded">
    </div>
    <h2>Login</h2>

    <form method="POST" action="login.php">
        
    <div class="mb-3 row">
    <label for="email" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="email" name="email" required>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="password" class="col-sm-2 col-form-label">Password :</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
  </div>

        <!-- <label for="email">E-mail:</label>
        <input class="form-control" type="text" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input class="form-control" type="password" id="password" name="password" required><br> -->

        <button class="btn btn-outline-success" type="submit" name="login">Login</button>
        <small id="emailHelp" class="form-text text-muted">Don't have an account? <a
                href="register.php">Register</a></small>
    </form>
</div>
<?php
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email ='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify(password: $password, hash: $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: alert.php");
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found with this E-mail";
    }
}
?>

<?php include('footer.php'); ?>