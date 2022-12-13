<?php 
SESSION_START();

$conn = new mysqli('localhost','root',"",'crudop');

if(!$conn){
    echo "connection sucessful";
}

?>
