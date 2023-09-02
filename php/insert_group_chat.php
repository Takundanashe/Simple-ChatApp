<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";

        $user_id = $_SESSION['unique_id'];
        $group_id = mysqli_real_escape_string($conn, $_POST['group_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        $notif=0;

        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO group_messages (message_unique_id,message, group_unique_id)
                                        VALUES ({$user_id}, '{$message}',{$group_id})") or die();
            $query =mysqli_query($conn,"SELECT * from groups where group_unique_id=$group_id");
            while($res=mysqli_fetch_assoc($query)){
                $x=$res['user_unique_id'];
                if($x===$user_id){
                    $notif=1;

                }else{
                    $notif=0;
                }
                $sql2=mysqli_query($conn,"INSERT INTO group_notifications (message_unique_id, group_unique_id, notification_status)
                    VALUES ({$x} ,{$group_id},{$notif})");

            }
            
        }
    }else{
        header("location: ../login.php");
    }


    
?>