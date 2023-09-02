<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div id="myOverlay" class="overlay">
  
  <div class="overlay-content">
    <div id="status"style="font-size:30px;color:white"></div>
  </div>
</div>
  <div class="wrapper">
    <section class="form login">
      <header>PimecBook</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <input id="email" type="text" name="email" placeholder="Email" required>
        </div>
        <div class="field input">
          
          <input id="password" type="password" name="password" placeholder="Password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Login">
        </div>
      </form>
      <hr class="sep"><br>
      <div class="link">
         <a href="index.php">
          <h1>Create New Account</h1>

        </a>
        
      </div>
    </section>
  </div>
  
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>
  <style type="text/css">
    
  /* The overlay effect with black background */
.overlay {
  height: 100%;
  width: 100%;
  display: none;
  position: fixed;
  z-index: 3;
  top: 0;
  left: 0;
  background-color: black;
}

/* The content */
.overlay-content {
  position: relative;
  top: 46%;
  width: 80%;
  text-align: center;
  margin-top: 30px;
  margin: auto;
}
  </style>

</body>
</html>
