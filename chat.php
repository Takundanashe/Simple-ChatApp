<?php 
  session_start();
  include_once "php/config.php";
  include_once("php/encrypt_decrypt.php");
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");

  }
  $idx=$_SESSION['unique_id'];
  $sql2=mysqli_query($conn,"UPDATE messages set msg_status=1 where msg_status=0 and incoming_msg_id=$idx");
  $decrypt=new Encry_Decry();
?>
<?php include_once "header.php"; ?>
 
<body>
 

  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php 
      
          $userx_id = mysqli_real_escape_string($conn, $_GET['o']);
          $user_id=$decrypt->decrypt($userx_id);
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
        <a href="javascript:void(0)" onclick='location.href="users.php"' class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img  src="php/images/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>

      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <span id="emoji" style="font-size: 25px;cursor: pointer;"><i class="ri-emotion-happy-line"></i></span>
        
        <input id="emojix" type="text" name="message" class="input-field"  placeholder="Type a message here..." autocomplete="off">
      </span>
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chats.js"></script>
 <script type="text/javascript">
   $(document).ready(function()
    {
        setInterval(notifications, 500);
    }); 
    function notifications()
    {
         

        $.ajax
        ({
            url: "php/chat_notif.php",
            method:"POST",
            success: function(data) 
            {
             
                
             } 
            });

       }
     

 </script>

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
