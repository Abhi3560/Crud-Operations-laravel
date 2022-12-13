<?php 
 include 'connect.php';
 include 'cdn.php';
 

    $id=$_GET['deleteid'];
    $sql= "SELECT * FROM `crudop` where id=$id" ;
    $result = mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $image = $row['image'];
   //delete image from folder
    $path = "$image";
    if (is_file($path)) {
        unlink($path);
    } else {
        print_r($path);
        echo "your image not found";
    }if(isset($_GET['deleteid'])){
    //$id=$_GET['deleteid'];
    $query = "DELETE FROM `crudop` WHERE `crudop`.`id` = $id";
    $result = mysqli_query($conn,$query);
    if($result){
        header('location:display.php');
   
      }else{

        die(mysqli_error($conn));
    } 

}
?>



