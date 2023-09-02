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
	
	//$folder="uploads/";
	 				//create folder
	 				//if(!file_exists($folder))
	 			//	{
	 			//		mkdir($folder,0755,true);
	 			//	}

	file_put_contents('php/images/'.$imageName, $data);

	$sql =mysqli_query($conn,"UPDATE users SET img ='$imageName' where unique_id=$id");

	echo '<img src="'.$imageName.'" class="img-thumbnail" />';
	echo $imageName;

}

?>