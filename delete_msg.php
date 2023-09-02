<?php
session_start();
include("php/config.php");
include("php/encrypt_decrypt.php");
if(!isset($_SESSION['unique_id'])){
	header("login.php");

}else{
	$id=mysqli_real_escape_string($conn,$_GET['b']);
    $decrypt = new Encry_Decry();
    $result=$decrypt->decrypt($id);
	$msg_idx=mysqli_real_escape_string($conn,$_GET['a']);
	$msg_id=$decrypt->decrypt($msg_idx);
	
	
	$query=mysqli_query($conn,"SELECT * FROM messages where msg_unique_id=$msg_id");
	$res=mysqli_fetch_assoc($query);
	if($res['msg']=='This message was deleted'){
		$del=mysqli_query($conn,"DELETE FROM messages where msg_unique_id=$msg_id");

	}else{
		$sql=mysqli_query($conn,"UPDATE messages SET msg='This message was deleted' where msg_unique_id=$msg_id");
	}
	header("location:chat.php?o=$id");
}