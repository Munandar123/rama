<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$query = "SELECT * FROM books WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if (!$book) {
    echo "Buku tidak ditemukan.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Buku</title>
</head>
<body>
    <h1>Detail Buku</h1>
    
    <table>
        <tr>
            <td><strong>Judul:</strong></td>
            <td><?php echo htmlspecialchars($book['title']); ?></td>
        </tr>
        <tr>
            <td><strong>Penulis:</strong></td>
            <td><?php echo htmlspecialchars($book['author']); ?></td>
        </tr>
        <tr>
            <td><strong>Tahun:</strong></td>
            <td><?php echo htmlspecialchars($book['year']); ?></td>
        </tr>
        <tr>
            <td><strong>Foto:</strong></td>
            <td>
                <?php if ($book['photo']) { ?>
                    <img src="<?php echo $book['photo']; ?>" alt="Foto Buku" width="150">
                <?php } else { ?>
                    <p>Tidak ada foto.</p>
                <?php } ?>
            </td>
        </tr>
    </table>
    
    <br>
    <a href="dashboard.php">Kembali ke Dashboard</a>
</body>
</html>
<?php
