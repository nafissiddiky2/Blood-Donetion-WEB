<?php
// search.php - Search functionality
include 'config/database.php';

$search_results = [];
$search_term = '';

if(isset($_POST['search'])) {
    $search_term = mysqli_real_escape_string($conn, $_POST['search_term']);
    
    // Search in donors
    $donor_query = "SELECT * FROM doner WHERE Name LIKE '%$search_term%' OR Blood_Group LIKE '%$search_term%' OR Phone_No LIKE '%$search_term%'";
    $donor_results = mysqli_query($conn, $donor_query);
    
    // Search in patients
    $patient_query = "SELECT * FROM patient WHERE Name LIKE '%$search_term%' OR Blood_Group LIKE '%$search_term%' OR Phone_Number LIKE '%$search_term%'";
    $patient_results = mysqli_query($conn, $patient_query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
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
            <a href="patients.php">Patients List</a>
            <a href="add_donor.php">Add New Donor</a>
            <a href="add_patient.php">Add New Patient</a>
            <a href="search.php" class="active">Search</a>
            <a href="match_blood.php">Match Blood</a>
        </nav>

        <h2>Search Donors and Patients</h2>
        
        <form method="POST" action="" class="search-form">
            <input type="text" name="search_term" placeholder="Search by name, blood group, or phone..." value="<?php echo htmlspecialchars($search_term); ?>" required>
            <input type="submit" name="search" value="Search">
        </form>

        <?php if(isset($_POST['search'])): ?>
            <div class="search-results">
                <h3>Search Results for: "<?php echo htmlspecialchars($search_term); ?>"</h3>
                
                <h4>Donors Found:</h4>
                <table class="data-table">
                    <thead>
                        <tr><th>Donor ID</th><th>Name</th><th>Blood Group</th><th>Phone</th></tr>
                    </thead>
                    <tbody>
                        <?php if(mysqli_num_rows($donor_results) > 0): ?>
                            <?php while($row = mysqli_fetch_assoc($donor_results)): ?>
                            <tr>
                                <td><?php echo $row['Doner_ID']; ?></td>
                                <td><?php echo htmlspecialchars($row['Name']); ?></td>
                                <td><?php echo $row['Blood_Group']; ?></td>
                                <td><?php echo $row['Phone_No']; ?></td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="4">No donors found</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <h4>Patients Found:</h4>
                <table class="data-table">
                    <thead>
                        <tr><th>Patient ID</th><th>Name</th><th>Blood Group</th><th>Phone</th></tr>
                    </thead>
                    <tbody>
                        <?php if(mysqli_num_rows($patient_results) > 0): ?>
                            <?php while($row = mysqli_fetch_assoc($patient_results)): ?>
                            <tr>
                                <td><?php echo $row['Patient_ID']; ?></td>
                                <td><?php echo htmlspecialchars($row['Name']); ?></td>
                                <td><?php echo $row['Blood_Group']; ?></td>
                                <td><?php echo $row['Phone_Number']; ?></td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="4">No patients found</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <footer>
            <p>&copy; 2026 Blood Donation Organization Bangladesh</p>
        </footer>
    </div>
</body>
</html>