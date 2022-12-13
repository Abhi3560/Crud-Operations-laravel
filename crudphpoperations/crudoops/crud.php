<?php 
   
 include_once ('Dbconnect.php'); 
 //header('location:display.php');
   
 class Crud extends Dbconnect 
 { 
public $columns=""; 
public $values=""; 
public $column=""; 
public $value=""; 
public function __construct() { 
parent::__construct();        
 } 
 public function selectalldata($table)  {   
    // $results_per_page = 5;              // select all data
$select="SELECT * FROM $table"; 
$select1=$this->connection->query($select); 
return $select1; 
//$result = mysqli_query($this->connection,$select);
//$number_of_result = mysqli_num_rows($result);
//determine the total number of pages available  
//$number_of_page = ceil ($number_of_result / $results_per_page);  

//determine which page number visitor is currently on  
/*if (!isset ($_GET['page']) ) {  
     $page = 1;  
 } else {  
     $page = $_GET['page'];  
 }*/
 //determine the sql LIMIT starting number for the results on the displaying page
 //$page_first_result = ($page-1) * $results_per_page;   
 //retrieve the selected results from database   
 //$query = "SELECT *FROM $table ORDER BY id DESC LIMIT " . $page_first_result . ',' . $results_per_page;  
 //$result = mysqli_query($conn, $query);  
//if($result){

 } 


 
public function selectbyid($table,$id) {                   // select data by id
$sel= "SELECT * FROM $table where id=$id"; 
$sel1=$this->connection->query($sel); 
return mysqli_fetch_array($sel1); 
} 


public function insert($data,$table) {              // insert the data
//print_r($data); 
foreach($data as $this->column => $this->value) { 
$this->columns .= ($this->columns == "") ? "" : ", "; 
$this->columns .= $this->column; 
$this->values .= ($this->values == "") ? "" : ", "; 
$this->values .= "'".$this->value ."'"; 
//echo $this->values; 
} 
$insert= ("INSERT into $table ($this->columns) values ($this->values)"); 
//echo $insert; 
$insert1= $this->connection->query($insert); 
} 
public function update($data,$table,$id)  {                         //update the data
foreach ($data as $this->column => $this->value) 
{ 
$update=("UPDATE $table SET $this->column = '$this->value' WHERE id= '$id'"); 
             // echo $update; 
$this->connection->query($update); 
} 
return true; 
} 
public function deletedata($table,$where) {       // delete the data
$delete=("DELETE FROM $table WHERE id=$where"); 
$this->connection->query($delete); 

return true; 
 
} 
function escape_string($value) 
{ 
return $this->connection->real_escape_string($value); 
} 
} 
   
   
 ?> 