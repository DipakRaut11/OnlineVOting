<?php
session_start();


include_once "connection.php";


if (isset($_GET['id'])) {
    
    $id = $_GET['id'];

    
    $sql = "DELETE FROM user WHERE ID = ?";

   
    if ($stmt = mysqli_prepare($conn, $sql)) {
       
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
           
            echo "<script>alert('Record deleted successfully'); window.location = 'admin.php';</script>";
        } else {
           
            echo "<script>alert('Error deleting record'); window.location = 'admin.php';</script>";
        }

        
    } else {
      
        echo "<script>alert('Error preparing the statement'); window.location = 'admin.php';</script>";
    }
} else {
    
    echo "<script>alert('ID not set in the URL'); window.location = 'admin.php';</script>";
}


mysqli_close($conn);
?>
