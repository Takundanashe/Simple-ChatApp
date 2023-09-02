<?php
date_default_timezone_set("Asia/Kolkata");
  $notif="";
  $idd=$_SESSION['unique_id'];
   $sql=mysqli_query($conn,"SELECT * FROM messages where msg_status=0 and incoming_msg_id=$idd");
    $res =mysqli_num_rows($sql);
     $date_desc="";
       $time="";
       $date2="";
       $yesterday="";
       $today="";
       $yester="";
       $encrypt = new Encry_Decry();
       
    if ($res>0){
        $notif='<span style="background-color:#405d9b;color:white;padding:8px 10px;border-radius:50%;">'.$res.'</span>';
    }else{
        $notif="";

    }
    while($row = mysqli_fetch_assoc($query)){
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        if(isset($row2['date'])){
                        $date= date_create( $row2['date']) ;
                        $time= date_format($date,"H:i");
                        $date2 =date_format($date,"d/m/Y");
                        
                       $today=date("d/m/Y");
                    
                       $yesterday=new DateTime('yesterday');
                       
                       $yester= $yesterday->format('d/m/Y');
                      
                        if($date2==$today){
                            $date_desc="<span style='font-style:italic;font-size:12px'>Today</span> ";

                        }else if($date2 == $yester) {
                            $date_desc="<span style='font-style:italic;font-size:12px'>Yesterday</span> ";
                         
                        }else if($date2 != $today && $date2 != $yester){
                            $date_desc="";
                            $time=date_format($date,"d/m/Y H:i");

                        }
                    }
        (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available";
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        if(isset($row2['outgoing_msg_id'])){
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
        }else{
            $you = "";
        }
        ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
        ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";

        $output .= '<a style="text-decoration:none" href="chat.php?o='.$encrypt->encrypt($row['unique_id'] ).'">
                    <div  class="content">
                    <span style="position:relative;width:40px;height:40px;" >
                    <img src="php/images/'. $row['img'] .'" alt="">
                     <div style="right:0;bottom:0;position:absolute;"class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                     </span>
                    <div class="details">
                        <span>'. $row['fname']. " " . $row['lname'] .'</span>
                        <p>'. $you . $msg .'&nbsp;&nbsp;&nbsp'.$date_desc.$time.'</p>
                    </div>

                    </div>
                     
                    <span id="notif" >
                    
                      '.$notif.'

                     
                    </span>
                                      
                </a>';
    }
?>