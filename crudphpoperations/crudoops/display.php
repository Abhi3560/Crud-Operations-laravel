<?php 
   
 include_once ("crud.php"); 
 include_once ("Dbconnect.php"); 
    
  if(!empty($_GET['delid'])) 
  { 
  
  $id=$_GET['delid']; 
   
  $crud= new crud(); 
  $crud->deletedata("form",$id); 
  //$data = $crud->selectbyid('form',$id);  
  //$path = "$image";
  //unlink($path);
  header('location:display.php'); 
  } 
    
  ?> 
    
  <!DOCTYPE html> 
  <html lang="en"> 
  <head> 
    <title>crudoops</title> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
  </head> 
  <body> 
    
  <div class="container"> 
  
        <button class="btn btn-primary my-5"><a href="index.php" class="text-light">Add User</a></button>
        
    <table class="table table-striped"> 
      <thead> 
        <tr> 
        <th>SI no.</th>
          <th>Profile picture</th>
          <th>Name</th> 
          <th>Mobile</th> 
          <th>Email</th> 
          <th>Password</th>
          <th>Address</th>
          <th>Gender</th>
          <th>Department</th>
          <th>Hobbies</th>
          <th>Edit</th> 
          <th>delete</th> 
        </tr> 
      </thead> 
      <tbody> 
 
         <?php 
$crud= new crud(); 
/*$results_per_page = 5;  
$sql = "SELECT * FROM `form`";
$result = mysqli_query($connection,$sql);
$number_of_result = mysqli_num_rows($result);
 //determine the total number of pages available  
 $number_of_page = ceil ($number_of_result / $results_per_page);  

 //determine which page number visitor is currently on  
 if (!isset ($_GET['page']) ) {  
     $page = 1;  
 } else {  
     $page = $_GET['page'];  
 }
 //determine the sql LIMIT starting number for the results on the displaying page
 $page_first_result = ($page-1) * $results_per_page;   
 //retrieve the selected results from database   
 $query = "SELECT *FROM form ORDER BY id DESC LIMIT " . $page_first_result . ',' . $results_per_page;  
 $result = mysqli_query($conn, $query);  
*/
//if($result){
$result = $crud->selectalldata("form"); 
$i=0;
   while($data = mysqli_fetch_array($result)) 
   { $i++;
?> 

<tr> 
<td><?php echo $i; ?></td> 
<td ><img src="<?php echo $data['image']; ?>"/ height=150,width=150 alt="Image"/></td> 
<td><?php echo $data['name']; ?></td> 
<td><?php echo $data['phone']; ?></td> 
<td><?php echo $data['email']; ?></td> 
<td><?php echo $data['password']; ?></td>
<td><?php echo $data['address']; ?></td>
<td><?php echo $data['gender']; ?></td>
<td><?php echo $data['department']; ?></td>
 <td><?php echo $data['hobby']; ?></td>
 <td> <button class="btn btn-primary"><a href="update.php?editid=<?php echo $data['id'];?>" class="text-light">Update</button></td>
 <td><button class="btn btn-danger"><a href="display.php?delid=<?php echo $data['id'];?>" onclick=" return confirm('Do You really want to delete this data')" class="text-light">Delete</button></td> 
     </tr> 
      <?php }
//}
      
             //display the link of the pages in URL  
             /*for($page = 1; $page<= $number_of_page; $page++) {  
              echo '<a href = "display.php?page=' . $page . '">' . $page . ' </a>';  
             }*/
      
      ?> 
   </tbody> 
 </table> 
</div> 
    
  </body> 
  </html> 
    