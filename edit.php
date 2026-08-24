<?php

include('config.php');

$id = $_REQUEST['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];

    $sql = "UPDATE student 
            SET name='$name',
                email='$email',
                age='$age',
                gender='$gender',
                phone='$phone'
            WHERE id='$id'";

    $result = mysqli_query($con, $sql);

    if ($result) {
        header('Location: index.php');
        exit;
    } else {
        echo "Something went wrong: " . mysqli_error($con);
    }
}

/* Get student data */
$sql = mysqli_query(
    $con,
    "SELECT * FROM student WHERE id='$id'"
);

$data = mysqli_fetch_assoc($sql);

?>

<form method="post">

    <input 
        type="text" 
        name="name" 
        placeholder="Enter Name"
        value="<?php echo htmlspecialchars($data['name']); ?>"
    >

    <br>

    <input 
        type="email" 
        name="email" 
        placeholder="Enter Email"
        value="<?php echo htmlspecialchars($data['email']); ?>"
    >

    <br>

    <input 
        type="text" 
        name="age" 
        placeholder="Enter Age"
        value="<?php echo htmlspecialchars($data['age']); ?>"
    >

    <br>

    <select name="gender">

        <option hidden>Choose Your Gender</option>

        <option 
            value="male"
            <?php if ($data['gender'] == 'male') echo 'selected'; ?>
        >
            Male
        </option>

        <option 
            value="female"
            <?php if ($data['gender'] == 'female') echo 'selected'; ?>
        >
            Female
        </option>

        <option 
            value="other"
            <?php if ($data['gender'] == 'other') echo 'selected'; ?>
        >
            Others
        </option>

    </select>

    <br>

    <input 
        type="text" 
        name="phone" 
        placeholder="Enter Phone"
        value="<?php echo htmlspecialchars($data['phone']); ?>"
    >

    <br>

    <input type="submit" value="Update">

</form>
