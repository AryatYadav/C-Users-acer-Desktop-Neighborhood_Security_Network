<?php
//include('header.php');
include('db.php'); ?>

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
      background-color:rgb(233, 229, 229); /* Change to your preferred color */
    }
  </style>
</head>
<div class="alert alert-danger" role="alert">

    <h1>Alert System</h1>
    <h2>Send an Alert</h2>

</div>
<div class="custom-bg">




    <form method="POST" action="alert.php">
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea><br>

        <label for="location_lat">Location (Latitude):</label>
        <input type="text" id="latitude" name="location_lat"><br>

        <label for="location_lng">Location (Longitude):</label>
        <input type="text" id="longitude" name="location_lng"><br>

        <button class="buttton" id="get-location-button">Get Location</button><br><br>

        <button type="submit" name="alert">Send Alert</button>
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
if (isset($_POST['alert'])) {
    $message = $_POST['message'];
    $location_lat = $_POST['location_lat'];
    $location_lng = $_POST['location_lng'];

    // Haversine formula to calculate distance between two lat-lng points
    function haversine($lat1, $lng1, $lat2, $lng2)
    {
        $earth_radius = 6371000;  // Earth radius in meters
        $dlat = deg2rad($lat2 - $lat1);
        $dlng = deg2rad($lng2 - $lng1);
        $a = sin($dlat / 2) * sin($dlat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dlng / 2) * sin($dlng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $earth_radius * $c;  // Distance in meters
    }

    // Get all users within 100 meters of the alert location
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $distance = haversine($location_lat, $location_lng, $row['location_lat'], $row['location_lng']);
        if ($distance <= 100) {  // If the user is within 100 meters
            // Send alert (this could be an SMS, email, or internal message; here we simply display it)
            echo "Alert sent to: " . $row['name'] . " Successfully. Which is " . $message . "<br>";
        }
    }
}
?>

<?php include('footer.php'); ?>