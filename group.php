<?php 
  session_start();
  include_once "php/encrypt_decrypt.php";

  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
  $group_id=" ";
  $decrypt = new Encry_Decry();


?>
<?php include_once "header.php"; ?>
 
<body>
 

  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php 
        $user_id=$_SESSION['unique_id'];
          $group_idx = mysqli_real_escape_string($conn,$_GET['s']);
          $group_id=$decrypt->decrypt($group_idx);

          $sql2s=mysqli_query($conn,"UPDATE group_messages set msg_status=1 where msg_status=0 and message_unique_id!=$user_id and group_unique_id=$group_id");
          $sql = mysqli_query($conn, "SELECT * FROM groups WHERE user_unique_id =$user_id AND group_unique_id=$group_id");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
        
          }else{
            header("location: group_members.php");
          }
        ?>
        <a href="group_members.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img  src="php/images/<?php echo $row['group_icon']; ?>" alt="">
        <a href="group_info.php?a=<?php echo $decrypt->encrypt($group_id)?>" style="text-decoration: none;cursor: pointer;" title="Group Info"><div class="details">
          <span><?php echo $row['group_name'] ?></span><br>
         <!--here im listing members of the group-->
          <?php 

            $sql2=mysqli_query($conn,"SELECT * FROM groups where group_unique_id =$group_id order by group_id DESC Limit 5 ");
            if(mysqli_num_rows($sql2)>0){
              
              while($row2 = mysqli_fetch_assoc($sql2))
              {
                $val='';
                $id=$row2['user_unique_id'];
                if($row2['access']==1){
                  $val = ' Admin:';
                }
                
                $sql3=mysqli_query($conn,"SELECT * FROM users where unique_id=$id");
                $result2=mysqli_fetch_assoc($sql3);
                echo '<span style="font-size:12px;">'.$val.' '.$result2['fname']." ".$result2['lname'].",".'</span>';
              }
            }
          ?>
        </div></a>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="group_id" name="group_id" value="<?php echo $group_id; ?>" hidden>
        <span id="emoji" style="font-size: 25px;cursor: pointer;"><i class="ri-emotion-happy-line"></i></span>
        <input id="emojix" type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/group.js"></script>

</body>
<style type="text/css">
  #header{
    height: 80px;
    background-color: #405d9b;
    width: 100%;
    font-family: tahoma;
    font-size: 30px;
    color: white;
  }
</style>
<script type="text/javascript">
  
  $(document).ready(function()
    {
        setInterval(notifications, 500);
    }); 
    function notifications()
    {
         var group_id="";

        $.ajax
        ({
            url: "php/group_notif_update.php",
            method:"POST",
            data:{group_id:<?php echo $group_id?>},
            success: function(data) 
            {
             
                
             } 
            });

       }
     

</script>
<script>
        var margin = 10,
            
             instance3 = new emojiButtonList( "emoji", {
                dropDownXAlign: "center",
                dropDownYAlign: "top",
                textBoxID: "emojix",
                yAlignMargin: margin,
                xAlignMargin: margin
            } );

        function emojiClickEvent( emojiText ) {
            document.title += " " + emojiText;
        }
    </script>
</html>
