
<?php 
	session_start();
    include_once "php/config.php";
    if(!isset($_SESSION['unique_id'])){
      header("location: login.php");
    }
	$result="";
	$id="";
	$post_img="";
    $time="";
	$date="";
	$date2="";
	$time2="";
    $num_of_comments="";

	$post_id = mysqli_real_escape_string($conn, $_GET['post_id']);
     $sql=mysqli_query($conn,"SELECT * FROM posts where post_unique_id=$post_id");
	if(mysqli_num_rows($sql)>0){
		$result=mysqli_fetch_assoc($sql);
		$id=$result['outgoing_post_id'];
		$sql2=mysqli_query($conn,"SELECT * FROM users where unique_id= $id");
		$username=mysqli_fetch_assoc($sql2);

	}
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		if(!empty($_POST['comment_text'])){
			$comment=$_POST['comment_text'];
			$comment_id = rand(time(),100000000);
			$user_id=$_SESSION['unique_id'];
			$query=mysqli_query($conn,"INSERT INTO comments(comment_unique_id,post_id,user_unique_id,comment) VALUES($comment_id,$post_id,$user_id,'$comment')");

		}

	}
	$query2=mysqli_query($conn,"SELECT * FROM comments where post_id=$post_id");
	$num_of_comments=mysqli_num_rows($query2);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PimecBook | Posts-Comments</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
<div class="container">
  <div class="row">
    <div style="padding:10px 20px;" class="col-md-6 col-md-offset-3 post">

	<a style="font-size:24px;color:#333;text-decoration:none"href="posts.php" class="back-icon"><i class="ri-arrow-left-line"></i></a>
     <img style="width:50px;height:50px;border-radius:50%;" src="php/images/<?php echo $username['img']?>">
	<span style="font-size:24px;padding-left:10px"><?php echo $username['fname']." ".$username['lname']?></span>
      <p style="padding-left:20px;font-size:17px"><?php echo $result['post']?></p>
	  <?php 
		if($result['img'] != ""){
			$post_img = "<img style='padding-left:20px' src='php/images/".$result['img']."' class='profile_pic'>";
		}
		echo $post_img;
	  ?>
	  <br>
	  <?php
         $post_date=date_create($result['date']);
		 $time= date_format($post_date,"h:i a");
		 $date=date_format($post_date,"d M y");


	  ?>
	  <span style="padding-left:20px;color:#7a7a7a"><?php echo $time ." . ".$date?></span>
    </div>

    <!-- comments section -->
    <div class="col-md-6 col-md-offset-3 comments-section">
      <!-- comment form -->
      <form class="clearfix" method="post" id="comment_form">
        <h4>Post a comment:</h4>
        <textarea name="comment_text" id="comment_text" class="form-control" cols="30" rows="3"></textarea>
        <button class="btn btn-primary btn-sm pull-right" id="submit_comment">Submit comment</button>
      </form>

      <!-- Display total number of comments on this post  -->
      <h2><span id="comments_count"><?php echo $num_of_comments?></span> Comment(s)</h2>
      <hr>
      <!-- comments wrapper -->
      <div id="comments-wrapper">
         <div class="comment clearfix">
           <?php
            $query3=mysqli_query($conn,"SELECT * FROM comments where post_id=$post_id order by comment_id DESC");
			if(mysqli_num_rows($query3)>0){
				while($row=mysqli_fetch_assoc($query3)){
                 $comenta_id=$row['user_unique_id'];
				 //get username n pic of commenter
				 $sql3=mysqli_query($conn,"SELECT * FROM users where unique_id=$comenta_id");
				 $row2=mysqli_fetch_assoc($sql3);
				$posted_at=date_create($row['date']);
				$date2=date_format($posted_at,"M d, Y");
				$time2=date_format($posted_at,"h:i a");

                include("comments.php");
             

				}
			}

			?>
          
      </div>
      <!-- // comments wrapper -->
    </div>
    <!-- // comments section -->
  </div>
</div>

<!-- Javascripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Bootstrap Javascript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style type="text/css">
  form button { margin: 5px 0px; }
textarea { display: block; margin-bottom: 10px; }
/*post*/
.post { border: 1px solid #ccc; margin-top: 10px; }
/*comments*/
.comments-section { margin-top: 10px; border: 1px solid #ccc; }
.comment { margin-bottom: 10px; }
.comment .comment-name { font-weight: bold; }
.comment .comment-date {
  font-style: italic;
  font-size: 0.8em;
}
.comment .reply-btn, .edit-btn { font-size: 0.8em; }
.comment-details { width: 91.5%; float: left; }
.comment-details p { margin-bottom: 0px; }
.comment .profile_pic {
  width: 35px;
  height: 35px;
  margin-right: 5px;
  float: left;
  border-radius: 50%;
}
/*replies*/
.reply { margin-left: 30px; }
.reply_form {
  margin-left: 40px;
  display: none;
}
#comment_form { margin-top: 10px; }
</style>
</body>
</html>
<!-- Javascripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Bootstrap Javascript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style type="text/css">
	form button { margin: 5px 0px; }
textarea { display: block; margin-bottom: 10px; }
/*post*/
.post { border: 1px solid #ccc; margin-top: 10px; }
/*comments*/
.comments-section { margin-top: 10px; border: 1px solid #ccc; }
.comment { margin-bottom: 10px; }
.comment .comment-name { font-weight: bold; }
.comment .comment-date {
	font-style: italic;
	font-size: 0.8em;
}
.comment .reply-btn, .edit-btn { font-size: 0.8em; }
.comment-details { width: 91.5%; float: left; }
.comment-details p { margin-bottom: 0px; }
.comment .profile_pic {
	width: 35px;
	height: 35px;
	margin-right: 5px;
	float: left;
	border-radius: 50%;
}
/*replies*/
.reply { margin-left: 30px; }
.reply_form {
	margin-left: 40px;
	display: none;
}
.replyform:focus{
	outline:none;
}
#comment_form { margin-top: 10px; }
</style>


	
</script>
</body>
</html>