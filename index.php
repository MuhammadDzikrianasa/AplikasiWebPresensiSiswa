<!DOCTYPE html>
<html>
<head>
    <title>Presensi Siswa - Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Presensi Siswa</h1>

        <?php
        session_start();

        // Cek apakah pengguna sudah login, jika ya, alihkan ke halaman presensi
        if (isset($_SESSION['username'])) {
            header("Location: presensi.php");
            exit();
        }

        // Koneksi ke database
        $conn = mysqli_connect("localhost", "root", "", "presensi_siswa");

        // Cek koneksi
        if (mysqli_connect_errno()) {
            echo "Koneksi database gagal: " . mysqli_connect_error();
            exit();
        }

        // Jika form login disubmit
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Query untuk memeriksa login pengguna
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 1) {
                // Login berhasil, simpan username dalam session dan alihkan ke halaman presensi
                $_SESSION['username'] = $username;
                header("Location: home.php");
                exit();
            } else {
                echo "Username atau password salah.";
            }
        }
        ?>

        <h2>Login</h2>
        <form method="POST" action="index.php">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required><br>

            <input type="submit" name="login" value="Login">
        </form>

        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </div>
</body>
</html>
