<?php
// index.php - Homepage
include 'config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation Organization - Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🩸 Shahid Ahnaf Abir Blood Bank(MIU)</h1>
            <p>Save Lives - Donate Blood</p>
        </header>

        <nav class="main-nav">
            <a href="index.php" class="active">Home</a>
            <a href="donors.php">Donors List</a>
            <a href="patients.php">Patients List</a>
            <a href="add_donor.php">Add New Donor</a>
            <a href="add_patient.php">Add New Patient</a>
            <a href="search.php">Search</a>
            <a href="match_blood.php">Match Blood</a>
        </nav>

        <div class="stats">
            <h2>Organization Statistics</h2>
            <?php
            // Get donor count
            $donor_query = "SELECT COUNT(*) as total FROM doner";
            $donor_result = mysqli_query($conn, $donor_query);
            $donor_count = mysqli_fetch_assoc($donor_result)['total'];

            // Get patient count
            $patient_query = "SELECT COUNT(*) as total FROM patient";
            $patient_result = mysqli_query($conn, $patient_query);
            $patient_count = mysqli_fetch_assoc($patient_result)['total'];

            // Get blood type distribution
            $blood_query = "SELECT Blood_Group, COUNT(*) as count FROM doner GROUP BY Blood_Group ORDER BY Blood_Group";
            $blood_result = mysqli_query($conn, $blood_query);
            ?>

            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total Donors</h3>
                    <p class="stat-number"><?php echo $donor_count; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Total Patients</h3>
                    <p class="stat-number"><?php echo $patient_count; ?></p>
                </div>
            </div>

            <div class="blood-distribution">
                <h3>Blood Type Distribution (Donors)</h3>
                <table class="data-table">
                    <thead>
                        <tr><th>Blood Type</th><th>Number of Donors</th></tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($blood_result)): ?>
                        <tr>
                            <td><?php echo $row['Blood_Group']; ?></td>
                            <td><?php echo $row['count']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <footer>
            <p>&copy; 2026 Blood Donation Organization Bangladesh | Every drop counts</p>
        </footer>
    </div>
</body>
</html>