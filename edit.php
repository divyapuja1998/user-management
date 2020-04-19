<?php
  require('db.php');
  include("auth.php");
  $id=$_REQUEST['id'];
  $query = "SELECT * from users where id='".$id."'";
  $result = mysqli_query($con, $query) or die ( mysqli_error());
  $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Update Record</title>
  <link rel="stylesheet" href="css/style.css" />
  <link href="css/registration.css" rel="stylesheet" type="text/css"/>
  <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
   rel = "stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
  <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script src="js/registration.js"></script>
</head>
<body class="user-edit">
<div class="form">
<p><a href="index.php">Home</a> | <a href="view.php">View Records</a> |<a href="logout.php">Logout</a></p>
<h1>Update Record</h1>

<?php
  $status = "";
  if(isset($_POST['new']) && $_POST['new']==1)
  {
  $id=$_REQUEST['id'];
  $trn_date = date("Y-m-d H:i:s");
  $name =$_REQUEST['name'];
  $email =$_REQUEST['email'];
  $mobile =$_REQUEST['mobile'];
  $user_address =$_REQUEST['user_address'];
  $user_city =$_REQUEST['user_city'];
  $user_dob =$_REQUEST['user_dob'];
  $user_gender =$_REQUEST['user_gender'];
  $user_degree =$_REQUEST['user_degree'];


  $update="UPDATE users SET username = '$name', email = '$email', trn_date = '$trn_date', mobile = '$mobile', user_address = '$user_address', user_city = '$user_city', user_dob = '$user_dob', user_gender = '$user_gender', user_degree = '$user_degree' WHERE id = $id";

  mysqli_query($con, $update) or die(mysqli_error());

  if (!empty($_FILES['image']['name'])) {
    $file_name = $_FILES['image']['name'];
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    // Check extension
    if( in_array($imageFileType,$extensions_arr) ){
      // checking whether there is an image or not.
      $image_query = "SELECT * from images where uid='".$id."'";
      $image_result = mysqli_query($con, $image_query) or die ( mysqli_error());
      $image_row = mysqli_fetch_assoc($image_result);

      if (count($image_row) > 0) {
        // Delete before insert.
        $delete_query = "DELETE FROM images WHERE uid=$id";
        $delete_result = mysqli_query($con,$delete_query) or die ( mysqli_error());
       // Insert record
       $query = "INSERT INTO images (name, image, uid)
          VALUES
          ('".$file_name."', '".$target_file."', '".$id."' )";
       $query_new_file_insert = mysqli_query($con,$query);
       // Upload file
       move_uploaded_file($_FILES['image']['tmp_name'],$target_dir.$file_name);
      }
    }
  }

  $status = "Record Updated Successfully. </br></br><a href='view.php'>View Updated Record</a>";
  echo '<p style="color:#FF0000;">'.$status.'</p>';
  }else {
?>
<div>
  <form name="form" method="post" action="" enctype='multipart/form-data'>
    <div class="left">
      <input type="hidden" name="new" value="1" />
      <input name="id" type="hidden" value="<?php echo $row['id'];?>" />
      <p><input type="text" name="name" placeholder="Enter Name" required value="<?php echo $row['username'];?>" /></p>
      <p><input type="text" name="email" placeholder="Enter Your Email" required value="<?php echo $row['email'];?>" /></p>
      <p><input type="number" name="mobile" placeholder="Mobile Number" required value="<?php echo $row['mobile'];?>" /></p>
      <p><textarea name="user_address" placeholder="Your Address" id="address" required><?php echo $row['user_address'];?></textarea></p>
      <div class="row-items">
        <span class="item-label">City:</span>
        <?php
         $user_city = $row['user_city'];
        ?>
        <span class="item-input" >
          <select name="user_city">
            <option <?php if ($user_city == 'Pune' ) echo 'selected' ; ?> value="Pune">Pune</option>
            <option <?php if ($user_city == 'Mumbai' ) echo 'selected' ; ?> value="Mumbai">Mumbai</option>
            <option <?php if ($user_city == 'Lohegaon' ) echo 'selected' ; ?> value="Lohegaon">Lohegaon</option>
            <option <?php if ($user_city == 'Nagpur' ) echo 'selected' ; ?> value="Nagpur">Nagpur</option>
            <option <?php if ($user_city == 'Pimpri_Chinchwad' ) echo 'selected' ; ?> value="Pimpri_Chinchwad">Pimpri Chinchwad</option>
            <option <?php if ($user_city == 'Nashik' ) echo 'selected' ; ?> value="Nashik">Nashik</option>
            <option <?php if ($user_city == 'Amravati' ) echo 'selected' ; ?> value="Amravati">Amravati</option>
          </select>
        </span>
      </div>

      <p><input type="text" name="user_dob" id="datepicker" value="<?php print $row['user_dob'];?>" required /></p>

      <div class="row-items radio-boxes">
        <span class="label-radio">Gender:</span>
        <?php
          $user_gender = $row['user_gender'];
        ?>
        <span class="item-radio">
          <input type="radio" name="user_gender" <?php if ($user_gender == 'Male' ) echo 'checked' ; ?> value="Male" required><span>Male</span>
          <input type="radio" name="user_gender" <?php if ($user_gender == 'Female' ) echo 'checked' ; ?> value="Female"><span>Female</span>
          <input type="radio" name="user_gender" <?php if ($user_gender == 'Other' ) echo 'checked' ; ?> value="Other"><span>Other</span>
        </span>
      </div>

      <div class="row-items">
        <span class="item-label">Qualification:</span>
        <?php
           $user_degree = $row['user_degree'];
          ?>
        <span class="item-input">
          <select name="user_degree">
            <option <?php if ($user_degree == 'Matriculation' ) echo 'selected' ; ?> value="Matriculation">Matriculation</option>
            <option <?php if ($user_degree == 'Intermediate' ) echo 'selected' ; ?> value="Intermediate">Intermediate</option>
            <option <?php if ($user_degree == 'Graduation' ) echo 'selected' ; ?> value="Graduation">Graduation</option>
            <option <?php if ($user_degree == 'Post_Graduate' ) echo 'selected' ; ?> value="Post_Graduate">Post Graduate</option>
            <option <?php if ($user_degree == 'Diploma' ) echo 'selected' ; ?> value="Diploma">Diploma</option>
            <option <?php if ($user_degree == 'B.Tech' ) echo 'selected' ; ?> value="B.Tech">B.Tech</option>
            <option <?php if ($user_degree == 'Others' ) echo 'selected' ; ?> value="Others">Others</option>
          </select>
        </span>
    </div>

      <p><input name="submit" type="submit" value="Update" /></p>
    </div>
    <?php
      // Logic to get images.
      $image_query = "SELECT * from images where uid='".$id."'";
      $image_result = mysqli_query($con, $image_query) or die ( mysqli_error());
      $image_row = mysqli_fetch_assoc($image_result);

    ?>
    <div class="right">
      <div class="row-items">
          <input type="file" name="image" id="image" class="image"/>

          <div id="image_preview">
              <img src="<?php echo $image_row['image'];?>" id="image-preview" style="width: 200px; height: 200px;" /><br />
              <a id="image_remove" href="#">Remove</a>
          </div>
      </div>
    </div>
  </form>
<?php } ?>

</div>
</div>
</body>
</html>
