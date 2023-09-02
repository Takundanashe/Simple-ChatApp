<?php 
    session_start();
    date_default_timezone_set("Asia/Kolkata");
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $user_id = $_SESSION['unique_id'];
       $date_desc="";
       $time="";
       $date2="";
       $yesterday="";
       $today="";
       $yester="";

        $group_id = mysqli_real_escape_string($conn, $_POST['group_id']);
        $output = "";
        $sql = "SELECT * FROM group_messages where group_unique_id=$group_id ORDER BY message_id";
        $query = mysqli_query($conn, $sql);

        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                   if(isset($row['date'])){
                        $date= date_create( $row['date']) ;
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
                
                if($row['message_unique_id'] === $user_id){
                    
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['message'] .'<br>'.$date_desc.$time.'</p>

                                </div>
                                </div>';

                }else{
                    $muid=$row['message_unique_id'];
                    $sql2 =mysqli_query($conn,"SELECT * FROM users where unique_id=$muid");
                    $result=mysqli_fetch_assoc($sql2);
                    $output .= '<div class="chat incoming">
                                <img src="php/images/'.$result['img'].'" alt="">
                                <div class="details">
                                     <p>'. $row['message'] .'<br>'.$date_desc.$time.'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }


?>