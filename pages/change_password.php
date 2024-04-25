<?php
include '../php/change_pass.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="wrapper">
        <form method="POST" action="">
            <h1 class="mb-5">Login - HRIS</h1>
            <p class="fs-6 mb-0 ps-4">Please update your password.</p>
            <div class="input-box mt-3">
                <input name="username" id="username" type="email" placeholder="Username" value="<?php echo $userName ?>"
                    readonly>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input name="password" id="password" type="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <button type=" submit" id="updatePasswordButton" name="updatePasswordButton" class="btn mb-5">Login</button>
        </form>
    </div>
</body>

</html>