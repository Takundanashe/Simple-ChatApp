<?php 
    session_start();
    include_once("encrypt_decrypt.php");
    date_default_timezone_set("Asia/Kolkata");
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $date_desc="";
       $time="";
       
       $encrypt = new Encry_Decry();
       $result= $encrypt->encrypt($incoming_id);

       $date2="";
       $yesterday="";
       $today="";
       $yester="";
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
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
                            $date_desc="<span style='font-style:italic'>Today</span> ";

                        }else if($date2 == $yester) {
                            $date_desc="<span style='font-style:italic'>Yesterday</span>  ";
                         
                        }else if($date2 != $today && $date2 != $yester){
                            $date_desc="";
                            $time=date_format($date,"d/m/Y H:i");

                        }
                    }
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <a style="background-color:white;text-decoration:none;color:black;cursor:pointer" href="delete_msg.php?a='.$encrypt->encrypt($row["msg_unique_id"]).'&b='.($result).'"><i class="ri-delete-bin-6-line"></i></a><p>'. $row['msg'] .'<br>'.$date_desc.$time.'</p>
                                </div>
                                </div>';
                }else{
                    $output .= '<div class="chat incoming">
                                <img src="php/images/'.$row['img'].'" alt="">
                                <div class="details">
                                    <p>'. $row['msg'] .'<br>'.$date_desc.$time.'</p>
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