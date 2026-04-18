<?php
// donors.php - Display all donors
include 'config/database.php';

// Handle delete request
if(isset($_GET['delete'])) {
    $donor_id = mysqli_real_escape_string($conn, $_GET['delete']);
    
    // First, set Doner_ID to NULL in Patient table
    $update_patient = "UPDATE patient SET Doner_ID = NULL WHERE Doner_ID = '$donor_id'";
    mysqli_query($conn, $update_patient);
    
    // Then delete the donor
    $delete_query = "DELETE FROM doner WHERE Doner_ID = '$donor_id'";
    if(mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Donor deleted successfully!'); window.location.href='donors.php';</script>";
    } else {
        echo "<script>alert('Error deleting donor!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donors List</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🩸 Shahid Ahnaf Abir Blood Bank(MIU)</h1>
        </header>

        <nav class="main-nav">
            <a href="index.php">Home</a>
            <a href="donors.php" class="active">Donors List</a>
            <a href="patients.php">Patients List</a>
            <a href="add_donor.php">Add New Donor</a>
            <a href="add_patient.php">Add New Patient</a>
            <a href="search.php">Search</a>
            <a href="match_blood.php">Match Blood</a>
        </nav>

        <h2>Donors List</h2>
        
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search donors by name or blood type..." onkeyup="filterTable()">
        </div>

        <table class="data-table" id="donorsTable">
            <thead>
                <tr>
                    <th>Donor ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Blood Group</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM doner ORDER BY Doner_ID";
                $result = mysqli_query($conn, $query);
                
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['Doner_ID'] . "</td>";
                        echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
                        echo "<td>" . $row['Age'] . "</td>";
                        echo "<td>" . $row['Gender'] . "</td>";
                        echo "<td>" . $row['Blood_Group'] . "</td>";
                        echo "<td>" . $row['Phone_No'] . "</td>";
                        echo "<td><a href='?delete=" . $row['Doner_ID'] . "' onclick='return confirm(\"Are you sure?\")' class='delete-btn'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No donors found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <footer>
            <p>&copy; 2026 Blood Donation Organization Bangladesh</p>
        </footer>
    </div>

    <script>
    function filterTable() {
        let input = document.getElementById('searchInput');
        let filter = input.value.toUpperCase();
        let table = document.getElementById('donorsTable');
        let tr = table.getElementsByTagName('tr');

        for (let i = 1; i < tr.length; i++) {
            let tdName = tr[i].getElementsByTagName('td')[1];
            let tdBlood = tr[i].getElementsByTagName('td')[4];
            if (tdName || tdBlood) {
                let nameValue = tdName.textContent || tdName.innerText;
                let bloodValue = tdBlood.textContent || tdBlood.innerText;
                if (nameValue.toUpperCase().indexOf(filter) > -1 || bloodValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }       
        }
    }
    </script>
</body>
</html>