<?php
class Restoran
{
    public $nama_restoran;
    public $menu_minuman;
    public $harga_minuman;
    public $pesanan_menu;
    public $pesanan_jumlah;
    public $pesanan_harga;

    public function __construct($nama_restoran)
    {
        $this->nama_restoran = $nama_restoran;
        $this->menu_minuman = ["Es Coklat BESAR", "Es Coklat KECIL", "Es Coklat SEDANG", "ROTI Tawar"];
        $this->harga_minuman = [15000, 12000, 10000, 5000];
        $this->pesanan_menu = [];
        $this->pesanan_jumlah = [];
        $this->pesanan_harga = [];
    }

    public function show_menu()
    {
        echo "<ul>";
        for ($i = 0; $i < count($this->menu_minuman); $i++) {
            $menu = $this->menu_minuman[$i];
            $harga = $this->harga_minuman[$i];
            echo "<li>$menu - Rp. $harga</li>";
        }
        echo "</ul>";
    }

    public function tambah_pesanan($pilihan_menu, $jumlah)
    {
        if ($pilihan_menu > 0 && $pilihan_menu < 5) {
            $menu = $this->menu_minuman[$pilihan_menu - 1];
            $harga = $this->harga_minuman[$pilihan_menu - 1];
            $total_harga = $jumlah * $harga;
            $this->pesanan_menu[] = $menu;
            $this->pesanan_jumlah[] = $jumlah;
            $this->pesanan_harga[] = $total_harga;
            echo "<p>$jumlah porsi $menu berhasil ditambahkan ke pesanan Anda!</p>";
        } else {
            echo "<p>Menu tidak tersedia, silakan pilih kembali.</p>";
        }
    }

    public function lihat_pesanan()
    {
        if (count($this->pesanan_menu) > 0) {
            echo "<ul>";
            for ($i = 0; $i < count($this->pesanan_menu); $i++) {
                $menu = $this->pesanan_menu[$i];
                $jumlah = $this->pesanan_jumlah[$i];
                $harga = $this->pesanan_harga[$i];
                echo "<li>$menu - x$jumlah - Rp. $harga</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Keranjang pesanan kosong.</p>";
        }
    }

    public function hitung_total_harga()
    {
        return array_sum($this->pesanan_harga);
    }

    public function diskon()
    {
        $total_harga = $this->hitung_total_harga();
        if ($total_harga > 50000) {
            return $total_harga * 0.1;
        } else {
            return 0;
        }
    }

    public function hitung_total_harga_setelah_diskon()
    {
        return $this->hitung_total_harga() - $this->diskon();
    }

    public function struk_pembayaran()
    {
        echo "<h2>Pesanan Anda:</h2>";
        $this->lihat_pesanan();
        $total_harga = $this->hitung_total_harga();
        echo "<p>Total Harga: Rp. $total_harga</p>";
        if ($this->diskon() > 0) {
            $diskon = $this->diskon();
            $total_setelah_diskon = $this->hitung_total_harga_setelah_diskon();
            echo "<p>Diskon: Rp. $diskon</p>";
            echo "<p>Total Harga Setelah Diskon: Rp. $total_setelah_diskon</p>";
        } else {
            echo "<p>Anda tidak mendapatkan diskon.</p>";
        }
        echo "<p>Terima kasih telah memesan di SOKLAT, silakan datang kembali!</p>";
    }
}
?>
