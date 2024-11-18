<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];

    // Proses upload foto
    $photo = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photo_name = $_FILES['photo']['name'];
        $photo_tmp = $_FILES['photo']['tmp_name'];
        $photo_folder = 'uploads/' . $photo_name;

        // Pindahkan file ke folder uploads
        if (move_uploaded_file($photo_tmp, $photo_folder)) {
            $photo = $photo_folder;
        }
    }

    // Simpan data buku ke database
    $query = "INSERT INTO books (title, author, year, photo) VALUES ('$title', '$author', '$year', '$photo')";
    if (mysqli_query($conn, $query)) {
        echo "Buku berhasil ditambahkan!";
        header("Location: dashboard.php");
    } else {
        echo "Gagal menambahkan buku: " . mysqli_error($conn);
    }
}
?>
