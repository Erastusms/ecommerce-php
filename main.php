<div id="kiri">
    <?php echo kategori($kategori_id); ?>
</div>

<div id="kanan">
    <div id="slides">
        <?php
        $queryBanner = mysqli_query($koneksi, "SELECT * FROM banner WHERE status='on' ORDER BY banner_id DESC LIMIT 3");
        while ($rowBanner = mysqli_fetch_assoc($queryBanner)) {
            echo "<a href='" . BASE_URL . "$rowBanner[link]'>
            <img src='" . BASE_URL . "images/slide/$rowBanner[gambar]' />";
        }
        ?>
    </div>
    <div id="frame-barang">
        <ul>
            <?php
            $query = "SELECT b.*, k.kategori FROM barang b JOIN kategori k ON b.kategori_id=k.kategori_id WHERE b.status='on' ";
            if ($kategori_id) {
                $query = $query . " AND b.kategori_id = '$kategori_id' ";
            }
            $query = $query . " ORDER BY rand() DESC";
            $queryAll = mysqli_query($koneksi, $query);

            $no = 1;
            while ($row = mysqli_fetch_assoc($queryAll)) {
                $kategori = strtolower($row["kategori"]);
                $barang = strtolower($row["nama_barang"]);
                $barang = str_replace(" ", "-", $barang);

                $style = false;
                if ($no == 3) {
                    $style = "style='margin-right:0px'";
                    $no = 0;
                }
                echo "
                <li $style>
                    <p class='price'>" . rupiah($row['harga']) . "</p>
                    <a href='" . BASE_URL . "$row[barang_id]/$kategori/$barang.html'>
                        <img src='" . BASE_URL . "images/barang/$row[gambar]' />
                    </a>
                    <div class='keterangan-gambar'>
                        <p>
                        <a href='" . BASE_URL . "$row[barang_id]/$kategori/$barang.html'>
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