<?php
include('config.php');

$message = "";
$messageType = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];

    $query = "INSERT INTO student(NAME, EMAIL, AGE, GENDER, PHONE)
              VALUES('$name', '$email', '$age', '$gender', '$phone')";

    $sql = mysqli_query($con, $query);

    if ($sql) {
        $message = "Student inserted successfully!";
        $messageType = "success";
    } else {
        $message = "Something went wrong!";
        $messageType = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Management System</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            color: #333;
        }

        /* =========================
           HEADER
        ========================== */

        .header {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            padding: 25px 50px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.12);
        }

        .header-content {
            max-width: 1200px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 26px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 14px;
            opacity: 0.85;
            margin-top: 5px;
        }

        .student-count {
            background: rgba(255,255,255,0.18);
            padding: 10px 18px;
            border-radius: 30px;
            font-size: 14px;
        }

        /* =========================
           MAIN CONTAINER
        ========================== */

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* =========================
           FORM CARD
        ========================== */

        .card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }

        .card-title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #222;
        }

        .card-description {
            color: #777;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #444;
        }

        .form-group input,
        .form-group select {
            padding: 13px 15px;
            border: 1px solid #ddd;
            border-radius: 9px;
            font-size: 14px;
            outline: none;
            transition: 0.3s;
            background: #fafafa;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #6366f1;
            background: white;
            box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
        }

        .submit-area {
            margin-top: 25px;
        }

        .btn-submit {
            border: none;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            padding: 13px 28px;
            border-radius: 9px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(79,70,229,0.3);
        }

        /* =========================
           ALERT
        ========================== */

        .alert {
            padding: 14px 18px;
            border-radius: 9px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* =========================
           TABLE CARD
        ========================== */

        .table-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .table-title {
            font-size: 22px;
            font-weight: bold;
        }

        .table-subtitle {
            color: #777;
            font-size: 14px;
            margin-top: 5px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        thead {
            background: #f8fafc;
        }

        th {
            padding: 15px;
            text-align: left;
            font-size: 13px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e5e7eb;
        }

        td {
            padding: 16px 15px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        tbody tr {
            transition: 0.2s;
        }

        tbody tr:hover {
            background: #f8faff;
        }

        /* =========================
           ID BADGE
        ========================== */

        .id-badge {
            background: #eef2ff;
            color: #4f46e5;
            padding: 6px 10px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 12px;
        }

        /* =========================
           GENDER BADGE
        ========================== */

        .gender {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: capitalize;
        }

        .male {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .female {
            background: #fce7f3;
            color: #be185d;
        }

        .other {
            background: #ede9fe;
            color: #6d28d9;
        }

        /* =========================
           ACTION BUTTONS
        ========================== */

        .actions {
            display: flex;
            gap: 8px;
        }

        .btn {
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: bold;
            transition: 0.3s;
        }

        .edit {
            background: #e0f2fe;
            color: #0369a1;
        }

        .edit:hover {
            background: #bae6fd;
        }

        .delete {
            background: #fee2e2;
            color: #dc2626;
        }

        .delete:hover {
            background: #fecaca;
        }

        /* =========================
           FOOTER
        ========================== */

        footer {
            text-align: center;
            padding: 30px;
            color: #888;
            font-size: 13px;
        }

        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 768px) {

            .header {
                padding: 20px;
            }

            .header-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .container {
                margin: 25px auto;
            }

            .card,
            .table-card {
                padding: 20px;
            }

            .table-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

        }

    </style>

</head>

<body>


<!-- =========================
     HEADER
========================== -->

<header class="header">

    <div class="header-content">

        <div>

            <div class="logo">
                🎓 Student Management System
            </div>

            <div class="subtitle">
                Manage your students efficiently
            </div>

        </div>

        <div class="student-count">
            📚 Student Records
        </div>

    </div>

</header>


<!-- =========================
     MAIN
========================== -->

<div class="container">


    <!-- ALERT -->

    <?php if ($message != "") { ?>

        <div class="alert <?php echo $messageType; ?>">

            <?php echo $message; ?>

        </div>

    <?php } ?>


    <!-- =========================
         ADD STUDENT
    ========================== -->

    <div class="card">

        <div class="card-title">
            ➕ Add New Student
        </div>

        <div class="card-description">
            Enter the student's information below.
        </div>


        <form method="post">

            <div class="form-grid">


                <div class="form-group">

                    <label>Student Name</label>

                    <input
                        type="text"
                        name="name"
                        placeholder="Enter student name"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Email Address</label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Enter email address"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Age</label>

                    <input
                        type="number"
                        name="age"
                        placeholder="Enter age"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Gender</label>

                    <select name="gender" required>

                        <option value="">
                            Choose your gender
                        </option>

                        <option value="male">
                            Male
                        </option>

                        <option value="female">
                            Female
                        </option>

                        <option value="other">
                            Other
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label>Phone Number</label>

                    <input
                        type="text"
                        name="phone"
                        placeholder="Enter phone number"
                        required
                    >

                </div>

            </div>


            <div class="submit-area">

                <button
                    type="submit"
                    name="btn"
                    class="btn-submit"
                >
                    ➕ Add Student
                </button>

            </div>

        </form>

    </div>



    <!-- =========================
         STUDENT TABLE
    ========================== -->

    <div class="table-card">


        <div class="table-header">

            <div>

                <div class="table-title">
                    👥 Student Records
                </div>

                <div class="table-subtitle">
                    View, edit or delete student information
                </div>

            </div>

        </div>


        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Age</th>

                        <th>Gender</th>

                        <th>Phone</th>

                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>

                <?php

                $mysql = mysqli_query(
                    $con,
                    "SELECT * FROM student"
                );

                if (mysqli_num_rows($mysql) > 0) {

                    while ($data = mysqli_fetch_assoc($mysql)) {

                ?>

                    <tr>

                        <td>

                            <span class="id-badge">

                                #<?php echo $data['id']; ?>

                            </span>

                        </td>


                        <td>

                            <strong>

                                <?php echo htmlspecialchars($data['name']); ?>

                            </strong>

                        </td>


                        <td>

                            <?php echo htmlspecialchars($data['email']); ?>

                        </td>


                        <td>

                            <?php echo htmlspecialchars($data['age']); ?>

                        </td>


                        <td>

                            <span
                                class="gender <?php echo strtolower($data['gender']); ?>"
                            >

                                <?php echo htmlspecialchars($data['gender']); ?>

                            </span>

                        </td>


                        <td>

                            <?php echo htmlspecialchars($data['phone']); ?>

                        </td>


                        <td>

                            <div class="actions">

                                <a
                                    class="btn edit"
                                    href="edit.php?id=<?php echo $data['id']; ?>"
                                >
                                    ✏️ Edit
                                </a>


                                <a
                                    class="btn delete"
                                    href="delete.php?id=<?php echo $data['id']; ?>"
                                    onclick="return confirm('Are you sure you want to delete this student?');"
                                >
                                    🗑️ Delete
                                </a>

                            </div>

                        </td>

                    </tr>

                <?php

                    }

                } else {

                ?>

                    <tr>

                        <td
                            colspan="7"
                            style="text-align:center; padding:40px;"
                        >

                            <div style="font-size:40px;">
                                📭
                            </div>

                            <br>

                            <strong>
                                No Students Found
                            </strong>

                            <br>

                            <span style="color:#888;">
                                Add your first student using the form above.
                            </span>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>


<footer>

    Student Management System © <?php echo date('Y'); ?>

</footer>


</body>

</html>
