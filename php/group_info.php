<?php

session_start();
include("config.php");
$output="";
$count="";
$rem="";
$change="";
if(!isset($_SESSION['unique_id'])){
	header("location:login.php");

}else{
	$group_id=$_POST['gid'];
	
	$sql=mysqli_query($conn,"SELECT * from groups where group_unique_id=$group_id");
	if(mysqli_num_rows($sql)>0){
		$count=mysqli_num_rows($sql);
		while($rows=mysqli_fetch_assoc($sql)){
			$idx=$_SESSION['unique_id'];
			$id=$rows['user_unique_id'];
			$query2=mysqli_query($conn,"SELECT * FROM users where unique_id=$idx");
			$result2=mysqli_fetch_assoc($query2);

			$sql2=mysqli_query($conn,"SELECT * FROM users where unique_id=$id");
			$query=mysqli_query($conn,"SELECT * FROM groups where group_unique_id=$group_id and user_unique_id=$idx");
			$result=mysqli_fetch_assoc($query);
			if ($result['access'] == 1){
				
				$change='<button onclick="showedit()" title="Edit group name"><i class="ri-edit-box-line"></i></button>';
				
					$rem='<a href="./remove_user.php?user='.$id.'&group_id='.$group_id.'"style="font-size:16px">Remove</a>';
				

			}else{
				
				$rem="";
				$change="";
			}
			
			$res=mysqli_fetch_assoc($sql2);
			if ($res['unique_id']==$idx){
				$rem="";
			}

			$output.='<img style="height: 50px;width: 50px" src="php/images/'.$res["img"].'">
                      <span style="font-size:14px">'.$res["fname"]." ".$res["lname"].'</span>
                      '.
                       $rem
                      .'
                      <br><br>';
		}

	}
	$data = array(
		'users' => $output,
	     'count' => $count ,
	     'change' =>$change);

	echo json_encode($data);
}