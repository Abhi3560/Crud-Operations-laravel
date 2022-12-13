<?php

include 'connect.php';
include 'cdn.php';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];

    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $department = $_POST['department'];
    $hobby = $_POST['hobby'];
    $alldata = implode(",",$hobby);
    //print_r($alldata);
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

    $query = "INSERT INTO `crudop` (`name`, `mobile`,`gender`, `email`, `password`, `address`,`department`,`hobby`,`image`) VALUES ('$name', '$mobile','$gender','$email', '$password','$address','$department','$alldata','$upload_image')";
    $result = mysqli_query($conn,$query);
    if ($result){
        //echo "data inserted sucessfully";
        //$_SESSION['status']="data inserted sucessfully";
        //$_SESSION['status_code']="success";

        header('location:display.php');
    }else{
        die(mysqli_error($conn));
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
    <form id="form" method ="post"  enctype = "multipart/form-data" >
    <div class="mb-3">
    <label>Full Name</label>
    <input type="text" class="form-control nameError" placeholder="Enter your name" name="name" id="name" >
    <p class="err-msg">
  </div>
  <div class="mb-3">
    <label>Mobile Number</label>
    <input type="text" class="form-control" placeholder="Enter your Mobile no." name="mobile" id="mobile">
    <p class="err-msg">
  </div>
  <div class="mb-3">
    <label>Gender- </label>
    <input type="radio" class="form-control-input mt-1" name= "gender"  value="Male">Male
    <input type="radio" class="form-control-input mt-1" name= "gender"  value="Female">Female
    <input type="radio" class="form-control-input mt-1" name= "gender"  value="Others">Others
  </div>
  <div class="mb-3">
    <label>Email address</label><small id = "error_email" ></small>
    <input type="email" class="form-control emailError" placeholder="Enter your Email" name="email" id="email">
    <p class="err-msg">
  </div>
  <div class="mb-3">
    <label>Address</label>
    <input type="text" class="form-control" placeholder="Enter your Address" name="address" >
  </div>
<div class="mb-3">
<select class="form-control" name="department" >
  <option selected>Department-</option>
  <option value="Android">Android</option>
  <option value="ASP .net">ASP .net</option>
  <option value="iOS">iOS</option>
  <option value="PHP">PHP</option>
</select>
</div>
<div class="mb-3">
    <label>Password</label>
    <input type="password" class="form-control" name="password" id="password">
    <p class="err-msg">
  </div>
  <div class="mb-3" >
    <label>Profile Picture</label>
    <input type="file" class="form-control" name="image" id="image" >
    <span style="color:red; font-size:12px;">Only jpg / jpeg/ png  format allowed.</span>
  </div>
  <div class="mb-3">
  <label>Hobbies-</label>
    <input class="form-check-input mt-1" type="checkbox" name="hobby[]" value="Acting">Acting
    <input class="form-check-input mt-1" type="checkbox" name="hobby[]" value="Cricket">Cricket
    <input class="form-check-input mt-1" type="checkbox" name="hobby[]" value="Cooking">Cooking
    <input class="form-check-input mt-1" type="checkbox" name="hobby[]" value="Dance">Dance
    <input class="form-check-input mt-1" type="checkbox" name="hobby[]" value="Hiking">Hiking
    <input class="form-check-input mt-1" type="checkbox" name="hobby[]" value="Reading">Reading
    <input class="form-check-input mt-1" type="checkbox" name="hobby[]" value="Photography">Photography
    <input class="form-check-input mt-1" type="checkbox" name="hobby[]" value="Surfing">Surfing
    <required>
  </div>
  <script>
    function myFunction() {
    var x;
    if (confirm("Are you want to delete ?!") == true) {
       return true;
    } else {
       return false;
    }
}
$(document).ready(function(){
    $("#btn-alert").click(function(){
        alert("Summit sucessfully");
    });
});
</script>
   <button class="btn btn-primary" onclick="return sFunction()" id="submit" name="submit">Submit</button>
</form>
    </div>
     </body>
     <style>
  .error {
    color: red;
  }
</style>
<script>
  function sFunction() {
    var x;
    if (confirm("Do you want to summit your data") == true) {
       return true;
    } else {
       return false;
    }
}
  $(document).ready(function () {
    $('#form').validate({
      rules: {
        name: {
          required: true
        },
        email: {
          required: true,
          email: true
        },
        mobile: {
          required: true,
          rangelength: [10, 12],
          number: true
        },
        password: {
          required: true,
          minlength: 8
        }
      },
      messages: {
        name: 'Please enter Name.',
        email: {
          required: 'Please enter Email Address.',
          email: 'Please enter a valid Email Address.',
        },
        mobile: {
          required: 'Please enter Contact.',
          rangelength: 'Please enter a Valid Mobile number.'
        },
        password: {
          required: 'Please enter Password.',
          minlength: 'Password must be at least 8 characters long.',
        }
      }
    });
  });
</script>
</html>
