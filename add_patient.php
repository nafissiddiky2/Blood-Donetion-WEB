<?php
// add_patient.php - Add new patient
include 'config/database.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_id = mysqli_real_escape_string($conn, $_POST['patient_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $doner_id = !empty($_POST['doner_id']) ? mysqli_real_escape_string($conn, $_POST['doner_id']) : 'NULL';
    
    $insert_query = "INSERT INTO patient (Patient_ID, Name, Phone_Number, Blood_Group, RQ_of_Blood_Bag, Doner_ID) 
                     VALUES ('$patient_id', '$name', '$phone', '$blood_group', '$quantity', " . ($doner_id == 'NULL' ? 'NULL' : "'$doner_id'") . ")";
    
    if(mysqli_query($conn, $insert_query)) {
        echo "<script>alert('Patient added successfully!'); window.location.href='patients.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

// Fetch donors for dropdown
$donors_query = "SELECT Doner_ID, Name, Blood_Group FROM Doner ORDER BY Doner_ID";
$donors_result = mysqli_query($conn, $donors_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Patient</title>
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
            <a href="add_patient.php" class="active">Add New Patient</a>
            <a href="search.php">Search</a>
            <a href="match_blood.php">Match Blood</a>
        </nav>

        <h2>Add New Patient</h2>
        
        <form method="POST" action="" class="data-form">
            <div class="form-group">
                <label>Patient ID (Integer):</label>
                <input type="number" name="patient_id" required placeholder="e.g., 11">
            </div>
            
            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="name" required>
            </div>
            
            <div class="form-group">
                <label>Phone Number:</label>
                <input type="tel" name="phone" required placeholder="017XXXXXXXX">
            </div>
            
            <div class="form-group">
                <label>Blood Group:</label>
                <select name="blood_group" required>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Required Quantity (Bags):</label>
                <input type="number" name="quantity" required min="1" max="10">
            </div>
            
            <div class="form-group">
                <label>Assign Donor (Optional):</label>
                <select name="doner_id">
                    <option value="">-- None --</option>
                    <?php while($donor = mysqli_fetch_assoc($donors_result)): ?>
                        <option value="<?php echo $donor['Doner_ID']; ?>">
                            <?php echo $donor['Doner_ID'] . " - " . $donor['Name'] . " (" . $donor['Blood_Group'] . ")"; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            
            <div class="form-group">
                <input type="submit" value="Add Patient" class="submit-btn">
                <input type="reset" value="Clear" class="reset-btn">
            </div>
        </form>

        <footer>
            <p>&copy; 2026 Blood Donation Organization Bangladesh</p>
        </footer>
    </div>
</body>
</html>