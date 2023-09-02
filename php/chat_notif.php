 <?php 
 session_start();
 include("config.php");
 $idx=$_SESSION['unique_id'];
  $sql2=mysqli_query($conn,"UPDATE messages set msg_status=1 where msg_status=0 and incoming_msg_id=$idx");