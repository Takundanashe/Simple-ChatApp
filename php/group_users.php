<?php
    session_start();
    include_once "config.php";
    $user_id = $_SESSION['unique_id'];
    $sql = "SELECT * FROM groups WHERE NOT user_unique_id = {$user_id} ORDER BY group_id DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
      $output .= "No groups are available to join";
    }elseif(mysqli_num_rows($query) > 0){
               include_once("creategroup.php");
             include_once "group_data.php";
    }
    echo $output;
?>

