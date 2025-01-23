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
            text-align: center;
            background-color: rgb(233, 229, 229);
            /* Change to your preferred color */
        }
    </style>
</head>
<div class="alert alert-success" role="alert">
    <h2>Register</h2>
</div>

<div class="custom-bg">




    <form method="POST" action="register.php">


    
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="email">E-mail:</label>
        <input type="text" id="email" name="email"><br>

        <label for="location_lat">Location (Latitude):</label>
        <input type="text" id="latitude" name="location_lat"><br>

        <label for="location_lng">Location (Longitude):</label>
        <input type="text" id="longitude" name="location_lng"><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <button class="button" id="get-location-button">Get Location</button><br><br>
        <button type="submit" name="register"> Register</button>






    </form>
</div>
<script type="text/javascript">
    // This function will be called when the button is clicked
    const button = document.getElementById("get-location-button");
    function gotLocation(position) {
        let latitude = position.coords.latitude;
        let longitude = position.coords.longitude;
        console.log(latitude, longitude);
        document.getElementById("latitude").value = latitude;
        document.getElementById("longitude").value = longitude;
    }
    function failedToGet() {
        console.log("some issue");
    }

    button.addEventListener("click", async () => {
        navigator.geolocation.getCurrentPosition(gotLocation, failedToGet);



    });
</script>



<?php
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $location_lat = $_POST['location_lat'];
    $location_lng = $_POST['location_lng'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);


    $sql = "INSERT INTO users (name, email, location_lat, location_lng, password) 
            VALUES ('$name', '$email', '$location_lat', '$location_lng', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<?php include('footer.php'); ?>