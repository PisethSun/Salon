<?php 
require_once('../../private/initialize.php');

$connection = db_connect(); // Ensure this function properly connects to your database

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $search_term = $_POST['search_term']; // Search term provided by the user
    $search_sql = "SELECT * FROM invoice WHERE invoice_id = ?"; // Query to search for a specific invoice
    $stmt = $connection->prepare($search_sql);
    $stmt->bind_param("i", $search_term); // "i" indicates the parameter type is integer
} else {
    $search_sql = "SELECT * FROM invoice"; // Query to fetch all invoices
    $stmt = $connection->prepare($search_sql);
}

$stmt->execute();
$result = $stmt->get_result();

?>

<?php $page_title = 'Invoice'; ?>
<?php include(SHARED_PATH .'/user_header.php'); ?>

<div class="container-xl" style="background-color: plum;height: 400px;width: 600px;">
<br>
    <!-- Search form -->
    <form action="" method="POST">
        <label for="search_term">Search Invoice:</label>
        <input type="text" name="search_term" required>
        <input type="submit" name="search" value="Search">
    </form>

    <br>

    <div class="container-xl" style="background-color: white; ">
        <table class="table" style="color: black; background-color: white;">
            <thead>
                <tr>
                    
                    <th scope="col">Invoice ID</th>
                    <th scope="col">Reservation ID</th>
                    <th scope="col">Invoice Date</th>
                    <th scope="col">Invoice Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($result->num_rows > 0) {
                    $count = 1; // Initialize a counter for the row numbers
                    while ($row = $result->fetch_assoc()) {
                        // Dynamically creating table rows for each result
                        echo "<tr>";
                      
                        echo "<td>" . $row['invoice_id'] . "</td>";
                        echo "<td>" . $row['reservation_id'] . "</td>";
                        echo "<td>" . $row['invoice_date'] . "</td>";
                        echo "<td>" . $row['invoice_status'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    // If no results found
                    echo "<tr><td colspan='5'>No results found.</td></tr>";
                }
                $stmt->close();
                $connection->close();
                ?>
            </tbody>
        </table>
    </div>
</div>
