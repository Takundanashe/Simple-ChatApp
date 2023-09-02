<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
	header("location:login.php");
}
include_once("header.php");
include_once("php/config.php");

if ($_SERVER['REQUEST_METHOD']=='POST'){
  $id=$_SESSION['unique_id'];
  $fname=$_POST['fname'];

  $lname=$_POST['lname'];
  $oldpass=$_POST['password'];
  $email=$_POST['email'];
  $new_password=$_POST['new_password'];
  $con_password=$_POST['con_password'];
  $sqlq=mysqli_query($conn,"SELECT * FROM users WHERE unique_id=$id");
  $result=mysqli_fetch_assoc($sqlq);

  if($fname!=="" && $lname!=="" && $email!=="" && $oldpass!=="" && $new_password!=="" && $con_password!=="" ){
    if(md5($oldpass)===$result['password']){
      if($new_password===$con_password){
        if($new_password==$oldpass){
           echo '<script>alert("New password cannot be equal to old password")</script>';
        }else{
        $xpass=md5($con_password);

        $sqlqq=mysqli_query($conn,"UPDATE users SET fname='$fname', lname='$lname',email='$email',password='$xpass' WHERE unique_id=$id");
        echo '<script>alert("Updated Successfully")</script>';
        }
      }else{
        echo '<script>alert("Passwords do not match")</script>';
      }
      
    }else{
      echo '<script>alert("Old Password is incorrect")</script>';
    }
  }elseif ($fname!=="" && $lname==="" && $email!=="" && $oldpass!=="" && $new_password!=="" && $con_password!=="" ) {
    # code...
    if(md5($oldpass)===$result['password']){
      if($new_password===$con_password){
        if($new_password==$oldpass){
           echo '<script>alert("New password cannot be equal to old password")</script>';
        }else{
        $xpass=md5($con_password);

        $sqlqq=mysqli_query($conn,"UPDATE users SET fname='$fname',email='$email',password='$xpass' WHERE unique_id=$id");
        echo '<script>alert("Updated Successfully")</script>';
        }
      }else{
        echo '<script>alert("Passwords do not match")</script>';
      }
      
    }else{
      echo '<script>alert("Old Password is incorrect")</script>';
    }
  }elseif($fname==="" && $lname!=="" && $email!=="" && $oldpass!=="" && $new_password!=="" && $con_password!=="" ) {
    # code...
    if(md5($oldpass)===$result['password']){
      if($new_password===$con_password){
        if($new_password==$oldpass){
           echo '<script>alert("New password cannot be equal to old password")</script>';
        }else{
        $xpass=md5($con_password);

        $sqlqq=mysqli_query($conn,"UPDATE users SET lname='$lname',email='$email',password='$xpass' WHERE unique_id=$id");
        echo '<script>alert("Updated Successfully")</script>';
        }
      }else{
        echo '<script>alert("Passwords do not match")</script>';
      }
      
    }else{
      echo '<script>alert("Old Password is incorrect")</script>';
    }
 }elseif ($fname!=="" && $lname==="" && $email!=="" && $oldpass!=="" && $new_password!=="" && $con_password!=="" ) {
    # code...
    if(md5($oldpass)===$result['password']){
      if($new_password===$con_password){
        if($new_password==$oldpass){
           echo '<script>alert("New password cannot be equal to old password")</script>';
        }else{
        $xpass=md5($con_password);

        $sqlqq=mysqli_query($conn,"UPDATE users SET fname='$fname',email='$email',password='$xpass' WHERE unique_id=$id");
        echo '<script>alert("Updated Successfully")</script>';
        }
      }else{
        echo '<script>alert("Passwords do not match")</script>';
      }
      
    }else{
      echo '<script>alert("Old Password is incorrect")</script>';
    }
  }elseif ($fname==="" && $lname==="" && $email!=="" && $oldpass!=="" && $new_password!=="" && $con_password!=="" ) {
    # code...
    if(md5($oldpass)===$result['password']){
      if($new_password===$con_password){
        if($new_password==$oldpass){
           echo '<script>alert("New password cannot be equal to old password")</script>';
        }else{
        $xpass=md5($con_password);

        $sqlqq=mysqli_query($conn,"UPDATE users SET email='$email',password='$xpass' WHERE unique_id=$id");
        echo '<script>alert("Updated Successfully")</script>';
        }
      }else{
        echo '<script>alert("Passwords do not match")</script>';
      }
      
    }else{
      echo '<script>alert("Old Password is incorrect")</script>';
    }
  }elseif ($fname==="" && $lname==="" && $email==="" && $oldpass!=="" && $new_password!=="" && $con_password!=="" ) {
    # code...
    if(md5($oldpass)===$result['password']){
      if($new_password===$con_password){
        if($new_password==$oldpass){
           echo '<script>alert("New password cannot be equal to old password")</script>';
        }else{
        $xpass=md5($con_password);

        $sqlqq=mysqli_query($conn,"UPDATE users SET password='$xpass' WHERE unique_id=$id");
        echo '<script>alert("Updated Successfully")</script>';
        }
      }else{
        echo '<script>alert("Passwords do not match")</script>';
      }
      
    }else{
      echo '<script>alert("Old Password is incorrect")</script>';
    }
  }

}
?>
<body>
	<div class="wrapper_index2">

    <section class="users">
      <header>
        
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <a style="padding: 5px;font-size: 16px" title="Back" href="javascript:void(0)" onclick='location.href="profile.php"' class="back-icon"><i class="fas fa-arrow-left"></i></a>
            
          <a style="color:#333" href="users.php"><img class="profile_image" src="php/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['fname']. " " . $row['lname'] ?></span></a>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
       
       
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>

      </header>
      <div class="row">
          <div class="column">
           <img src="php/images/<?php echo $row['img']?>" alt="" style="height: 150px;width:150px;border-radius:none !important;">
           <br><br>
           <a style="text-decoration: none; color: white;background-color: #405d9b;padding: 4px;border: none;border-radius: 3px;cursor: pointer;" href="change_profile.php">Change Image</a>
          </div>
          <div class="column">
          	<form method="post" enctype="multipart/form-data">
          		<label for="fname" >Firstname: </label>
          		<input class="p_inputs" type="text" name="fname" placeholder="<?php echo $row['fname']?>" >
          		<br>
          		<br>
          		<label for="lname">Lastname: </label>
          		<input class="p_inputs" type="text" name="lname" placeholder="<?php echo $row['lname']?>">
              <br><br>
              <label for="email">Email: </label>
              <input class="p_inputs" type="text" name="email" placeholder="<?php echo $row['email']?>">
              <br><br>
              <label for="Password">Old Password: </label>
              <input type="Password" class="p_inputs" name="password">
              <br><br>
              <label for="new_password">New Password: </label>
              <input class="p_inputs" type="Password" name="new_password">
              <br><br>
              <label for="con_password">Confirm Password: </label>
              <input type="Password" name="con_password" class="p_inputs">
              <br>
              <input class="btn_submit" type="submit" name="btn_submit" value="Update">
          	</form>
            
          </div>
          <!--nnnn:focus{outline:none}-->
      </div>    
    </section>
  </div>

  <script src="javascript/users.js"></script>
<style type="text/css">
	.p_inputs{
		border:none;
		border-bottom: 1px #ccc solid;
    width: 200px;

	}
	.p_inputs:focus{
		outline: none;
	}
  .btn_submit{
    float: right;
    background-color: #405d9b;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 4px 5px;

  }
</style>
</body>
</html>
