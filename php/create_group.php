 
 
 <html>          
          <div>
            <form method="post" class="" id="create_group" enctype="multipart/form-data">
              <input type="text" id="group_input"  name="group_name" placeholder="Group name" required><br><br>
              <input type="password" id ="group_input"  name="group_password" placeholder="Password" required>
              <label for="file">Upload the group Icon</label>
              <input name= "image"type="file" required accept="image/*">
              <br><br><input id="group_submit" type="submit" value="Create">
            </form>
           <div>

           	<style type="text/css">
           		
           		 #group_input{
				    width: 400px;
				    height:30px;
				    border:1px #ccc solid;

				  }
				  #group_submit{
				    width:120px;
				    height:30px;
				    background-color:#405d9b;
				    color:white;
				    font-size:14px;
				    border-radius:4px;
				    border:none;
				  }
				  .hide{
				    display:none;

				  }
				  #create_group{
				    border:1px #ccc solid;
				    text-align:center;
				    padding:10px;

				  }
				  .gcontent{
				    border:1px #ccc solid;
				    padding:10px;
				    margin-top:5px;
				    border-radius:4px;
				  }
           	</style>
</html>

