<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>PimecBook</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            
            <input type="text" name="fname" placeholder="First name" required>
          </div>
          <div class="field input">
           
            <input type="text" name="lname" placeholder="Last name" required>
          </div>
        </div>
        <div class="field input">
      
          <input type="text" name="email" placeholder="Email" required>
        </div>
        <div class="field input">
          
          <input type="password" name="password" placeholder="Password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Signup">
        </div>
      </form>
      <hr class="sep"><br>
      <div class="link">
         <a href="login.php">
          <h1>Login now<h1>
        </a>
      </div>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

</body>
</html>
