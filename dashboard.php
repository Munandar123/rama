<?php
session_start(); // Memulai sesi
include 'config.php';

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Query untuk mengambil daftar buku
$query = "SELECT * FROM books ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

// Pastikan query berhasil
if (!$result) {
    die("Error dalam menjalankan query: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            width: 150px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Selamat Datang, <?php echo $_SESSION['username']; ?>!</h1>
    <p>Ini adalah dashboard Anda.</p>
    <a href="add_book.php">Tambah Buku</a> | <a href="logout.php">Logout</a>
    <br><br>

    <h2>Daftar Buku</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Foto</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun</th>
            <th>Detail</th>
            <th>Edit</th>
            <th>Hapus</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td>
                <?php if ($row['photo']) { ?>
                    <img src="<?php echo $row['photo']; ?>" alt="Foto Buku">
                <?php } else { ?>
                    <img src="uploads/default.jpg" alt="Tidak ada foto">
                <?php } ?>
            </td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['author']; ?></td>
            <td><?php echo $row['year']; ?></td>
            <td><a href="view_book.php?id=<?php echo $row['id']; ?>">Lihat Detail</a></td>
            <td><a href="edit_book.php?id=<?php echo $row['id']; ?>">Edit</a></td>
            <td><a href="delete_book.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">Hapus</a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
