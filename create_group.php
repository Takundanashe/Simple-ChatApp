<?php
session_start();

//upload.php

if(isset($_POST["image"]) and isset($_POST['groupname']) and isset($_POST['password']))
{include_once("php/config.php");

  $groupname=mysqli_real_escape_string($conn,$_POST['groupname']);
  $password= mysqli_real_escape_string($conn,$_POST['password']);

		$id = $_SESSION['unique_id'];
	
	$data = $_POST["image"];

	
	$image_array_1 = explode(";", $data);

	

	$image_array_2 = explode(",", $image_array_1[1]);

	

	$data = base64_decode($image_array_2[1]);

	$imageName = time() . '.png';
	$group_unique_id = rand(time(), 100000000);
	//$folder="uploads/";
	 				//create folder
	 				//if(!file_exists($folder))
	 			//	{
	 			//		mkdir($folder,0755,true);
	 			//	}


      $sql1 = mysqli_query($conn, "SELECT * FROM groups WHERE group_name = '{$groupname}'");
      if(mysqli_num_rows($sql1) > 0){
          echo "$groupname - This email already exist!";
       }else{
                  
          	file_put_contents('php/images/'.$imageName, $data);
          $group_link ='pimecbook'.$groupname.$group_unique_id;
           $encrypt_pass = md5($password);
           $access = 1;
          $id=$_SESSION['unique_id'];
            $insert_query = mysqli_query($conn, "INSERT INTO groups (group_unique_id, group_name, group_link, user_unique_id, password,access, group_icon)
                                VALUES ('$group_unique_id', '$groupname','$group_link', '$id', '$encrypt_pass', '$access', '$imageName')") or die("Error".mysqli_error()); 

    }
}
?>