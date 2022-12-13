<?php 
   
 include_once "crud.php"; 
   
 $crud= new crud(); 
   
 if(isset($_POST['submit'])) 
 {       

  //echo '<pre>';
  //var_dump($_POST);die;
  $hobby = (!empty($_POST['hobby']) && is_array($_POST['hobby'])) ? $_POST['hobby'] : [];
  $alldata = implode(",",$hobby);
  //print_r($hobby);die;
   // $hobby = $_POST['hobby'];
  // $checkBox = implode(",",$hobby);
   //$hobby = implode(",",(isset($_POST['hobby']) && is_array($_POST['hobby']) ? $_POST['hobby'] : []));
  // $checkBox =implode(',', $hobby);
  // $_POST['hobby']= implode(",",$hobby);
   //$checkBox = implode(",", $_POST['hobby']?? '[]');
   //print_r($hobby);
    
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
    $uploadimage='images/'.$imagefilename;
    //print_r($upload_image);
     move_uploaded_file($imagefiletemp,$uploadimage);
     
 }
//$upload_image=isset($_POST['upload_image']) && is_array($_POST['upload_image']) ? $_POST['upload_image'] : [];
$data= array( 
"name"  => $crud->escape_string($_POST['name']),            
"email"  => $crud->escape_string($_POST['email']), 
"phone"  => $crud->escape_string($_POST['phone']),
"password"  => $crud->escape_string($_POST['password']),
"address"  => $crud->escape_string($_POST['address']),
"gender"  => $crud->escape_string($_POST['gender']),  
"department"  => $crud->escape_string($_POST['department']),
"hobby" => $crud->escape_string($alldata),
"image" => $crud->escape_string($uploadimage)     //$image = mysqli_real_escape_string($con, trim($_POST["image"]));
); 
var_dump($data);

$crud->insert($data,'form'); 
             
             
  if($data)  { 
  echo 'insert successfully'; 
header('location:display.php'); 
  }   
 else  { 
echo 'try again' ; 
 } 
       
 } 
   
   
 ?> 
 <!DOCTYPE html> 
 <html> 
 <head> 
 <title>form</title> 
 <link rel="stylesheet" type="text/css" href="css/style.css"> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
 <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet"> 
 </head> 
 <body> 
   
   
 <div class="container my-5 ">
    <form id="form" method ="post" action="#"  enctype = "multipart/form-data" >
    <div class="mb-3">
    <label>Full Name</label>
    <input type="text" class="form-control nameError" placeholder="Enter your name" name="name" id="name" >
    <p class="err-msg">
     </div>
  <div class="mb-3">
    <label>Mobile Number</label>
    <input type="text" class="form-control" placeholder="Enter your Mobile no." name="phone" id="phone">
    <p class="err-msg">
  </div>
  <div class="mb-3">
    <label>Email address</label><small id = "error_email" ></small>
    <input type="email" class="form-control emailError" placeholder="Enter your Email" name="email" id="email">
    <p class="err-msg">
  </div>
  <div class="mb-3">
    <label>Password</label>
    <input type="text" class="form-control" placeholder="Enter your password" name="password" id="password">
    <p class="err-msg">
  </div>
  <div class="mb-3">
    <label>Address</label>
    <input type="text" class="form-control" placeholder="Enter your Address-" name="address" id="address">
    <p class="err-msg">
  </div>
  <div class="mb-3">
    <label>Gender- </label>
    <input type="radio" class="form-control-input mt-1" name= "gender"  value="Male">Male
    <input type="radio" class="form-control-input mt-1" name= "gender"  value="Female">Female
    <input type="radio" class="form-control-input mt-1" name= "gender"  value="Others">Others
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
  <div class="mb-3" >
    <label>Profile Picture</label>
    <input type="file" class="form-control" name="image" id="image" >
    <span style="color:red; font-size:12px;">Only jpg / jpeg/ png  format allowed.</span>
  </div>

  <button class="btn btn-primary" id="submit" onclick="return sFunction()" name="submit">Submit</button>
  </div>
 </form> 
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
        phone: {
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
        phone: {
          required: 'Please enter Contact no.',
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