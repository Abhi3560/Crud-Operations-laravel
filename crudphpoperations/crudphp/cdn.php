<!DOCTYPE html>
<html lang="en">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<?php
    if(isset($_SESSION['status']) && $_SESSION['status'] != '')
    {      $_SESSION['status']="data inserted sucessfully";
           $_SESSION['status_code']="success";
        ?>
         <script>
        swal({
        title: <?php echo $_SESSION['status']; ?>,
       // text: "You clicked the button!",
         icon:  <?php echo $_SESSION['status_code']; ?>,
         button: "DONE!",
        });
    </script>
 <?php
        unset($_SESSION['status']);
    }
    ?>

    
</html>