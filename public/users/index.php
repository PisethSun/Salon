<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Countdown Timer</title>
</head>
<body>
<h1>Welcome, Coming soon...</h1>
<div id="countdown"></div>

<script>
// Set the end date and time for the countdown
var endDateTime = new Date("2024-12-31T23:59:59").getTime();

function updateCountdown() {
    // Get the current timestamp
    var currentTime = new Date().getTime();

    // Calculate the remaining time in milliseconds
    var remainingTime = endDateTime - currentTime;

    // Convert remaining time to days, hours, minutes, and seconds
    var days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
    var hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

    // Display the countdown
    document.getElementById("countdown").innerHTML = "Countdown: " + days + " days, " + hours + " hours, " + minutes + " minutes, " + seconds + " seconds";

    // Update the countdown every 1 second (1000 milliseconds)
    setTimeout(updateCountdown, 1000);
}

// Initial call to start the countdown
updateCountdown();
</script>

</body>
</html>
