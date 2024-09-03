<?php
$conn = mysqli_connect("localhost", "root", "", "voting") or die("Connection Failed");

if($conn){
    echo "Database Connected";
}
else{
    echo "Not Connected";
}
?>
