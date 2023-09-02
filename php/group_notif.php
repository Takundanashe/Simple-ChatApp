<?php 
  session_start();
  include_once "config.php";
  $out1="";
  $groupid="";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
}else{
	$id =$_SESSION['unique_id'];
  $sqlx="SELECT * FROM groups WHERE user_unique_id='$id' order by group_id desc ";
  $result=mysqli_query($conn,$sqlx);
              if (mysqli_num_rows($result)>0){
                $num_of_groups = mysqli_num_rows($result);
                  //selecting the last message in the group
                  //correct here its displaying users' last message not group last
                  
                    $row = mysqli_fetch_assoc($result)
                
                    $groupid =$row['group_unique_id'];
                   
                 }
	$sql=mysqli_query($conn,"SELECT * FROM group_notifications where notification_status=0  and group_unique_id=$groupid and message_unique_id=$id");
	$res =mysqli_num_rows($sql);
	$out1.='<span style="background-color:#405d9b;color:white;padding:7px 10px;border-radius:50%;">'.$res.'</span';
	//echo $out1;
	
}
$data = array(
  'unseen_notification' => $out1,
  'notif_count'=>$res

 );
 echo json_encode($data);