 <?php 
 session_start();
 include("config.php");
 
 $groupid=mysqli_real_escape_string($conn,$_POST['group_id']);

 $idx=$_SESSION['unique_id'];
  
  $sql2=mysqli_query($conn,"UPDATE group_notifications set notification_status=1 where notification_status=0 and group_unique_id=$groupid and message_unique_id = $idx");