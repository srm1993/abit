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
        $error = "Something went wrong: " . mysqli_error($con);
    }
}

/* Get student data */

$sql = mysqli_query(
    $con,
    "SELECT * FROM student WHERE id='$id'"
);

$data = mysqli_fetch_assoc($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Student | Student Management System</title>


    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        body {

            font-family: Arial, Helvetica, sans-serif;

            min-height: 100vh;

            background:
                linear-gradient(
                    135deg,
                    #eef2ff 0%,
                    #f8fafc 50%,
                    #f3e8ff 100%
                );

            color: #333;

        }


        /* ==========================
           HEADER
        =========================== */

        .header {

            background:
                linear-gradient(
                    135deg,
                    #4f46e5,
                    #7c3aed
                );

            color: white;

            padding: 25px 50px;

            box-shadow:
                0 5px 20px rgba(0,0,0,0.12);

        }


        .header-content {

            max-width: 1100px;

            margin: auto;

            display: flex;

            align-items: center;

            justify-content: space-between;

        }


        .logo {

            font-size: 25px;

            font-weight: bold;

        }


        .subtitle {

            margin-top: 6px;

            font-size: 13px;

            opacity: 0.85;

        }


        .header-badge {

            background:
                rgba(255,255,255,0.18);

            padding: 10px 18px;

            border-radius: 30px;

            font-size: 13px;

            backdrop-filter: blur(10px);

        }


        /* ==========================
           MAIN
        =========================== */

        .container {

            max-width: 900px;

            margin: 50px auto;

            padding: 0 20px;

        }


        /* ==========================
           CARD
        =========================== */

        .card {

            background: white;

            border-radius: 20px;

            padding: 40px;

            box-shadow:
                0 15px 40px rgba(0,0,0,0.08);

        }


        .card-header {

            text-align: center;

            margin-bottom: 35px;

        }


        .icon {

            width: 70px;

            height: 70px;

            margin: auto;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background:
                linear-gradient(
                    135deg,
                    #4f46e5,
                    #7c3aed
                );

            color: white;

            font-size: 30px;

            box-shadow:
                0 10px 25px rgba(79,70,229,0.3);

        }


        .card-title {

            margin-top: 18px;

            font-size: 28px;

            font-weight: bold;

            color: #1f2937;

        }


        .card-description {

            margin-top: 8px;

            color: #6b7280;

            font-size: 14px;

        }


        /* ==========================
           ERROR
        =========================== */

        .error {

            background: #fee2e2;

            color: #991b1b;

            border: 1px solid #fecaca;

            padding: 14px 18px;

            border-radius: 10px;

            margin-bottom: 25px;

            font-size: 14px;

            font-weight: 600;

        }


        /* ==========================
           FORM
        =========================== */

        .form-grid {

            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 25px;

        }


        .form-group {

            display: flex;

            flex-direction: column;

        }


        .form-group label {

            font-size: 14px;

            font-weight: 600;

            color: #374151;

            margin-bottom: 8px;

        }


        .form-group input,
        .form-group select {

            width: 100%;

            padding: 14px 16px;

            border: 1px solid #d1d5db;

            border-radius: 10px;

            font-size: 14px;

            outline: none;

            background: #f9fafb;

            transition: all 0.3s ease;

        }


        .form-group input:focus,
        .form-group select:focus {

            border-color: #6366f1;

            background: white;

            box-shadow:
                0 0 0 4px
                rgba(99,102,241,0.1);

        }


        .form-group input:hover,
        .form-group select:hover {

            border-color: #a5b4fc;

        }


        /* ==========================
           BUTTONS
        =========================== */

        .button-area {

            margin-top: 35px;

            display: flex;

            justify-content: space-between;

            gap: 15px;

        }


        .btn {

            padding: 13px 25px;

            border-radius: 9px;

            text-decoration: none;

            font-size: 14px;

            font-weight: bold;

            cursor: pointer;

            border: none;

            transition: all 0.3s ease;

        }


        .btn-back {

            background: #f1f5f9;

            color: #475569;

        }


        .btn-back:hover {

            background: #e2e8f0;

            transform: translateY(-2px);

        }


        .btn-update {

            background:
                linear-gradient(
                    135deg,
                    #4f46e5,
                    #7c3aed
                );

            color: white;

            box-shadow:
                0 6px 15px
                rgba(79,70,229,0.25);

        }


        .btn-update:hover {

            transform: translateY(-2px);

            box-shadow:
                0 10px 25px
                rgba(79,70,229,0.35);

        }


        /* ==========================
           FOOTER
        =========================== */

        footer {

            text-align: center;

            padding: 30px;

            color: #6b7280;

            font-size: 13px;

        }


        /* ==========================
           RESPONSIVE
        =========================== */

        @media (max-width: 700px) {

            .header {

                padding: 20px;

            }


            .header-content {

                flex-direction: column;

                align-items: flex-start;

                gap: 15px;

            }


            .container {

                margin: 25px auto;

            }


            .card {

                padding: 25px;

            }


            .form-grid {

                grid-template-columns: 1fr;

            }


            .button-area {

                flex-direction: column-reverse;

            }


            .btn {

                width: 100%;

                text-align: center;

            }

        }

    </style>

</head>


<body>


<!-- ==========================
     HEADER
=========================== -->

<header class="header">

    <div class="header-content">


        <div>

            <div class="logo">

                🎓 Student Management System

            </div>

            <div class="subtitle">

                Manage your student records easily

            </div>

        </div>


        <div class="header-badge">

            ✏️ Edit Student

        </div>


    </div>

</header>



<!-- ==========================
     MAIN
=========================== -->

<div class="container">


    <div class="card">


        <!-- CARD HEADER -->

        <div class="card-header">

            <div class="icon">

                ✏️

            </div>


            <div class="card-title">

                Edit Student

            </div>


            <div class="card-description">

                Update the student's information below

            </div>

        </div>



        <!-- ERROR -->

        <?php if (isset($error)) { ?>

            <div class="error">

                ⚠️ <?php echo $error; ?>

            </div>

        <?php } ?>



        <!-- FORM -->

        <form method="post">


            <div class="form-grid">


                <!-- NAME -->

                <div class="form-group">

                    <label>

                        👤 Student Name

                    </label>

                    <input
                        type="text"
                        name="name"
                        placeholder="Enter student name"
                        value="<?php
                            echo htmlspecialchars($data['name']);
                        ?>"
                        required
                    >

                </div>



                <!-- EMAIL -->

                <div class="form-group">

                    <label>

                        📧 Email Address

                    </label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Enter email address"
                        value="<?php
                            echo htmlspecialchars($data['email']);
                        ?>"
                        required
                    >

                </div>



                <!-- AGE -->

                <div class="form-group">

                    <label>

                        🎂 Age

                    </label>

                    <input
                        type="number"
                        name="age"
                        placeholder="Enter age"
                        value="<?php
                            echo htmlspecialchars($data['age']);
                        ?>"
                        required
                    >

                </div>



                <!-- GENDER -->

                <div class="form-group">

                    <label>

                        ⚧ Gender

                    </label>

                    <select name="gender" required>

                        <option value="">
                            Choose your gender
                        </option>


                        <option
                            value="male"
                            <?php
                            if ($data['gender'] == 'male')
                                echo 'selected';
                            ?>
                        >

                            Male

                        </option>


                        <option
                            value="female"
                            <?php
                            if ($data['gender'] == 'female')
                                echo 'selected';
                            ?>
                        >

                            Female

                        </option>


                        <option
                            value="other"
                            <?php
                            if ($data['gender'] == 'other')
                                echo 'selected';
                            ?>
                        >

                            Other

                        </option>

                    </select>

                </div>



                <!-- PHONE -->

                <div class="form-group">

                    <label>

                        📱 Phone Number

                    </label>

                    <input
                        type="text"
                        name="phone"
                        placeholder="Enter phone number"
                        value="<?php
                            echo htmlspecialchars($data['phone']);
                        ?>"
                        required
                    >

                </div>


            </div>



            <!-- BUTTONS -->

            <div class="button-area">


                <a
                    href="index.php"
                    class="btn btn-back"
                >

                    ← Back to Students

                </a>


                <button
                    type="submit"
                    class="btn btn-update"
                >

                    💾 Update Student

                </button>


            </div>


        </form>


    </div>

</div>



<footer>

    Student Management System ©
    <?php echo date('Y'); ?>

</footer>


</body>

</html>
