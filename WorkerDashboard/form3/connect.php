<?php

$con=new mysqli('localhost','root','','Paalan');

if(!$con){
    die(mysqli_errno(($con)));
}

?>