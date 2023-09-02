<?php
session_start();
include("php/config.php");
include_once 'php/encrypt_decrypt.php';
$encrypt= new Encry_Decry();

if (!isset($_SESSION['unique_id'])){
	header("location:login.php");
}else{
		$user_id = mysqli_real_escape_string($conn,$_GET['user']);
		$groupid=mysqli_real_escape_string($conn,$_GET['group_id']);
		$sql=mysqli_query($conn,"DELETE FROM groups where group_unique_id=$groupid and user_unique_id=$user_id");
		$x=$encrypt->encrypt($groupid);
		header("location:group_info.php?a=$x");
		
}

