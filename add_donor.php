<?php
// add_donor.php - Add new donor
include 'config/database.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $donor_id = mysqli_real_escape_string($conn, $_POST['donor_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    
    $insert_query = "INSERT INTO doner (Doner_ID, Name, Age, Gender, Blood_Group, Phone_No) 
                     VALUES ('$donor_id', '$name', '$age', '$gender', '$blood_group', '$phone')";
    
    if(mysqli_query($conn, $insert_query)) {
        echo "<script>alert('Donor added successfully!'); window.location.href='donors.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Donor</title>
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
            <a href="add_donor.php" class="active">Add New Donor</a>
            <a href="add_patient.php">Add New Patient</a>
            <a href="search.php">Search</a>
            <a href="match_blood.php">Match Blood</a>
        </nav>

        <h2>Add New Donor</h2>
        
        <form method="POST" action="" class="data-form">
            <div class="form-group">
                <label>Donor ID (Integer):</label>
                <input type="number" name="donor_id" required placeholder="e.g., 21">
            </div>
            
            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="name" required>
            </div>
            
            <div class="form-group">
                <label>Age:</label>
                <input type="number" name="age" required min="18" max="65">
            </div>
            
            <div class="form-group">
                <label>Gender:</label>
                <select name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
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
                <label>Phone Number:</label>
                <input type="tel" name="phone" required placeholder="017XXXXXXXX">
            </div>
            
            <div class="form-group">
                <input type="submit" value="Add Donor" class="submit-btn">
                <input type="reset" value="Clear" class="reset-btn">
            </div>
        </form>

        <footer>
            <p>&copy; 2026 Blood Donation Organization Bangladesh</p>
        </footer>
    </div>
</body>
</html>