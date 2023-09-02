 
<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
  if($_SERVER["REQUEST_METHOD"]=='POST'){
  	//first we are going check if the password is correct
   $group_id = mysqli_real_escape_string($conn, $_GET['group_id']);
    
    $group_pass=mysqli_real_escape_string($conn,$_POST['password']);
    $x=md5($group_pass);
    if(!empty($group_id) && !empty($group_pass)){
      $sql = mysqli_query($conn, "SELECT * FROM groups WHERE group_unique_id = $group_id AND password ='$x'");

      if(mysqli_num_rows($sql) > 0){

      	//insert the user into the group
      	$result=mysqli_fetch_assoc($sql);
      	$group_name=$result['group_name'];
      	$group_link=$result['group_link'];
      	$id =$_SESSION['unique_id'];
      	$access=2;
      	$icon = $result['group_icon'];
      	$insert_query = mysqli_query($conn, "INSERT INTO groups (group_unique_id, group_name, group_link, user_unique_id, password,access, group_icon)
                      VALUES ('$group_id', '$group_name','$group_link', '$id', '$x', '$access', '$icon')") or die("Error".mysqli_error()); 
          
          header('location:group_members.php');
          echo "<script>alert('You joined the group successfully');</script>";
       }else{

      echo "<script>alert('Wrong password!');</script>";
        
       }
     }
   }
?>
 
  <?php include_once("header.php") ?>

<div id="form_con">
	<a href="group_members.php" style="float:right;font-size: 19px;text-decoration: none" title="Close">x</a>
<form method="post">

	<input id="password_in" type="password" name="password" placeholder="Password" required>
	<br><br>
	<input id="joinbtn" type="submit" name="Join" value="Join">
</div>

<style type="text/css">
	#form_con{
		border:1px #ccc solid;
		padding: 20px;
		text-align: center;
	}
	#password_in{
		width:300px;
		height: 30px;

	}
	#joinbtn{
		width: 150px;
		height:30px;
		background-color: #405d9b;
		border:none;
		border-radius: 4px;
		color: white;
		font-size: 16px;
	}
</style>