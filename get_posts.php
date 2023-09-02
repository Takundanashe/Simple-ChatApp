<div id="post">
		<div>
			<?php
			  if ($row['img'] !="")
			  {
				$image = 'php/images/'.$row['img'];
				echo "<img src='$image.'height:'100px' width='100px' >"; 
			  }else{
				$image="";
			  }
			?>
			
             <br>
			<?php echo $row['post'] ?><br>
		</div>
	<div>
			<div style="font-weight: bold;color: #405d9b">
			<img src="<?php echo 'php/images/'.$query['img']?>" style="width: 30px;height:30px; margin-right: 4px;border-radius:50%;"><?php echo $query['fname']." ".$query['lname'] ;?>
			</div>
			<?php
				$cuid=$row['post_unique_id'];
				$sql4=mysqli_query($conn,"SELECT * FROM comments where post_id=$cuid");
				
					$result4=mysqli_num_rows($sql4);

					$sql0=mysqli_query($conn,"SELECT * FROM likes where post_unique_id=$cuid");
					$res= mysqli_num_rows($sql0);
				
			?>

		&nbsp;&nbsp;<a style="text-decoration: none" href="like_post.php?post_id=<?php echo $row['post_unique_id']?>"><?php echo $res." "?><i class="ri-thumb-up-line"></i>Like(s)</a>. <a style="text-decoration: none" href="post_comments.php?post_id=<?php echo $row['post_unique_id'];?>"><?php echo $result4." "; ?>Comment</a>. <span style="color: #999"></span>
        <?php
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
		
		 echo '<span style="font-style:italic">'.$date_desc.$time.'</span>';
		 
		?>
		 <br><br>
	</div>
</div>