<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Registration</title>
  <link rel="stylesheet" href="css/style.css" />
  <link href="css/registration.css" rel="stylesheet" type="text/css"/>
  <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
   rel = "stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
  <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script src="js/registration.js"></script>
</head>
<body class="registration">
<?php
	require('db.php');
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['username'])){
  		$username = stripslashes($_REQUEST['username']); // removes backslashes
  		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
  		$email = stripslashes($_REQUEST['email']);
  		$email = mysqli_real_escape_string($con,$email);
  		$password = stripslashes($_REQUEST['password']);
  		$password = mysqli_real_escape_string($con,$password);

      $mobile = stripslashes($_REQUEST['mobile']);
      $mobile = mysqli_real_escape_string($con,$mobile);


      $user_address = stripslashes($_REQUEST['user_address']);
      $user_address = mysqli_real_escape_string($con,$user_address);

      $user_city = stripslashes($_REQUEST['user_city']);
      $user_city = mysqli_real_escape_string($con,$user_city);

      if (!empty($_REQUEST['user_gender'])) {
        $user_gender = stripslashes($_REQUEST['user_gender']);
        $user_gender = mysqli_real_escape_string($con,$user_gender);
      }
      else {
        $user_gender = (!empty($user_gender)) ? $user_gender : '' ;
      }

      if (!empty($_REQUEST['user_dob'])) {
        $user_dob = stripslashes($_REQUEST['user_dob']);
        $user_dob = mysqli_real_escape_string($con,$user_dob);
      }
      else {
        $user_dob = (!empty($user_dob)) ? $user_dob : '' ;
      }

      if (!empty($_REQUEST['user_degree'])) {
        $user_degree = stripslashes($_REQUEST['user_degree']);
        $user_degree = mysqli_real_escape_string($con,$user_degree);
      }
      else {
        $user_degree = (!empty($user_degree)) ? $user_degree : '' ;
      }

  		$trn_date = date("Y-m-d H:i:s");
      $query = "INSERT into `users` (username, password, email, trn_date, mobile, user_address, user_city, user_dob, user_gender, user_degree) VALUES ('$username', '".md5($password)."', '$email', '$trn_date', '$mobile', '$user_address', '$user_city', '$user_dob', '$user_gender', '$user_degree')";
      $result = mysqli_query($con,$query);
      $uid = $con->insert_id;
      // Code for handling images or user picture.
      if (!empty($uid)) {
        $file_name = $_FILES['image']['name'];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
           // Insert record
           $query = "INSERT INTO images (name, image, uid)
              VALUES
              ('".$file_name."', '".$target_file."', '".$uid."' )";
           $query_new_file_insert = mysqli_query($con,$query);
           // Upload file
           move_uploaded_file($_FILES['image']['tmp_name'],$target_dir.$file_name);
        }
      }

      if($result){
          echo "<div class='form'><h3>You are registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
      }
    }else{
?>
<div class="form">
  <h1>Registration</h1>
  <form name="registration" id="registration" action="" method="post" enctype='multipart/form-data'>
    <div class="left">
      <input type="text" name="username" placeholder="Username" required />
      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Password" required />
      <input type="number" name="mobile" placeholder="Mobile Number" required />
      <textarea name="user_address" placeholder="Your Address" id="address" required></textarea>
      <div class="row-items">
        <span class="item-label">City:</span>
        <span class="item-input" >
          <select name="user_city">
            <option value="Pune" selected>Pune</option>
            <option value="Mumbai">Mumbai</option>
            <option value="Lohegaon">Lohegaon</option>
            <option value="Nagpur">Nagpur</option>
            <option value="Pimpri_Chinchwad">Pimpri Chinchwad</option>
            <option value="Nashik">Nashik</option>
            <option value="Amravati">Amravati</option>
          </select>
        </span>
      </div>
      <input type="text" name="user_dob" placeholder="Date of Birth" id="datepicker" required/>

      <div class="row-items radio-boxes">
        <span class="label-radio">Gender:</span>
        <span class="item-radio">
          <input type="radio" name="user_gender" value="Male"><span>Male</span>
          <input type="radio" name="user_gender" value="Female" checked><span>Female</span>
          <input type="radio" name="user_gender" value="Other"><span>Other</span>
        </span>
      </div>

      <div class="row-items">
        <span class="item-label">Qualification:</span>
        <span class="item-input">
        <select name="user_degree">
          <option value="Matriculation">Matriculation</option>
          <option value="Intermediate">Intermediate</option>
          <option value="Graduation" selected>Graduation</option>
          <option value="Post_Graduate">Post Graduate</option>
          <option value="Diploma">Diploma</option>
          <option value="B.Tech">B.Tech</option>
          <option value="Others">Others</option>
        </select>
        </span>
      </div>

      <input type="submit" name="submit" value="Register" />
    </div>

    <div class="right">
      <div class="row-items">
          <input type="file" name="image" id="image" class="image" required/>

          <div id="image_preview">
              <img src="#" id="image-preview" style="width: 200px; height: 200px;" /><br />
              <a id="image_remove" href="#">Remove</a>
          </div>
      </div>
  </div>
  </form>
</div>
<?php } ?>
</body>
</html>
