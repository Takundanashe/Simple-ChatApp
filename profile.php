<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
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
          <a style="color:#333" href="users.php"><img class="profile_image" src="php/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['fname']. " " . $row['lname'] ?></span></a>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
       
       <a style="text-decoration:none" class="toolbtn" href=""><i class="ri-account-circle-line"></i><br>
                My Profile
        </a>
        
        <a style="text-decoration:none" class="toolbtn" href="group_members.php"><i class="ri-group-fill"></i><br>
           Groups
        </a>
        <a style="text-decoration:none" href="posts.php" class="toolbtn"  href =""><i class="ri-gallery-upload-line"></i><br>
          Posts
        </a>
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>

      </header>
      <div class="row">
          <div class="column">
           <img src="php/images/<?php echo $row['img']?>" alt="" style="height: 150px;width:150px;border-radius:none !important;">
          </div>
          <div class="column">
             <span class="profile_details">Name: <?php echo $row['fname'] ." ".$row['lname']?><span>
            <br><br>
             <span class="profile_details">Email: <?php echo $row['email']?><span>
              <br><br>
              <a href="edit_profile.php" style="height: 40px;width: 150px;font-size:20px;color:white;cursor: pointer;text-decoration: none;background-color:#405d9b;border-radius: 4px;padding: 3px 5px ">Edit profile</a>
          </div>
      </div>    
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>
</html>
