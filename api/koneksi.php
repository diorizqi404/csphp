<?php
        $connect = mysqli_connect("localhost", "root", "", "api_flutter");
        if(mysqli_connect_error()){
            echo "gagal koneksi karena : " . mysqli_connect_error();
        }
?>