<?php

define("BASE_URL", "http://localhost/weshop/");

$arrayStatusPesanan[0] = "Menunggu Pembayaran";
$arrayStatusPesanan[1] = "Pembayaran Sedang Di Validasi";
$arrayStatusPesanan[2] = "Lunas";
$arrayStatusPesanan[3] = "Pembayaran Di Tolak";

function rupiah($nilai = 0)
{
    return "Rp. " . number_format($nilai);
}

function kategori($kategori_id = false)
{
    global $koneksi;

    $string = "<div id='menu-kategori'><ul>";
    $query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE status='on'");

    while ($row = mysqli_fetch_assoc($query)) {
        $isActive = "";
        $kategori = strtolower(($row['kategori']));
        if ($kategori_id == $row['kategori_id']) {
            $isActive = "active";
        }
        $string .= "<li>
              <a href='" . BASE_URL . "$row[kategori_id]/$kategori.html' class='$isActive'>$row[kategori]</a>
              </li>";
    }

    $string .= "</ul></div>";

    return $string;
}

function admin_only($module, $level)
{
    if ($level != "superadmin") {
        $admin_pages = array("kategori", "barang", "kota", "user", "banner");
        if (in_array($module, $admin_pages)) {
            header("location: " . BASE_URL);
        }
    }
}