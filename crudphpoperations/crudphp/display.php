

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crudphp</title>
    
</head>
<body>
    <div class="container">
        <button class="btn btn-primary my-5"><a href="index.php" class="text-light">Add User</a>
      
    </button>
    <table class="table table-striped">
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
    include 'connect.php';
    include 'cdn.php';
   
    $results_per_page = 5;  
    $sql = "SELECT * FROM `crudop`";
    $result = mysqli_query($conn,$sql);
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
     $query = "SELECT *FROM crudop ORDER BY id DESC LIMIT " . $page_first_result . ',' . $results_per_page;  
     $result = mysqli_query($conn, $query);  
    
    if($result){
      $i=1;
  
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
      <td>'.$i.'</td>
      <td><image src="' . $image .'"/ height=200,width=200 alt="Image"></td>
      <td>'.$name.'</td>
      <td>'.$mobile.'</td>
      <td>'.$gender.'</td>
      <td>'.$email.'</td>
      <td>'.$address.'</td>
      <td>'.$department.'</td>
      <td>'.$hobby.'</td>
      <td>'.$password.'</td>
      <td>
      <button class="btn btn-primary" id = "update"><a href="update.php? updateid='.$id.'" class="text-light">Update</a></button>
      <button class="btn btn-danger" onclick="return myFunction()" href="delete.php? id= "delete" ><a href="delete.php? deleteid='.$id.' " class="text-light" >Delete</a></button>
      </td>
      </tr>';
     
    $i++; 
     }
        
        
      }
  
            //display the link of the pages in URL  
      for($page = 1; $page<= $number_of_page; $page++) {  
        echo '<a href = "display.php?page=' . $page . '">' . $page . ' </a>';  
    } 
    
    ?>  
   </div>
    <script>
    function myFunction() {
    var x;
    if (confirm("Are you want to delete the data?") == true) {
       return true;
    } else {
       return false;
    }
}
</script>
  
</body>
</html>

