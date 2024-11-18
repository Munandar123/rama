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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $photo = $book['photo']; 

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photo = 'uploads/' . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
    }

    $query = "UPDATE books SET title = ?, author = ?, year = ?, photo = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssisi", $title, $author, $year, $photo, $id);

    if ($stmt->execute()) {
        echo "Buku berhasil diperbarui.";
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Terjadi kesalahan saat memperbarui buku: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
</head>
<body>
    <h1>Edit Buku</h1>
    <form method="POST" enctype="multipart/form-data">
        <label>Judul:</label><br>
        <input type="text" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required><br><br>

        <label>Penulis:</label><br>
        <input type="text" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required><br><br>

        <label>Tahun:</label><br>
        <input type="number" name="year" value="<?php echo htmlspecialchars($book['year']); ?>" required><br><br>

        <label>Foto:</label><br>
        <input type="file" name="photo"><br>
        <?php if ($book['photo']) { ?>
            <img src="<?php echo $book['photo']; ?>" alt="Foto Buku" width="100"><br>
        <?php } else { ?>
            <p>Tidak ada foto saat ini.</p>
        <?php } ?>
        <br><br>

        <input type="submit" value="Simpan Perubahan">
    </form>
    <br>
    <a href="dashboard.php">Kembali ke Dashboard</a>
</body>
</html>
