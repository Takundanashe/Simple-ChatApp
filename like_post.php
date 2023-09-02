<?php 
  session_start();
  include_once "php/config.php";
 
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }else{

  $post_id = mysqli_real_escape_string($conn, $_GET['post_id']);
  $id = $_SESSION['unique_id'];
  $like_id = rand(time(),100000000);
  $sql=mysqli_query($conn,"SELECT * FROM likes where user_unique_id=$id and post_unique_id=$post_id");
  		if(mysqli_num_rows($sql)<1){
  			$sql2=mysqli_query($conn,"INSERT INTO likes(like_unique_id,post_unique_id,user_unique_id) VALUES($like_id,$post_id,$id)");
  			header("location:posts.php");
  		}else{
  			header("location:posts.php");
  		}
}