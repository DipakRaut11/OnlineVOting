<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="index.css">

</head>
<body>
    <div>
        <h1>Online Voting</h1>
        <h2>Register</h2>
    </div>

    <form action="" method="POST" enctype="multipart/form-data">
    <input type="text" name="fname" id="fname" placeholder="First Name" 
               pattern="[A-Z][a-z]*" title="First letter must be capitalized and other lowercase" required><br><br>
        <input type="text" name="lname" id="lname" placeholder="Last Name" 
               pattern="[A-Z][a-z]*" title="First letter must be capitalized and other in lowercase" required><br><br>
     
               
        <input type="text" name="number" id="number" placeholder="Phone number" pattern="9[78]\d{8}" title="Please enter a 10-digit number starting with 98 or 97" required>



        <input type="email" name="mail" id="mail" placeholder="email"><br><br>
        <input type="password" name="password" id="password" placeholder="password"
        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{5,}" 
        title="Password must contain at least one number, one uppercase letter, 
        one lowercase letter, one special character, 
        and be at least 5 characters long." required ><br><br>
        
        <input type="password" name="cpassword" id="cpassword" placeholder="confirm password"><br><br>
        <input type="text" name="address" id="address" placeholder="Address"><br><br>
        <input type="file" name="picture" id="picture" placeholder="Image"><br><br>
        <select name="role" id="role">
            <option value="1">Voter</option>
            <option value="2">Group</option>
            <!-- <option value="3">Admin</option> -->
        </select><br><br>
        <button type="submit">Signup</button><br><br>
        Already user? <a href="index.php">Login</a>
    </form>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "voting";

    function connectDatabase() {
        global $servername, $username, $password, $database;
        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
    $con = connectDatabase();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $number = $_POST['number'];
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $address = $_POST['address'];
        $role = $_POST['role'];

        if ($password == $cpassword) {
            $picture = $_FILES['picture']['name'];
            $temp_name = $_FILES['picture']['tmp_name'];
            $uploads_dir = "./uploads/";
            move_uploaded_file($temp_name, $uploads_dir . $picture);

            $stmt = $con->prepare("INSERT INTO user (Fname, Lname, Number, Email, Password, Address, Photo, Roll, Status, Votes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, 0)");
            $stmt->bind_param("ssissssi", $fname, $lname, $number, $mail, $password, $address, $picture, $role);
            
            if ($stmt->execute()) {
                echo "<script>alert('Registration success'); window.location = 'index.php';</script>";
            } else {
                echo "<script>alert('Error Occurred');</script>";
            }
        } else {
            echo "<script>alert('Passwords do not match'); window.location = 'register.php';</script>";
        }
    }
    ?>
</body>
</html>
