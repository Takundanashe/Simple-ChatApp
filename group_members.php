<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
  if($_SERVER["REQUEST_METHOD"]=='POST'){
    $groupname=mysqli_real_escape_string($conn,$_POST['group_name']);
    $group_pass=mysqli_real_escape_string($conn,$_POST['group_password']);
    if(!empty($groupname) && !empty($group_pass)){
      $sql = mysqli_query($conn, "SELECT * FROM groups WHERE group_name = '{$groupname}'");
      if(mysqli_num_rows($sql) > 0){
          echo "$groupname - This email already exist!";
       }else{
        
         // print_r($x);
        
        //group_link
        
      
        $group_link ='pimecbook'.$groupname.$group_unique_id;
        
        if(isset($_FILES['image'])){
          $img_name = $_FILES['image']['name'];
          $img_type = $_FILES['image']['type'];
          $tmp_name = $_FILES['image']['tmp_name'];
          
          $img_explode = explode('.',$img_name);
          //here we want to extract the image extension
          $img_ext = end($img_explode);

          $extensions = ["jpeg", "png", "jpg"];
          if(in_array($img_ext, $extensions) === true){
              $types = ["image/jpeg", "image/jpg", "image/png"];
              if(in_array($img_type, $types) === true){
                  $time = time();
                  $new_img_name = $time.$img_name;
                  
                  if(move_uploaded_file($tmp_name,"php/images/".$new_img_name)){
              //        $ran_id = rand(time(), 100000000);
                    //  $status = "Active now";
                  
                      $encrypt_pass = md5($group_pass);
                  
                      $access = 1;
                      $id=$_SESSION['unique_id'];
      $insert_query = mysqli_query($conn, "INSERT INTO groups (group_unique_id, group_name, group_link, user_unique_id, password,access, group_icon)
                      VALUES ('$group_unique_id', '$groupname','$group_link', '$id', '$encrypt_pass', '$access', '$new_img_name')") or die("Error".mysqli_error());  
        
       }
     }
   }
} }}}
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
           <a title="Home" style="color:#333" href="users.php"><img src="php/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['fname']. " " . $row['lname'] ?></span></a>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
       
       <a style="text-decoration:none" class="toolbtn" href="profile.php"><i class="ri-account-circle-line"></i><br>
                My Profile
        </a>
        
        <a style="text-decoration:none" class="toolbtn" href=""><i class="ri-group-fill"></i><br>
           Groups
        </a>
        <a style="text-decoration:none" class="toolbtn"  href ="posts.php"><i class="ri-gallery-upload-line"></i><br>
          Posts
        </a>
      

      </header>
      <div class="search">
        <!--we will also show the number of groups-->
        <span class="text">Groups </span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="group-list">




      </div>
    </section>
  </div>

  <script src="javascript/groups.js"></script>
  
<script>
 
  let group_input = document.querySelector("#group_input"),
  group_submit =document.querySelector("#group_submit"),
  create_group=document.querySelector("#create_group")
   ;

  function creategroup(){
  create_group.classList.remove("hide");
  //group_submit.classList.remove("hide");

  }
</script>
<script>
 function openSearch() {
  document.getElementById("myOverlay").style.display = "block";
}


</script>
<script type="text/javascript">
   $(document).ready(function()
    {
        setInterval(notifications, 5000);
    }); 
    function notifications(view="")
    {
         

        $.ajax
        ({
            url: "php/group_notif.php",
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
<style>
  #group_input{
    width: 400px;
    height:30px;
    border:1px #ccc solid;

  }
  #group_submit{
    width:120px;
    height:30px;
    background-color:#405d9b;
    color:white;
    font-size:14px;
    border-radius:4px;
    border:none;
  }
  .hide{
    display:none;

  }
  #create_group{
    border:1px #ccc solid;
    text-align:center;
    padding:10px;

  }
  .gcontent{
    border:1px #ccc solid;
    padding:10px;
    margin-top:5px;
    border-radius:4px;
  }

  </style>
</body>
</html>
