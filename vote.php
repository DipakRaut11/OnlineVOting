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

$votes = $_POST['groupvotes'];
$totalvotes = $votes+1;

$groupid = $_POST['groupid'];
$uid = $_SESSION['userdata']['ID'];

$updateVotes = mysqli_query($con, "UPDATE user SET votes = '$totalvotes' WHERE ID = '$groupid'");

$UpdateuserStatus = mysqli_query($con, "UPDATE user SET status = 1 WHERE ID = '$uid'"); 

if($updateVotes and $UpdateuserStatus){

    $groups = mysqli_query($con, "SELECT * FROM user WHERE roll = 2");
    $groupdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

    
    $_SESSION['userdata']['Status'] = 1;
    $_SESSION['groupsdata'] = $groupdata;


 echo "<script>alert('Voting success'); window.location = 'dashboard.php';</script>";



}
else{
    echo "<script>alert('Error Occur'); window.location = 'dashboard.php';</script>";

}



?>