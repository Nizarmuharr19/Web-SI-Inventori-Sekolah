<?php
session_start();
include 'koneksi.php';

if (isset($_SESSION['login'])) {
    header("Location: index.php?page=dashboard");
    exit;
}

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$user' AND password='$pass'");
    if (mysqli_num_rows($query) > 0) {
        $userData = mysqli_fetch_assoc($query);
        $_SESSION['login'] = true;
        $_SESSION['username'] = $userData['username'];
        $_SESSION['nama_lengkap'] = $userData['nama_lengkap']; // tambahkan ini
        header("Location: index.php?page=dashboard");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login - Inventori Sekolah</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #e0f2f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 350px;
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #00695c;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            background: #00695c;
            color: white;
            padding: 10px;
            border: none;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #004d40;
        }

        .error {
            background: #ffebee;
            color: #d32f2f;
            padding: 10px;
            margin-bottom: 15px;
            text-align: center;
            border-radius: 6px;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <h2>Login Inventori</h2>
        <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Masuk</button>
        </form>
    </div>
</body>

</html>