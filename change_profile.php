<?php
session_start();
	if(!isset($_SESSION['unique_id'])){
		header("location:login.php");

	}
	include_once("header.php");

?>
<body>
  <div class="container">
  		 <a style="padding: 5px;font-size: 16px" title="Back" href="javascript:void(0)" onclick='location.href="edit_profile.php"' class="back-icon"><i class="fas fa-arrow-left"></i></a>
  		<h1 class="text-center">
  			
  			Change Profile Image
  		</h1>
  	
         <div class="form-group container">
         	<label for="file">Upload Profile Image Filename:</label>

         	<input class="form-control" type="file" id="file-input" required accept="images/*">

         </div>
         <div class="box-2">
         	<div class="result">
         		
         	</div>
         </div>
         <div class="box-2 img-result hide">
         	<img src="" alt="" class="cropped">
         </div>
         <div class="box">
         	<div class="options hide">
         		<label for="width">Width</label>
         		<input type="number" class="img-w" value="300" max="1200" min="100">
         	</div>
         	<button class="btn save hide">Save</button>
         	<a href="" class="btn download hide">Upload</a>
         </div>
  </div>
</body>
<style type="text/css">
	.page{
		margin: 1em auto;
		max-width: 768px;
		display: flex;
		align-items: flex-start;
		flex-wrap: wrap;
		height: 100%;
	}
	.box{
		padding: 0.5em;
		width: 100%;
		margin: 0.5em;

	}
	.box-2{
		padding: 0.5em;
		width: calc(100%/2 - 1em);

	}
	.options label,.options input{
		width: 4em;
		padding: 0.5em 1em;

	}
	.btn{
		background-color: white;
		color: black;
		border: 1px solid black;
		padding: 0.5em 1em;
		text-decoration: none;
		margin: 0.8em 0.3em;
		display: inline-block;
		cursor: pointer;

	}
	.hide{
		display: none;
	}
	.img{
		max-width: 100%;
	}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js"type="text/javascript"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>	

<script type="text/javascript">
	$(document).ready(function(){
	let result = document.querySelector(".result"),
	img_result=document.querySelector(".img-result"),
	img_w=document.querySelector(".img-w"),
	img_h =document.querySelector(".img-h"),
	options=document.querySelector(".options"),
	save=document.querySelector(".save"),
	cropped=document.querySelector(".cropped"),
	dwn=document.querySelector(".download"),
	upload=document.querySelector("#file-input"),
	cropper="";
    var croppedx="";
	 $("#file-input").on('change',function(){
	 	const reader = new FileReader();
	 	reader.onload = function(event){
	 		if(event.target.result){
	 			//create new image
	 			//window.location="index.html";
	 			let img = document.createElement("img"); 
	 			img.id="image";
	 			img.src=event.target.result;
	 			//clean result before
	 			result.innerHTML ="";
	 			//append new image
	 			result.appendChild(img);
	 			//show save btn and options
	 			save.classList.remove("hide");
	 			options.classList.remove("hide");
	 			//init cropper
	 			cropper=new Cropper(img);

	 		}
	 	};
	 	reader.readAsDataURL(event.target.files[0]);

	 });
	 // save button-cropped image
	 $('.save').click(function(event){
	 	//get result to data url
	 	let imgSrc = cropper.getCroppedCanvas({
	 		width:img_w.value,// input value
	 	}).toDataURL();
	 	

	 	 console.log(imgSrc)
	 	 //remove hide class of img
	 	 cropped.classList.remove("hide");
	 	 img_result.classList.remove("hide");
	 	 //show cropped image
	 	 croppedx=imgSrc;
	 	 cropped.src=imgSrc;
	 	 dwn.classList.remove("hide");
	 	 //dwn.download="imagename.png";
	 	 //dwn.setAttribute("href",imgSrc);
	 	 
	 	
	 });
	 $('.download').click(function(e){
	 e.preventDefault()
	 		$.ajax({
	 			url:'upload.php',
	 			type:'POST',
	 			data:{image:croppedx},
	 			success:function(data){
	 				alert("Changed Successfully");
	 				window.location.href="edit_profile.php";
	 				
	 			}
	 		});	
	 	})

});
	 
	
</script>
<script type="text/javascript">
	 

</script>
</html>