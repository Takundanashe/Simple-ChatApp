
<?php
    session_start();
    include_once "config.php";

    $user_id = $_SESSION['unique_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT * FROM groups WHERE user_unique_id != {$user_id} AND (group_name LIKE '%{$searchTerm}%') ";
    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        $row=mysqli_fetch_assoc($query);
        $groupname=$row['group_name'];

        $sql2 = mysqli_query($conn,"SELECT * from groups where group_name='$groupname' and user_unique_id = $user_id");
      
        if(mysqli_num_rows($sql2)>0){
           $query2=mysqli_query($conn,"SELECT * FROM groups where user_unique_id != {$user_id} and group_name !='$groupname' and group_name like '%{$searchTerm}%' ");
           if (mysqli_num_rows($query2)==0){
               
                $row2=mysqli_fetch_assoc($query2);
                 include_once('searchgrp1.php');

           }else{
                $output .= "No groups are available to join";
           }

           
           
             
            }else{
                 include_once('searchgrp.php');
            }   
    }else{
        $output .= 'No groups found related to your search term';
    }
    echo $output;
?>
 


    