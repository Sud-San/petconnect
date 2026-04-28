<?php
// filepath: c:\wamp64\www\PetConnect\admin\pet\check_petname.php
include "../../db/db.php";
if(isset($_POST['userid'])) {
    $userid = $_POST['userid'];
    // Your PHP function logic here
    // Example: check if user ID exists
    $sql = "SELECT * FROM users WHERE user_id='$userid'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        echo $row['name']; // Return the owner's name
    } else {
        echo "Owner not found.";
    }
}
?>