<?php

    define("BASE_URL", "http://localhost/weshop/");

    function rupiah($nilai = 0) {
        return "Rp. " . number_format($nilai);
    }
