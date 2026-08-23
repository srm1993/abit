<?php
    include('config.php');
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $name=$_REQUEST['name'];
        $email=$_REQUEST['email'];
        $age=$_REQUEST['age'];
        $gender=$_REQUEST['gender'];
        $phone=$_REQUEST['phone'];
        $query="INSERT INTO STUDENT(NAME,EMAIL,AGE,GENDER,PHONE) VALUES('$name','$email','$age','$gender','$phone')";
        $sql=mysqli_query($con,$query);
        if(mysqli_affected_rows($con)>0){
            echo "Student Inserted";
        }else{
            echo "Something Went Wrong";
        }
    }
?>
<form method="post">
    <input type="text" name="name" placeholder="Enter Name">
    <br>
    <input type="email" name="email" placeholder="Enter Email">
    <br>
    <input type="text" name="age" placeholder="Enter Age">
    <br>
    <select name="gender">
        <option hidden>Choose Your Gender</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Others</option>
    </select>
    <br>
    <input type="text" name="phone" placeholder="Enter Phone">
    <br>
    <input type="submit" name="btn" >
</form>
<table border="1px solid black" width="100%">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Phone</th>
        <th>Action</th>
    </tr>
<?php
    $mysql=mysqli_query($con,"SELECT * FROM STUDENT");
    while($data=mysqli_fetch_assoc($mysql)){
?>
    <tr>
        <td><?php echo $data['id']; ?></td>
        <td><?php echo $data['name']; ?></td>
        <td><?php echo $data['email']; ?></td>
        <td><?php echo $data['age']; ?></td>
        <td><?php echo $data['gender']; ?></td>
        <td><?php echo $data['phone']; ?></td>
        <td>
            <a href="delete.php?id=<?php echo $data['id']; ?>">Delete</a>
            <a href="edit.php?id=–<?php echo $data['id']; ?>">Edit</a>
        </td>
    </tr>
<?php } ?>
</table>