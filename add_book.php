<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
</head>
<body>
    <h2>Tambah Buku</h2>
    <form action="process_add_book.php" method="POST" enctype="multipart/form-data">
        <label>Judul Buku:</label><br>
        <input type="text" name="title" required><br><br>
        
        <label>Penulis:</label><br>
        <input type="text" name="author" required><br><br>
        
        <label>Tahun:</label><br>
        <input type="text" name="year" required><br><br>
        
        <label>Foto Buku:</label><br>
        <input type="file" name="photo"><br><br>
        
        <button type="submit" name="submit">Tambah Buku</button>
    </form>
</body>
</html>
