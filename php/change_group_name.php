<?php 
session_start();



if(isset($_POST["groupname"]))
{
 include("config.php");

 $groupname = mysqli_real_escape_string($conn, $_POST["groupname"]);
 echo $groupname;
 $group_id = mysqli_real_escape_string($conn,$_POST['id']);
 echo $group_id;
 $sql="UPDATE groups SET group_name='$groupname' WHERE group_unique_id=$group_id";
 $res=mysqli_query($conn,$sql);
 
}