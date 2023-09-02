
           <?php 
           include_once "encrypt_decrypt.php";
           $encrypt = new Encry_Decry();
           date_default_timezone_set('Asia/Kolkata');
            $notif="";
            $resx="";
            $idd=$_SESSION['unique_id'];
            
              $id=$_SESSION['unique_id'];
                $today="";
                $msg ="";
                $time="";
                $date2="";
                $yesterday="";
                $date_desc="";
                $yester="";
              $sql="SELECT * FROM groups WHERE user_unique_id='$id' order by group_id desc ";
              $result=mysqli_query($conn,$sql);
              if (mysqli_num_rows($result)>0){
                $num_of_groups = mysqli_num_rows($result);
                  //selecting the last message in the group
                  //correct here its displaying users' last message not group last
                  
                
                while($row = mysqli_fetch_assoc($result))
                {
                  $id =$_SESSION['unique_id'];
                    $groupid =$row['group_unique_id'];
                    $sqlx=mysqli_query($conn,"SELECT * FROM group_notifications where notification_status=0 and group_unique_id=$groupid and message_unique_id=$id");
                   $resx =mysqli_num_rows($sqlx);
                    $sql2 = "SELECT * FROM group_messages where group_unique_id=$groupid ORDER BY message_id DESC LIMIT 1";
                  $row2=mysqli_query($conn,$sql2);
                   if(mysqli_num_rows($row2)>0){
                    $query=mysqli_fetch_assoc($row2);
                  
                    if(isset($query['message_unique_id'])){
                        $msg_uid=$query['message_unique_id'];
                        $sql3 =mysqli_query($conn,"SELECT * FROM users where unique_id = $msg_uid");
                        if(mysqli_num_rows($sql3)>0){
                            $result2=mysqli_fetch_assoc($sql3);
                        }
                   

                    }
                
                    $msg="There are no messages in this groups";
                    if ($query['message']!=""){
                         $msg=$query['message'];
                    }
                    if(isset($query['date'])){
                        $date= date_create( $query['date']) ;
                        $time= date_format($date,"H:i");
                        $date2 =date_format($date,"d/m/Y");
                        
                       $today=date("d/m/Y");
                      
                       $yesterday=new DateTime('yesterday');
                       
                       $yester= $yesterday->format('d/m/Y');
                      
                        if($date2==$today){
                            $date_desc="Today ";

                        }else if($date2 == $yester) {
                            $date_desc="Yesterday ";
                         
                        }else if($date2 != $today && $date2 != $yester){
                            $date_desc="";
                            $time=date_format($date,"d/m/Y H:i");

                        }
                    }
                }
                   
                    $you="";
                    $id =$_SESSION['unique_id'];
                    if (isset($result2['unique_id'])){
                        if ($result2['unique_id']!=$id){
                            $you=$result2['fname']." ".$result2['lname'].": ";
                        }else{
                            $you="You: ";
                        }
                    }
                
                      if ($resx>0){
                          $notif='<span style="background-color:#405d9b;color:white;padding:8px 10px;border-radius:50%;">'.$resx.'</span>';
                      }else{
                          $notif="";

                      }
                    $output .= '<a style="text-decoration:none" href="group.php?s='. $encrypt->encrypt($row['group_unique_id']) .'">
                    <div class="gcontent">
                    <img src="php/images/'. $row['group_icon'] .'" alt="">
                    <div class="details">
                        <span>'. $row['group_name']. '</span><br>
                        
                        <span style=font-size:12px;color:#A9A9A9;>'.$you.$msg.'</span>
                        <span style="font-size:12px;color:#A9A9A9;font-style:italic">'.$date_desc.$time.'</span>
                        
                        <span style="float:right">
                          '.$notif.'
                        <span>

                    </div>
                    </div>
                </a>';
                 
               
                }

              }
               
            ?>
           
    
                    