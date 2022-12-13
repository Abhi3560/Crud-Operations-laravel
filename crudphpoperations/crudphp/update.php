<?php
include 'connect.php';
include 'cdn.php';
$id=$_GET['updateid'];
$sql= "SELECT * FROM `crudop` where id=$id" ;
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$name = $row['name'];
$mobile = $row['mobile'];
$gender = $row['gender'];
$email = $row['email'];
$address = $row['address'];
$department = $row['department'];
$hobby = $row['hobby'];
$checkbox_array = explode(",", $hobby);
$password = $row['password'];
$oldimage = $row['image'];

$path = "$oldimage";
//to update the data

if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $mobile = $_POST['mobile'];
  $gender = $_POST['gender'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $department = $_POST['department'];
  $hobby = $_POST['hobby'];
  $alldata = implode(",",$hobby);
  $password = $_POST['password'];
  
  $sql = "UPDATE `crudop` SET `name` = '$name', `mobile` = '$mobile',`gender` = '$gender' , `email` = '$email',`address` = '$address',`department` = '$department',`hobby` = '$alldata' , `password` = '$password'  WHERE `crudop`.`id` = $id ";
  $result = mysqli_query($conn,$sql);
  if ($result){
   
     echo "<script>alert('You have successfully update the data');</script>";
     echo "<script type='text/javascript'> document.location ='display.php'; </script>";
      
  }else{
    echo "<script>alert('Something Went Wrong. Please try again');</script>"; 
  }
  //update the image
$oldimage = $_FILES['image'];
$image = $_FILES['image'];
      $imagefilename=rand(0000,9999).$image['name'];
      //print_r($imagefilename);
      $imagefileerror=$image['error'];
      $imagefiletemp=$image['tmp_name'];
      $filename_separate=explode('.',$imagefilename);
      $file_extension=strtolower(end($filename_separate));
      //print_r($file_extension);
      $extension=array('jpeg','jpg','png');
      if(in_array($file_extension,$extension)){
      $upload_image='images/'.$imagefilename;
       move_uploaded_file($imagefiletemp,$upload_image);


$sql = "UPDATE `crudop` SET `image` = '$upload_image'  WHERE `crudop`.`id` = $id ";
$result = mysqli_query($conn,$sql);
if ($result){
move_uploaded_file($imagefiletemp_edit,$upload_image);


    
   //print_r($path);
   unlink($path);
   //echo "<script>alert('You have successfully update the data');</script>";
   echo "<script type='text/javascript'> document.location ='display.php'; </script>";
    
}else{
  echo "<script>alert('Something Went Wrong. Please try again');</script>";
    //die(mysqli_error($conn));
}
}
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>crudop</title>
  </head>
  <body>
    <div class="container my-5 ">
    <form id = "form" method ="post"   enctype = "multipart/form-data" >
    <div class="mb-3">
    <label>Full Name</label>
    <input type="text" class="form-control" placeholder="Enter your name" name="name" value=<?php echo $name; ?>>
  </div>
  <div class="mb-3">
    <label>Mobile Number</label>
    <input type="text" class="form-control" placeholder="Enter your Mobile no." name="mobile" value=<?php echo $mobile; ?>>
  </div>
  <div class="mb-3">
    <label>Gender- </label>
    <input type="radio" class="form-control-input mt-1" name="gender" value="Male" <?php echo ($gender == "male")?"checked":"" ?> >Male
    <input type="radio" class="form-control-input mt-1" name="gender" value="Female" <?php echo ($gender == "female")?"checked":"" ?> >Female
    <input type="radio" class="form-control-input mt-1" name="gender" value="Others" <?php echo ($gender == "others")?"checked":"" ?> >Others
  </div>
  <div class="mb-3">
    <label>Email address</label>
    <input type="email" class="form-control" placeholder="Enter your Email" name="email" value=<?php echo $email; ?> >
  </div>
  <div class="mb-3">
    <label>Address</label>
    <input type="text" class="form-control" placeholder="Enter your Address" name="address" value=<?php echo $address; ?> >
  </div>
  <div class="mb-3">
    <label>Department</label>
<select class="form-control" name="department">
  <option selected>Select-</option>
  <option value="Android" <?php if($department == 'Android'){ echo "selected";} ?>>Android</option>
  <option value="ASP .net" <?php if($department == 'ASP .net'){ echo "selected";} ?>>ASP .net</option>
  <option value="iOS" <?php if($department == 'iOS'){ echo "selected";} ?>>iOS</option>
  <option value="PHP" <?php if($department == 'PHP'){ echo "selected";} ?>>PHP</option>
</select>
</div>
  <div class="mb-3">
  <label>Hobbies</label>
    <input class="form-check-input mt-1" type="checkbox" name="hobby[]" value="Acting" <?php if(in_array("Acting", $checkbox_array)){ echo "checked";} ?> >Acting
    <input class="form-check-input mt-1" type="checkbox" name="hobby[]" value="Cricket" <?php if(in_array("Cricket", $checkbox_array)){ echo "checked";} ?> >Cricket
    <input class="form-check-input mt-1" type="checkbox" name="hobby[]" value="Cooking" <?php if(in_array("Cooking", $checkbox_array)){ echo "checked";} ?> >Cooking
    <input class="form-check-input mt-1" type="checkbox" name="hobby[]" value="Dance" <?php if(in_array("Dance", $checkbox_array)){ echo "checked";} ?> >Dance
    <input class="form-check-input mt-1" type="checkbox" name="hobby[]" value="Hiking" <?php if(in_array("Hiking", $checkbox_array)){ echo "checked";} ?> >Hiking
    <input class="form-check-input mt-1" type="checkbox" name="hobby[]" value="Reading" <?php if(in_array("Reading", $checkbox_array)){ echo "checked";} ?> >Reading
    <input class="form-check-input mt-1" type="checkbox" name="hobby[]" value="Photography" <?php if(in_array("Photography", $checkbox_array)){ echo "checked";} ?> >Photography
    <input class="form-check-input mt-1" type="checkbox" name="hobby[]" value="Surfing" <?php if(in_array("Surfing", $checkbox_array)){ echo "checked";} ?> >Surfing
  </div>
  <div class="mb-3">
    <label>Password</label>
    <input type="text" class="form-control" name="password" value=<?php echo $password ?>>
  </div>
  <div class="mb-3" >
    <label>Profile Picture</label>
    <td><img src="<?php echo $oldimage;?>" width="50"></td><br />
    <input type="hidden" class="form-control" name="oldimage"  value="<?php echo $oldimage;?>">
  </div>
  <div class="mb-3" >
    <label>Update Profile Picture</label>
    <input type="file" class="form-control" name="image"  >
    <span style="color:red; font-size:12px;">Only jpg / jpeg/ png  format allowed.</span>
    
  </div>
   <button type="submit" class="btn btn-primary" id="submit" onclick="return sFunction()" name="submit">Update</button>
</form>
    </div>
     </body>
     <script>
  function sFunction() {
    var x;
    if (confirm("Do you want to save the changes") == true) {
       return true;
    } else {
       return false;
    }
}
</script>
</html>
