<?php
session_start();
include('config.php');
if(!isset($_SESSION['unique_id'])){
	header("location:login.php");

}else{
	$id=$_SESSION['unique_id'];

	$groupid=mysqli_real_escape_string($conn,$_POST['id']);
	echo $groupid;
	$sql=mysqli_query($conn,"DELETE FROM groups where group_unique_id=$groupid and user_unique_id=$id");

}