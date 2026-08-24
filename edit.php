<?php
    include('config.php');
    $id=$_REQUEST['id'];
    $sql=mysqli_query($con,"Select * from student where id='$id'");
    $data=mysqli_fetch_assoc($sql);
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $id=$_REQUEST['id'];
        $name=$_REQUEST['name'];
        $email=$_REQUEST['email'];
        $age=$_REQUEST['age'];
        $gender=$_REQUEST['gender'];
        $phone=$_REQUEST['phone'];
        $mySql=mysqli_query($con,"Update student set name='$name',email='$email',age='$age',gender='$gender',phone='$phone' where id='$id'");
        if(mysqli_affected_rows($con)>0){
            header('location:student.php');
        }else{
           echo "something went wrong"; 
        }
    }
?>
<form method="post">
    <input type="text" name="name" placeholder="Enter Name" value="<?php echo $data['name']; ?>">
    <br>
    <input type="email" name="email" placeholder="Enter Email" value="<?php echo $data['email']; ?>">
    <br>
    <input type="text" name="age" placeholder="Enter Age" value="<?php echo $data['age']; ?>">
    <br>
    <select name="gender">
        <option hidden>Choose Your Gender</option>
        <option value="male" <?php if($data['gender']=='male'){?>selected<?php } ?>>Male</option>
        <option value="female" <?php if($data['gender']=='female'){?>selected<?php } ?>>Female</option>
        <option value="other" <?php if($data['gender']=='others'){?>selected<?php } ?>>Others</option>
    </select>
    <br>
    <input type="text" name="phone" placeholder="Enter Phone" value="<?php echo $data['phone']; ?>">
    <br>
    <input type="submit" name="btn" >
</form>