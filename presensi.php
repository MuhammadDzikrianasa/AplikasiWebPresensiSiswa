<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="header">
        <h2>Portal SMA NEGERI 1</h2>
        </div>

        <div class="topnav">
          <a href="home.php">Home</a>
          <a href="presensi.php">Presensi Siswa</a>
        </div>

        <div class="row">
          <div class="leftcolumn">
            <div class="card">
              <h2>Presensi Siswa</h2>
               <?php
    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "presensi_siswa");

    // Cek koneksi
    if (mysqli_connect_errno()) {
        echo "Koneksi database gagal: " . mysqli_connect_error();
        exit();
    }

    // Jika form disubmit
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $tanggal = date('Y-m-d');
        $hadir = $_POST['hadir'];

        // Query untuk memasukkan data presensi siswa
        $query = "INSERT INTO siswa (nama, tanggal, hadir) VALUES ('$nama', '$tanggal', '$hadir')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Presensi siswa berhasil ditambahkan.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    ?>

    <h2>Presensi Hari Ini</h2>
    <table>
        <tr>
            <th>No.</th>
            <th>Nama Siswa</th>
            <th>Tanggal</th>
            <th>Hadir</th>
        </tr>

        <?php
        // Query untuk mendapatkan data presensi siswa hari ini
        $query = "SELECT * FROM siswa WHERE tanggal = CURDATE()";
        $result = mysqli_query($conn, $query);

        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $no . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['tanggal'] . "</td>";
            echo "<td>" . ($row['hadir'] ? 'Ya' : 'Tidak') . "</td>";
            echo "</tr>";
            $no++;
        }

        // Tutup koneksi database
        mysqli_close($conn);
        ?>
    </table>

    <h2>Tambah Presensi</h2>
    <form method="POST">
        <label for="nama">Nama Siswa:</label>
        <input type="text" name="nama" required><br>

        <label for="hadir">Hadir:</label>
        <input type="checkbox" name="hadir" value="1"><br>

        <input type="submit" name="submit" value="Submit">
    </form>
            </div>
          </div>
        </div>
        <div class="footer">
          <p>Copyright 2023</p>
        </div>
    </body>
</html>
