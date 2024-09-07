<?php
$HOSTNAME='localhost';
$USERNAME='root';
$PASSWORD='';
$DATABASE='uvw3';

$con=mysqli_connect($HOSTNAME,$USERNAME,$PASSWORD,$DATABASE);
    if(!$con){
        die(mysqli_error($con));
}
?>