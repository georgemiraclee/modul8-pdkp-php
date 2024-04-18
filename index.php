<?php
include 'Restoran.php';

session_start();

if (!isset($_SESSION['restoran'])) {
    $_SESSION['restoran'] = new Restoran("Roti Coklat");
}

$restoran = $_SESSION['restoran'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tambah_pesanan'])) {
        $pilihan_menu = $_POST['menu'];
        $jumlah_porsi = $_POST['jumlah'];
        $restoran->tambah_pesanan($pilihan_menu, $jumlah_porsi);
    } elseif (isset($_POST['selesai_pesan'])) {
        $restoran->hitung_total_harga();
        header("Location: selesai.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modul 8- GUI Programming</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <header class="bg-dark text-white py-4">
        <div class="container text-center">
            <h2 class="mb-1">ES Coklat Tumbuh Dewasa</h2>
        </div>
    </header>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Daftar Menu</h2>
        <?php $restoran->show_menu(); ?>
        <h2 class="text-center mb-4">Keranjang Pesanan</h2>
        <?php $restoran->lihat_pesanan(); ?>
        <h2 class="text-center mb-4">Form Pemesanan</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="menu">Pilih Menu :</label>
                <select name="menu" id="menu" class="form-control">
                    <option value="1">Es Coklat Besar</option>
                    <option value="2">Es Coklat Kecil</option>
                    <option value="3">Es Tawar</option>
                    <option value="4">Roti Tawar</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah Porsi :</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" value="1">
            </div>
            <button type="submit" name="tambah_pesanan" class="btn btn-primary">Tambahkan ke Keranjang</button>
        </form>
        <form method="POST" action="">
            <button type="submit" name="selesai_pesan" class="btn btn-success mt-3">Selesai Memesan</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
