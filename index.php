<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div id="header">
        <h1>Online Voting</h1>
        <hr>
    </div>

    <div id="bodySec">
        <form action="" method="post">
            <h2>Login</h2>
            <input type="email" name="mail" id="mail" placeholder="Email" required><br><br>
            <input type="number" name="mobile" id="" placeholder="Enter Number" required><br><br>
            <input type="password" name="password" placeholder="Enter Password" id="" required><br><br>
            <select name="role" id="drop" required>
                <option value="1">Voter</option>
                <option value="2">Group</option>
                <option value="3">Admin</option>
            </select><br><br>
            <button id="login" type="submit">Login</button><br><br>
            New user? <a href="register.php">Register</a><br>
             <a href="forgetpassword.php">Forget password</a>
        </form>
    </div>

    <?php
    session_start();

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
        $mail = $_POST['mail'];
        $number = $_POST['mobile'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $check = mysqli_query($con, "SELECT * FROM user WHERE Email = '$mail' AND number = '$number' AND password = '$password' AND roll = '$role'");
        
        if (mysqli_num_rows($check) > 0) {
            $userdata = mysqli_fetch_array($check);
            $groups = mysqli_query($con, "SELECT * FROM user WHERE roll = 2");
            $groupdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

            // Store user data in session
            $_SESSION['userdata'] = $userdata;
            $_SESSION['groupdata'] = $groupdata;

            if ($role == 3) { // Admin
                $_SESSION['admin'] = true;
                echo "<script>alert('Welcome Admin!'); window.location = 'admin.php';</script>";
            } elseif ($role == 2) { // Group
                $_SESSION['group'] = true;
                echo "<script>alert('Welcome Group!'); window.location = 'dashboard.php';</script>";
            } elseif ($role == 1) { // Voter
                $_SESSION['voter'] = true;
                echo "<script>alert('Welcome Voter!'); window.location = 'dashboard.php';</script>";
            }
        } else {
            echo "<script>alert('Record not found'); window.location = 'index.php';</script>";
        }
    }
    ?>
</body>
</html>
