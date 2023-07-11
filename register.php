<!DOCTYPE html>
<html>
<head>
    <title>Presensi Siswa - Daftar</title>
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

        // Jika form pendaftaran disubmit
        if (isset($_POST['register'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Query untuk memeriksa apakah username sudah digunakan
            $query = "SELECT * FROM users WHERE username='$username'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 0) {
                // Username belum digunakan, tambahkan pengguna baru ke database
                $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    echo "Pendaftaran berhasil. Silakan <a href='index.php'>login</a>.";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "Username sudah digunakan. Silakan pilih username lain.";
            }
        }
        ?>

        <h2>Pendaftaran</h2>
        <form method="POST" action="register.php">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required><br>

            <input type="submit" name="register" value="Daftar">
        </form>

        <p>Sudah punya akun? <a href="index.php">Login di sini</a></p>
    </div>
</body>
</html>
