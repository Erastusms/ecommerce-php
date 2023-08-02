<div id="kiri">
    <div id="menu-kategori">
        <ul>
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE status='on'");

            while ($row = mysqli_fetch_assoc($query)) {
                $isActive = "";
                if ($kategori_id == $row['kategori_id']) {
                    $isActive = "active";
                }
                echo "<li>
                      <a href='" . BASE_URL . "index.php?kategori_id=$row[kategori_id]' class='$isActive'>$row[kategori]</a>
                      </li>";
            }
            ?>
        </ul>
    </div>
</div>

<div id="kanan">
    <div id="frame-barang">
        <ul>
            <?php
            $query = "SELECT * FROM barang WHERE status='on' ";
            if ($kategori_id) {
                $query = $query . " AND kategori_id = '$kategori_id' ";
            }
            $query = $query . " ORDER BY rand() DESC";
            $queryAll = mysqli_query($koneksi, $query);

            $no = 1;
            while ($row = mysqli_fetch_assoc($queryAll)) {
                $style = false;
                if ($no == 3) {
                    $style = "style='margin-right:0px'";
                    $no = 0;
                }
                echo "
                <li $style>
                    <p class='price'>" . rupiah($row['harga']) . "</p>
                    <a href='" . BASE_URL . "index.php?page=detail&barang_id=$row[barang_id]'>
                        <img src='" . BASE_URL . "images/barang/$row[gambar]' />
                    </a>
                    <div class='keterangan-gambar'>
                        <p>
                        <a href='" . BASE_URL . "index.php?page=detail&barang_id=$row[barang_id]'>
                        $row[nama_barang]
                        </a>
                        </p>
                        <span>Stok: $row[stok]</span>
                    </div>
                    <div class='button-add-cart'>
                        <p>
                        <a href='" . BASE_URL . "tambah_keranjang.php?barang_id=$row[barang_id]'>
                        +Add to Cart
                        </a>
                        </p>
                        <span>Stok: $row[stok]</span>
                    </div>
                </li>";
                $no++;
            }
            ?>
        </ul>
    </div>
</div>