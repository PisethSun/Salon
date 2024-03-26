<?php 
require_once('../../private/initialize.php');



$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $connection = db_connect();

    try {
        // Retrieve task_id, reservation_day, and reservation_time from the form
        $task_id = $_POST['task_id'];
        $reservation_day = $_POST['reservation_day'];
        $reservation_time = $_POST['reservation_time'];
        
        // Fetch customer_id from the session
        $customer_id = $_SESSION['customer_id']; // Use the session variable

        // Insert into reservation table
        $reservation_sql = "INSERT INTO reservation (reservation_day, reservation_time, reservation_status, customer_id) VALUES (?, ?, 'pending', ?)";

        $stmt = $connection->prepare($reservation_sql);
        $stmt->bind_param("ssi", $reservation_day, $reservation_time, $customer_id);
        $stmt->execute();
        $reservation_id = $stmt->insert_id;

        // Generate an Invoice
        $invoice_sql = "INSERT INTO invoice (reservation_id, invoice_date, invoice_status) VALUES (?, NOW(), 'pending')";

        $stmt = $connection->prepare($invoice_sql);
        $stmt->bind_param("i", $reservation_id);
        $stmt->execute();

        $stmt->close();
        $connection->close();

        // Redirect to index.php or another success page
        header("Location: index.php");
        exit;

    } catch (Exception $e) {
        // Rollback the transaction if any exception occurs
        mysqli_rollback($connection);
        echo "An error occurred while creating the account: " . $e->getMessage();
    }
}
?>


<?php $page_title = 'Welcome -Book Appointment Today';?>
<?php include(SHARED_PATH .'/user_header.php');?>


<div class="container-xl" style="height: 400px;width: 700px;background-color: plum">
<BR></BR>
<div class="container-xl" style="background-color: white; height: 300px;width: 600px;">

<form action="" method="POST">
<div class="form-outline" data-mdb-input-init>
    <label class="form-label" for="task_id">Select a Task:</label>
    <select name="task_id" id="task_id" class="form-control">
        <!-- Options should be dynamically generated from the database -->
        <option value="1">Manicure</option>
        <option value="2">Pedicure</option>
        <!-- Add more tasks here -->
    </select>
</div>
<br>

<br>
<div class="form-outline" data-mdb-input-init>
    <label class="form-label" for="reservation_day">Reservation Day:</label>
    <input type="date" id="reservation_day" name="reservation_day" class="form-control" required />
</div>
<br>
<div class="form-outline" data-mdb-input-init>
    <label class="form-label" for="reservation_time">Reservation Time:</label>
    <input type="time" id="reservation_time" name="reservation_time" class="form-control" required />
    
    
</div>
<br>
<input type="submit" name="submit" class="btn btn-primary" value="Submit">
</form>
</div>
</div>









