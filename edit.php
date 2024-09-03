<?php
session_start();


include_once "connection.php";

// Initialize variables
$id = $fname = $lname = $number = $email = $password = $address = $photo = $roll = $status = $votes = "";


if (isset($_GET['id'])) {
   
    $id = $_GET['id'];

    
    $sql = "SELECT * FROM user WHERE ID = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
      
            $fname = $row['Fname'];
            $lname = $row['Lname'];
            $number = $row['Number'];
            $email = $row['Email'];
            $password = $row['Password'];
            $address = $row['Address'];
          
            $roll = $row['Roll'];
            $status = $row['Status'];
            $votes = $row['Votes'];
        }
        mysqli_stmt_close($stmt);
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the updated data from the form
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
   
    $roll = $_POST['roll'];
    $status = $_POST['status'];
    $votes = $_POST['votes'];

    
    $sql = "UPDATE user SET Fname = ?, Lname = ?, Number = ?, Email = ?, Password = ?, Address = ?, Photo = ?, Roll = ?, Status = ?, Votes = ? WHERE ID = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssssssiisi", $fname, $lname, $number, $email, $password, $address, $photo, $roll, $status, $votes, $id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Record updated successfully'); window.location = 'admin.php';</script>";
        } else {
            echo "<script>alert('Error updating record');</script>";
        }
        mysqli_stmt_close($stmt);
    }
}


mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form action="edit.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="fname">First Name:</label>
        <input type="text" name="fname" id="fname" value="<?php echo $fname; ?>" required><br><br>
        <label for="lname">Last Name:</label>
        <input type="text" name="lname" id="lname" value="<?php echo $lname; ?>" required><br><br>
        <label for="number">Number:</label>
        <input type="text" name="number" id="number" value="<?php echo $number; ?>" required><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $email; ?>" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value="<?php echo $password; ?>" required><br><br>
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" value="<?php echo $address; ?>" required><br><br>
       
        <label for="roll">Role:</label>
        <input type="number" name="roll" id="roll" value="<?php echo $roll; ?>" required><br><br>
        <label for="status">Status:</label>
        <input type="number" name="status" id="status" value="<?php echo $status; ?>" required><br><br>
       
        <input type="submit" value="Update">
    </form>
</body>
</html>
