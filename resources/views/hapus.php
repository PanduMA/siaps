<?php 
$con=mysqli_connect('localhost','root','','siaps');
$id=$_POST['id'];
$query= "DELETE FROM aspirasi WHERE id='$id' ";
$result=mysqli_query($con,$query);

?>