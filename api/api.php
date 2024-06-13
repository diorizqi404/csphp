<?php
    include "koneksi.php";
    $aksi = @$_REQUEST['aksi'];
    switch($aksi){
        case 'view_siswa':
            $sql = "SELECT nis, nama, jk, kelas  FROM siswa";
            $query = mysqli_query($connect, $sql);
            $data = array();
            $x = 0;
            while($hasil = mysqli_fetch_assoc($query)){
                $data['siswa'][$x] = $hasil;
                $x++;
            }
            $data['message'] = 'ok';
            header('Content-Type: application/json; charset=utf-8');
            print json_encode($data);

            break;

        case 'insert_siswa':
            $nis = $_REQUEST['nis'];
            $nama = $_REQUEST['nama'];
            $jk = $_REQUEST['jk'];
            $kelas = $_REQUEST['kelas'];
            $sql = "INSERT INTO siswa (nis, nama, jk, kelas) VALUES ('$nis', '$nama', '$jk', '$kelas')";
            $query = mysqli_query($connect, $sql);
            if($query){
                $data['message'] = 'ok';
            }else{
                $data['message'] = 'gagal';
            }
            header('Content-Type: application/json; charset=utf-8');
            print json_encode($data);
            break;

        case 'update_siswa':
            $nis = $_REQUEST['nis'];
            $nama = $_REQUEST['nama'];
            $jk = $_REQUEST['jk'];
            $kelas = $_REQUEST['kelas'];
            $sql = "UPDATE siswa SET nama = '$nama', jk = '$jk', kelas = '$kelas' WHERE nis = '$nis'";
            $query = mysqli_query($connect, $sql);
            if($query){
                $data['message'] = 'ok';
            }else{
                $data['message'] = 'gagal';
            }
            header('Content-Type: application/json; charset=utf-8');
            print json_encode($data);
            break;
        
        case 'delete_siswa':
            $nis = $_REQUEST['nis'];
            $sql = "DELETE FROM siswa WHERE nis = '$nis'";
            $query = mysqli_query($connect, $sql);
            if($query){
                $data['message'] = 'ok';
            }else{
                $data['message'] = 'gagal';
            }
            header('Content-Type: application/json; charset=utf-8');
            print json_encode($data);
            break;
    }


?>