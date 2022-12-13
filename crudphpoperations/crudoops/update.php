<?php 
   
 include_once ("crud.php"); 
   
 $id = $_GET['editid']; 
   
 $crud= new crud(); 
   
 $data = $crud->selectbyid('form',$id); 

 $hobby = $data['hobby'];  
 $checkbox_array = explode(",", $hobby);
 $oldimage = $data['image'];          //old image
 $path = "$oldimage"; 


 if(isset($_POST['submit']))
  {
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
$hobby = (!empty($_POST['hobby']) && is_array($_POST['hobby'])) ? $_POST['hobby'] : [];
$alldata = implode(",",$hobby);
 $data= array( 
"name"  => $crud->escape_string($_POST['name']),            
"email"  => $crud->escape_string($_POST['email']), 
"phone"  => $crud->escape_string($_POST['phone']),
"password"  => $crud->escape_string($_POST['password']),
"address"  => $crud->escape_string($_POST['address']),  
"gender"  => $crud->escape_string($_POST['gender']), 
"department"  => $crud->escape_string($_POST['department']),
"hobby"  => $crud->escape_string($alldata),
"image" => $crud->escape_string($uploadimage) 
);
//var_dump($data);
 $crud->update($data,'form',$id); 
 if($data) { 
 echo 'updated successfully'; 
 unlink($path);
 //move_uploaded_file($imagefiletemp,$uploadimage2);
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
 <title>update</title> 
 <link rel="stylesheet" type="text/css" href="css/style.css"> 
 <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet"> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
 </head> 
 <body> 
 
 <div class="container my-5 ">
 <form method="POST" name="form" enctype = "multipart/form-data"> 
 <div>
 <label>Full Name</label>
<input type="text" class="form-control" name="name" value="<?php echo $data['name'];?>"><br/> 
 </div>
   <div>
   <label>email</label> 
 <input type="text"  class="form-control" name="email" value="<?php echo $data['email'];?>"><br/> 
 </div>
  <div><label>phone</label> 
 <input type="text"  class="form-control" name="phone" value="<?php echo $data['phone'];?>"><br/> 
 </div>
 <div class="mb-3">
    <label>Password</label>
    <input type="text" class="form-control" name="password" value="<?php echo $data['password'];?>" >
  </div>
  <div class="mb-3">
    <label>Address</label>
    <input type="text" class="form-control" name="address" value="<?php echo $data['address'];?>" >
  </div>
  <div class="mb-3">
    <label>Gender- </label>
    <input type="radio" class="form-control-input mt-1" name="gender" value="Male" <?php echo ($data['gender'] == "male")?"checked":"" ?> >Male
    <input type="radio" class="form-control-input mt-1" name="gender" value="Female" <?php echo ($data['gender'] == "female")?"checked":"" ?> >Female
    <input type="radio" class="form-control-input mt-1" name="gender" value="Others" <?php echo ($data['gender'] == "others")?"checked":"" ?> >Others
  </div>
  <div class="mb-3">
    <label>Department</label>
<select class="form-control" name="department">
<option selected>Select-</option>
<option value="Android" <?php if($data['department'] == 'Android'){ echo "selected";} ?>>Android</option>
<option value="ASP .net" <?php if($data['department'] == 'ASP .net'){ echo "selected";} ?>>ASP .net</option>
<option value="iOS" <?php if($data['department'] == 'iOS'){ echo "selected";} ?>>iOS</option>
<option value="PHP" <?php if($data['department'] == 'PHP'){ echo "selected";} ?>>PHP</option>
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
<div class="mb-3" >
<label>Profile Picture</label>
<td><img src="<?php echo $oldimage;?>" width="50"></td><br />
<input type="hidden" class="form-control" name="oldimage"  value="<?php echo $oldimage;?>">
</div>
<div class="mb-3" >
<label>Update Profile Picture</label>
<input type="file" class="form-control" name="image" id="image" >
    <span style="color:red; font-size:12px;">Only jpg / jpeg/ png  format allowed.</span>
</div>
<button class="btn btn-primary" id="submit" onclick="return sFunction()" name="submit">Submit</button>
</div>
</form> 
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