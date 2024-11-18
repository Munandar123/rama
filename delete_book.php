<?php
include 'config.php';

$id = $_GET['id'];

$query = "DELETE FROM books WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Buku berhasil dihapus.";
} else {
    echo "Terjadi kesalahan saat menghapus buku: " . $conn->error;
}

header("Location: dashboard.php");
exit();
?>
