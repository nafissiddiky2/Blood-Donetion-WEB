<?php
// patients.php - Display all patients
include 'config/database.php';

// Handle delete request
if(isset($_GET['delete'])) {
    $patient_id = mysqli_real_escape_string($conn, $_GET['delete']);
    $delete_query = "DELETE FROM patient WHERE Patient_ID = '$patient_id'";
    if(mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Patient deleted successfully!'); window.location.href='patients.php';</script>";
    } else {
        echo "<script>alert('Error deleting patient!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients List</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🩸 Shahid Ahnaf Abir Blood Bank(MIU)</h1>
        </header>

        <nav class="main-nav">
            <a href="index.php">Home</a>
            <a href="donors.php">Donors List</a>
            <a href="patients.php" class="active">Patients List</a>
            <a href="add_donor.php">Add New Donor</a>
            <a href="add_patient.php">Add New Patient</a>
            <a href="search.php">Search</a>
            <a href="match_blood.php">Match Blood</a>
        </nav>

        <h2>Patients List</h2>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Patient ID</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Blood Group</th>
                    <th>Required Quantity (Bags)</th>
                    <th>Assigned Donor ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM patient ORDER BY Patient_ID";
                $result = mysqli_query($conn, $query);
                
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['Patient_ID'] . "</td>";
                        echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
                        echo "<td>" . $row['Phone_Number'] . "</td>";
                        echo "<td>" . $row['Blood_Group'] . "</td>";
                        echo "<td>" . $row['RQ_of_Blood_Bag'] . "</td>";
                        echo "<td>" . ($row['Doner_ID'] ? $row['Doner_ID'] : 'Not Assigned') . "</td>";
                        echo "<td><a href='?delete=" . $row['Patient_ID'] . "' onclick='return confirm(\"Are you sure?\")' class='delete-btn'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No patients found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <footer>
            <p>&copy; 2026 Blood Donation Organization Bangladesh</p>
        </footer>
    </div>
</body>
</html>