<?php
session_start();

//upload.php

if(isset($_POST["image"]))
{
	include_once("php/config.php");
	$id = $_SESSION['unique_id'];
	
	$data = $_POST["image"];

	
	$image_array_1 = explode(";", $data);

	

	$image_array_2 = explode(",", $image_array_1[1]);

	

	$data = base64_decode($image_array_2[1]);

	$imageName = time() . '.png';
	$post_unique_id=rand(time(), 100000000);
	//$folder="uploads/";
	 				//create folder
	 				//if(!file_exists($folder))
	 			//	{
	 			//		mkdir($folder,0755,true);
	 			//	}

	file_put_contents('php/images/'.$imageName, $data);
	if (isset($_POST['caption'])){
		$cap=$_POST['caption'];
		$insert_query = mysqli_query($conn, "INSERT INTO posts (outgoing_post_id,post,img,post_unique_id)
                        VALUES ({$id}, '{$cap}', '{$imageName}',$post_unique_id)") or die();

	}else{
 		$insert_query = mysqli_query($conn, "INSERT INTO posts (outgoing_post_id,post,img,post_unique_id)
                        VALUES ({$id}, '', '{$imageName}',$post_unique_id)") or die();
	}

	
  
	echo '<img src="'.$imageName.'" class="img-thumbnail" />';
	echo $imageName;

}

?>