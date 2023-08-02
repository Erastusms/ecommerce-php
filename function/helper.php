<?php

define("BASE_URL", "http://localhost/weshop/");

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
        if ($kategori_id == $row['kategori_id']) {
            $isActive = "active";
        }
        $string .= "<li>
              <a href='" . BASE_URL . "index.php?kategori_id=$row[kategori_id]' class='$isActive'>$row[kategori]</a>
              </li>";
    }

    $string .= "</ul></div>";

    return $string;
}