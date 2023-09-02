<?php 
  session_start();
  include_once "php/config.php";
  include_once "php/encrypt_decrypt.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
  $decrypt = new Encry_Decry();

  $group_id="";
  $group_idx="";
?>
<?php include_once "header.php"; ?>
 
<body>
 

  <div class="wrapper">
    
      <header style="padding: 20px"> 

        <?php 
        $user_id=$_SESSION['unique_id'];
          $group_idx = mysqli_real_escape_string($conn,$_GET['a']);
          $group_id=$decrypt->decrypt($group_idx);

          $sql = mysqli_query($conn, "SELECT * FROM groups WHERE user_unique_id =$user_id AND group_unique_id=$group_id");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
        
          }else{
            header("location: group_members.php");
          }
        ?>
        <a style="font-size: 20px" href="group.php?s=<?php echo $group_idx?>" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        
        <div style="text-align: center;">
          <center><img style="height: 150px;width: 150px;" src="php/images/<?php echo $row['group_icon']; ?>" alt=""></center>
          <br>
          <span><?php echo $row['group_name'] ?></span> <span id="changebtn"></span><br>
         <form class="hide"id="changename">
           <input class="groupname" type="text" name="groupname" placeholder="Enter new Group name here" title="Edit Group name">
           <button style="background-color: #405d9b;color: white;border:none;border-radius: 4px;" type="submit" >Save</button>
         </form>
    
        </div>
      </header>
      <div style="padding-left: 30px;font-size: 20px">
        <span style="font-size: 16px" id="count"></span> <span  style="font-size: 16px">Participants</span> 
        <div id="participants">
          
        </div>
      </div>

      <div style="padding-left: 30px;padding-bottom: 15px">
        
        <button type="button" title="Exit group" style="background-color: white;color:black;font-size: 14px;border:none;">Exit Group</button>
      </div>

  <script>
    
$(document).ready(function()
    {
        setInterval(group_info, 500);
    }); 
    function group_info()
    {
         

        $.ajax
        ({
            url: "php/group_info.php",
            method:"POST",
           cache:false,
            data:{gid:<?php echo $group_id?>},
            dataType: "json",
            success: function(data) 
            {
              $('#participants').html(data.users);
                $('#count').html(data.count);
                $('#changebtn').html(data.change);
              }
            });

       }
    

  </script>
  <script type="text/javascript">
    function showedit(){
      let form_edit=document.querySelector('#changename');
      form_edit.classList.remove("hide");

    }
  </script>

<script type="text/javascript">
  
$('#changename').on('submit', function(event){
  event.preventDefault();
  if($('.groupname').val() != '')
  {
   
    var groupname = $('.groupname').val();
   $.ajax({
    url:"php/change_group_name.php",
    method:"POST",
    data:{id:<?php echo $group_id;?>,groupname},
    success:function(data)
    {
     $('#changename')[0].reset();
      
    }
   });
  }
  else
  {
   alert("The field is Empty!");
  }
 });

</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("button").click(function(){

            $.ajax({
                type: 'POST',
                url: 'php/delete_group_member.php',
                data:{id:<?php echo $group_id?>},
                success: function(data) {
                   window.location='group.php?s=<?php echo $group_idx?>';

                }
            });
   });
});
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
  .groupname{
    border:none;
    border-bottom: 1px #a9a9a9 solid;

  }
  .groupname:focus{
    outline: none;
  }
</style>
</html>
