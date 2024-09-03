<?php
session_start();


if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}


include_once "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            background-color: burlywood;
        }
        
    </style>
</head>
<body>
    <h1>Welcome to Admin Panel</h1>
    
    <h2>Manage Groups</h2>
   
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fname</th>
                <th>Lname</th>
                <th>Number</th>
                <th>Email</th>
               
                <th>Address</th>
                <th>Photo</th>
                <th>Roll</th>
                <th>Status</th>
                <th>Votes</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $sql = "SELECT * FROM user WHERE Roll = 2";
            $result = mysqli_query($conn, $sql);
           
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['ID']."</td>";
                echo "<td>".$row['Fname']."</td>";
                echo "<td>".$row['Lname']."</td>";
                echo "<td>".$row['Number']."</td>";
                echo "<td>".$row['Email']."</td>";
             
                echo "<td>".$row['Address']."</td>";
                echo "<td>".$row['Photo']."</td>";
                echo "<td>".$row['Roll']."</td>";
                echo "<td>".$row['Status']."</td>";
                echo "<td>".$row['Votes']."</td>";
                echo "<td>";
                echo "<a href='edit.php?id=".$row['ID']."'>Edit</a> | ";
                echo "<a href='delete.php?id=".$row['ID']."'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    
    <h2>Manage Voters</h2>
 
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fname</th>
                <th>Lname</th>
                <th>Number</th>
                <th>Email</th>
                
                <th>Address</th>
                <th>Photo</th>
                <th>Roll</th>
                <th>Status</th>
               
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $sql = "SELECT * FROM user WHERE Roll = 1";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['ID']."</td>";
                echo "<td>".$row['Fname']."</td>";
                echo "<td>".$row['Lname']."</td>";
                echo "<td>".$row['Number']."</td>";
                echo "<td>".$row['Email']."</td>";
            
                echo "<td>".$row['Address']."</td>";
                echo "<td>".$row['Photo']."</td>";
                echo "<td>".$row['Roll']."</td>";
                echo "<td>".$row['Status']."</td>";
                echo "<td>";
                echo "<a href='edit.php?id=".$row['ID']."'>Edit</a> | ";
                echo "<a href='delete.php?id=".$row['ID']."'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
