<?php
session_start();


if (!isset($_SESSION['voter']) && !isset($_SESSION['group'])) {
    header("Location: index.php");
    exit;
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupdata'];
$Status = $userdata['Status'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
<div id="mainSec">
    <div id="headerSec">
        <a href="../"><button id="backbutton">Back</button></a>
        <a href="logout.php"><button id="logoutbutton">Logout</button></a>
        <h1>Online Voting</h1>
    </div>
    <hr>
    <div id="main">
        <div id="profile">
            <img src="uploads/<?php echo $userdata['Photo']; ?>" height="90" width="90" alt=""><br><br>
            <b>Name:</b> <?php echo $userdata['Fname'] . ' ' . $userdata['Lname']; ?><br><br>
            <b>Mobile:</b> <?php echo $userdata['Number']; ?><br><br>
            <b>Address:</b> <?php echo $userdata['Address']; ?><br><br>
            <b>Status:</b> <?php echo $Status == 0 ? 'Not Voted' : 'Voted'; ?><br><br>
            <b>Email:</b> <?php echo $userdata['Email']; ?><br><br>
        </div>
        <div id="group">
            <?php
            if (!empty($groupsdata)) {
                foreach ($groupsdata as $group) {
            ?>
                    <div>
                        <img src="uploads/<?php echo $group['Photo']; ?>" height="90" width="90" alt=""><br><br>
                        <b>Group Name: <?php echo $group['Fname']; ?></b><br><br>
                       
                        <form action="vote.php" method="post">
                            <input type="hidden" name="groupvotes" id="groupvotes" value="<?php echo $group['Votes']; ?>">
                            <input type="hidden" name="groupid" id="groupid" value="<?php echo $group['ID']; ?>">
                            <?php
                            if ($Status == 0) {
                            ?>
                                 <input type="submit" name="votebtn" id="votebtn" value="Vote">
                            <?php
                            } else {
                            ?>
                                <button disabled type="button" name="votebtn" id="Voted" value="Vote">Already Voted</button>
                            <?php
                            }
                            ?>
                        </form>
                    </div>
            <?php
                }
            } else {
                echo "No groups available.";
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
