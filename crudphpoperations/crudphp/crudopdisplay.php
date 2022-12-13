<?php

$nameError = $emailError = $mobileError = $passwordError ="";
$name = $email = $mobile = $password ="";
include 'connect.php';
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

   $uppercasePassword = "/(?=.*?[A-Z])/";
   $lowercasePassword = "/(?=.*?[a-z])/";
   $digitPassword = "/(?=.*?[0-9])/";
   $spacesPassword = "/^$|\s+/";
   $symbolPassword = "/(?=.*?[#?!@$%^&*-])/";
   $minEightPassword = "/.{8,}/";
    if (empty($_POST["name"])) {
      $nameError = "Name is mandatory";
      
  
    } else {
      $name = test_input($_POST["name"]);
       //check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        $nameError = "Only letters allowed";
        
      }
    }
    if (empty($_POST["mobile"])) {
      $mobileError = "Mobile Number is mandatory";
      
    } else {
      $mobile = test_input($_POST["mobile"]);
       //check if mobile no. is well-formed
      if (!preg_match(" /^[0-9-]+$/",$mobile)) {
        $mobileError = "Only numbers allowed";
        
      }
    }
    if (empty($_POST["email"])) {
      $emailError = "Email is mandatory";
      
    } else {
      $email = test_input($_POST["email"]);
       //check if e-mail address is well-formed
      if (!preg_match(" /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/",$email)) {
        $emailError = "Invalid email format";
      }
    }
    if (empty($_POST["password"])) {
      $passwordError = "Password is mandatory";
      
    } else {
      $password = test_input($_POST["password"]);
       //check if mobile no. is well-formed
      if (!preg_match("/(?=.*?[#?!@$%^&*-])/",$password)) {
        $passwordError = "Special character required";
        
      }
    }
  }
  function test_input($data) {
      $data = trim($data);   
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    $image = $_FILES['image'];
    //print_r($image);
        $imagefilename=$image['name'];
        //print_r($imagefilename);
        //echo "<br>";
        $imagefileerror=$image['error'];
        //print_r($imagefileerror);
        //echo "<br>";
        $imagefiletemp=$image['tmp_name'];
        //print_r($imagefiletemp);
        //echo "<br>";
        $filename_separate=explode('.',$imagefilename);
        //print_r($filename_separate);
        //echo "<br>";
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
        //header('location:display.php');
    }else{
        die(mysqli_error($conn));
    }
  }
  
  ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>crudop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src = "https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
     <script src = "https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
  </head>
  <body>
    <div class="container my-5 ">
    <form id = "form" method ="post"  enctype = "multipart/form-data" onsubmit="return(validate())" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
    <div class="mb-3">
    <label>Full Name</label>
    <input id="username" type="text" class="form-control nameError" placeholder="Enter your name" name="name">
    <span style="color:red"> <?php echo $nameError;?></span>
  </div>
  <div class="mb-3">
    <label>Gender- </label>
    <input type="radio" class="form-control-input mt-1" name="gender"  value="Male">Male
    <input type="radio" class="form-control-input mt-1" name="gender"  value="Female">Female
    <input type="radio" class="form-control-input mt-1" name="gender"  value="Others">Others
  </div>
  <div class="mb-3">
    <label>Email address</label><small id = "error_email" ></small>
    <input id="email" type="text" class="form-control emailError" placeholder="Enter your Email" name="email" >
    <span style="color:red"> <?php echo $emailError;?></span>
  </div>
  <div class="mb-3">
    <label>Mobile Number</label>
    <input id="mobile" type="text" class="form-control" placeholder="Enter your Mobile no." name="mobile" >
    <span style="color:red"> <?php echo $mobileError;?></span>
  </div>
  <div class="mb-3">
    <label>Address</label>
    <input id="address" type="text" class="form-control" placeholder="Enter your Address" name="address" >
  </div>
<div class="mb-3">
<label>Department</label>
<select class="form-control" name="department" >
  <option selected>Select-</option>
  <option value="Android">Android</option>
  <option value="ASP .net">ASP .net</option>
  <option value="iOS">iOS</option>
  <option value="PHP">PHP</option>
</select>
</div>
<div class="mb-3">
    <label>Password</label>
    <input id="password" type="text" class="form-control" name="password" >
    <span style="color:red"> <?php echo $passwordError;?></span>
  </div>
  <div class="mb-3" >
    <label>Profile Picture</label>
    <input type="file" class="form-control" name="image" >
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
   <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
    </div>
     </body>
</html>


<?php
 include 'connect.php';
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crudop</title>
</head>
<body>
    <div class="container">
        <button class="btn btn-primary my-5"><a href="crudop.php" class="text-light">Add User</a>
      
    </button>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">SI no. </th>
      <th scope="col">Profile picture</th>
      <th scope="col">Name</th>
      <th scope="col">Mobile</th>
      <th scope="col">Gender</th>
      <th scope="col">Email</th>
      <th scope="col">Address</th>
      <th scope="col">Department</th>
      <th scope="col">Hobbies</th>
      <th scope="col">Password</th>
      <th scope="col">Operations</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM `crudop`";
    $result = mysqli_query($conn,$sql);
    if($result){
        while( $row=mysqli_fetch_assoc($result)){
            $id = $row['id'];
            $image = $row['image'];
            $name = $row['name'];
            $mobile = $row['mobile'];
            $gender = $row['gender'];
            $email = $row['email'];
            $address = $row['address'];
            $department = $row['department'];
            $hobby = $row['hobby'];
            $password = $row['password'];
            echo '<tr>
            <th scope="row">'.$id.'</th>
            <td>'.$image.'</td>
            <td>'.$name.'</td>
            <td>'.$mobile.'</td>
            <td>'.$gender.'</td>
            <td>'.$email.'</td>
            <td>'.$address.'</td>
            <td>'.$department.'</td>
            <td>'.$hobby.'</td>
            <td>'.$password.'</td>
            <td>
            <button class="btn btn-primary"><a href="update.php? updateid='.$id.'" class="text-light">Update</a></button>
            <button class="btn btn-danger"><a href="delete.php? deleteid='.$id.' " class="text-light">Delete</a></button>
            </td>
            </tr>';
          
         }
    }
   
     ?>
     </div>
     
  
</body>
</html>