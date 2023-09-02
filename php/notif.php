<?php 
  session_start();
  include_once "config.php";
  $out1="";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
}else{
	$id =$_SESSION['unique_id'];
	$sql=mysqli_query($conn,"SELECT * FROM messages where msg_status=0 and incoming_msg_id=$id");
	$res =mysqli_num_rows($sql);
	$out1.='<span style="background-color:#405d9b;color:white;padding:7px 10px;border-radius:50%;">'.$res.'</span';
	//echo $out1;
	
}
$data = array(
  'unseen_notification' => $out1,
  'notif_count'=>$res

 );
 echo json_encode($data);