<?php
// match_blood.php - Match donors with patient requirements
include 'config/database.php';

$matched_donors = [];
$selected_patient = null;

if(isset($_POST['match'])) {
    $patient_id = mysqli_real_escape_string($conn, $_POST['patient_id']);
    
    // Get patient details
    $patient_query = "SELECT * FROM patient WHERE Patient_ID = '$patient_id'";
    $patient_result = mysqli_query($conn, $patient_query);
    $selected_patient = mysqli_fetch_assoc($patient_result);
    
    if($selected_patient) {
        // Find matching donors
        $donor_query = "SELECT * FROM doner WHERE Blood_Group = '{$selected_patient['Blood_Group']}' ORDER BY Doner_ID";
        $matched_donors = mysqli_query($conn, $donor_query);
    }
}

// Handle assign donor to patient
if(isset($_GET['assign'])) {
    $donor_id = mysqli_real_escape_string($conn, $_GET['donor']);
    $patient_id = mysqli_real_escape_string($conn, $_GET['patient']);
    
    $update_query = "UPDATE patient SET Doner_ID = '$donor_id' WHERE Patient_ID = '$patient_id'";
    if(mysqli_query($conn, $update_query)) {
        echo "<script>alert('Donor assigned to patient successfully!'); window.location.href='match_blood.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Blood</title>
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
            <a href="search.php">Search</a>
            <a href="match_blood.php" class="active">Match Blood</a>
        </nav>

        <h2>Match Donors with Patient Requirements</h2>
        
        <form method="POST" action="" class="match-form">
            <label>Select Patient:</label>
            <select name="patient_id" required>
                <option value="">-- Select Patient --</option>
                <?php
                $patients = mysqli_query($conn, "SELECT * FROM patient ORDER BY Patient_ID");
                while($patient = mysqli_fetch_assoc($patients)) {
                    $assigned = $patient['Doner_ID'] ? " (Assigned to Donor: {$patient['Doner_ID']})" : "";
                    echo "<option value='{$patient['Patient_ID']}'>Patient {$patient['Patient_ID']} - {$patient['Name']} (Blood: {$patient['Blood_Group']}, Needs: {$patient['RQ_of_Blood_Bag']} bags)$assigned</option>";
                }
                ?>
            </select>
            <input type="submit" name="match" value="Find Matching Donors">
        </form>

        <?php if($selected_patient): ?>
            <div class="match-results">
                <h3>Patient: <?php echo htmlspecialchars($selected_patient['Name']); ?></h3>
                <p><strong>Blood Group Required:</strong> <?php echo $selected_patient['Blood_Group']; ?></p>
                <p><strong>Quantity Needed:</strong> <?php echo $selected_patient['RQ_of_Blood_Bag']; ?> bags</p>
                
                <h4>Available Donors with Matching Blood Type:</h4>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Donor ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Blood Group</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(mysqli_num_rows($matched_donors) > 0): ?>
                            <?php 
                            $donor_count = 0;
                            while($donor = mysqli_fetch_assoc($matched_donors)): 
                                $donor_count++;
                                $is_assigned = ($selected_patient['Doner_ID'] == $donor['Doner_ID']);
                            ?>
                            <tr>
                                <td><?php echo $donor['Doner_ID']; ?></td>
                                <td><?php echo htmlspecialchars($donor['Name']); ?></td>
                                <td><?php echo $donor['Age']; ?></td>
                                <td><?php echo $donor['Gender']; ?></td>
                                <td><?php echo $donor['Blood_Group']; ?></td>
                                <td><?php echo $donor['Phone_No']; ?></td>
                                <td>
                                    <?php if($is_assigned): ?>
                                        <span class="assigned-badge">✓ Assigned</span>
                                    <?php elseif($selected_patient['Doner_ID']): ?>
                                        <span class="already-assigned">Not Assigned</span>
                                    <?php else: ?>
                                        <a href="?assign=1&donor=<?php echo $donor['Doner_ID']; ?>&patient=<?php echo $selected_patient['Patient_ID']; ?>" class="assign-btn">Assign to Patient</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                            <tr class="summary-row">
                                <td colspan="7"><strong>Total Available Donors: <?php echo $donor_count; ?></strong></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">No matching donors found for this blood type.</td>
                            </tr>
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