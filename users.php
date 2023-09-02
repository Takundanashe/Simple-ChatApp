<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper_index">
    <section class="users">
      <header>
        
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <img src="php/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
       
       <a style="text-decoration:none" class="toolbtn" href="profile.php"><i class="ri-account-circle-line"></i><br>
                My Profile
        </a>
        
        <a style="text-decoration:none" class="toolbtn" href="group_members.php"><i class="ri-group-fill"></i><br>
           Groups
        </a>
        <a style="text-decoration:none" class="toolbtn"  href ="posts.php"><i class="ri-gallery-upload-line"></i><br>
          Posts
        </a>
      

      </header>
      <div class="search">
        <span class="text">Chats</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>
  <script type="text/javascript">
    
    

$(document).ready(function()
    {
        setInterval(notifications, 5000);
    }); 
    function notifications(view="")
    {
         

        $.ajax
        ({
            url: "php/notif.php",
            method:"GET",
            data:{view:view},
            dataType: "json",
            success: function(data) 
            {
              if(data.notif_count > 0)
                
                {
                  $( '#notif' ).replaceWith( data.unseen_notification );
                }

                
              }
            });

       }

  </script>
</body>
</html>
