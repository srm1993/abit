<?php
    include('config.php');
    $id=$_GET['id'];
    $sql=mysqli_query($con,"DELETE FROM student WHERE id='$id'");
    header("location:student.php");
?>
