<?php /* Template Name: contact-us */ ?>

<?php get_header(); ?>

  <div class="container">    
  
    <form id="myform" method="post" enctype="multipart/form-data">
      
      <label for="username">Username:</label>
      <input type="text" id="username" name="username">
      <span id= "username-error" style= "color:red;"></span>
      <br><br>      

      <label for="email">Email:</label>
      <input type="text" id="email" name="email">
      <span id= "email-error" style= "color:red;"></span>
      <br><br>    

      <label>Gender:</label>
      <input type="radio" id="male" name="gender" value="male"> Male
      
      <input type="radio" id="female" name="gender" value="female"> Female
      <span id= "gender-error" style= "color:red;"></span>
      <br><br>

      <label for="mobile">Mobile Number:</label>
      <input type="number" id="mobile" name="mobile" >
      <span id= "number-error" style= "color:red;"></span>
      <br><br>


      <label>Hobbies:</label>
      <input type="checkbox" id="hobby1" name="hobbies[]" value="reading"> Reading 
      
      <input type="checkbox" id="hobby2" name="hobbies[]" value="travelling"> Travelling
      
      <input type="checkbox" id="hobby3" name="hobbies[]" value="sports"> Sports
      
      <span id= "hobbies-error" style= "color:red;"></span>
      <br><br>
      

      <label for="profile-image">Profile Image:</label>
      <input type="file" id="profile_image" name="profile_image">
      <span id= "image-error" style= "color:red;"></span>
      <br><br>

      <input type = "submit" value= "Submit" id= "submit_button">
      
    </form>
  </div>

<?php get_footer(); ?>