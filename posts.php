<?php 
  session_start();
  date_default_timezone_set("Asia/Kolkata");
  
  include_once "php/config.php";
 
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }else{

      if($_SERVER['REQUEST_METHOD']=='POST') { 

        $outgoing_id = $_SESSION['unique_id'];
        $post_unique_id=rand(time(), 100000000);
        $post = mysqli_real_escape_string($conn, $_POST['posts']);
        if(isset($post)){

           $insert_query = mysqli_query($conn, "INSERT INTO posts (outgoing_post_id,post,img,post_unique_id)
                                  VALUES ({$outgoing_id}, '{$post}', '',$post_unique_id)") or die();

        }
            
                       
                       



        }
                        
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
            <span><?php echo $row['fname']. " " . $row['lname'] ?></span><a>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
       
       <a style="text-decoration:none" class="toolbtn" href="profile.php"><i class="ri-account-circle-line"></i><br>
                My Profile
        </a>
        
        <a style="text-decoration:none" class="toolbtn" href="group_members.php"><i class="ri-group-fill"></i><br>
           Groups
        </a>
        <a style="text-decoration:none" class="toolbtn"  href =""><i class="ri-gallery-upload-line"></i><br>
          Posts
        </a>
       
      </header>
    <div class="row">
          <div class="column">
           <img src="php/images/<?php echo $row['img']?>" alt="" style="height: 150px;width:150px;border-radius:none !important;">
           <br><br>
           <h1 style="color:#405d9b;font-size:16px;font-weight:600;">My Posts</h1>
           <!--my posts-->
           <br>
           <?php 
            $id=$_SESSION['unique_id'];
            $sql="SELECT * FROM posts WHERE outgoing_post_id='$id' order by post_id desc ";
            $result=mysqli_query($conn,$sql);
            if (mysqli_num_rows($result)>0){

              while($row = mysqli_fetch_assoc($result))
              {
                $uid=$row['outgoing_post_id'];
                $row2=mysqli_query($conn,"SELECT * FROM users WHERE unique_id = '$uid'");

                $query=mysqli_fetch_assoc($row2);
               
                include("get_posts.php");
              }
            }
             
          ?>
          
          </div>
          <div class="column">
            <div style="border: solid thin #aaa; padding: 10px ;background-color: white">
              <form method="post" class="txt_area" enctype="multipart/form-data">
                <textarea class="text_area" name="posts" placeholder="What's on your mind?"></textarea>
                <input id="post_button" type="submit" value="Post">
                <br>
                
              <form>
              
				  	</div>
            <br><br>

            <div style="width:400px !important "class="form-group container">
            <a style="color:#405d9b;font-size: 20px;text-decoration: none;" title="Post Image" href="post_image.php"><i class="ri-image-line"></i></a>
            

          <?php 
            $id=$_SESSION['unique_id'];
            $sql="SELECT * FROM posts WHERE outgoing_post_id!='$id' order by post_id desc ";
            $result=mysqli_query($conn,$sql);
            if (mysqli_num_rows($result)>0){

              while($row = mysqli_fetch_assoc($result))
              {
                $uid=$row['outgoing_post_id'];
                $row2=mysqli_query($conn,"SELECT * FROM users WHERE unique_id = '$uid'");

                $query=mysqli_fetch_assoc($row2);
               
                include("get_posts.php");
              }
            }
             
          ?>
          
      </div>  
     
       
    </section>
  </div>

  <script src="javascript/users.js"></script>
 <!-- <script src="javascript/post.js"></script>-->
  <script src="javascript/crop_image.js"></script>
  <script type="text/javascript">
	
</script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js"type="text/javascript">
</script>
</body>
</html>