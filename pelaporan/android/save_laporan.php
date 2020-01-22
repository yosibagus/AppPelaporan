<?php 

require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $a = $_POST['kd_kat'];
    $b = $_POST['foto_lap'];
    $c = $_POST['lokasi_lap'];
    $d = $_POST['ket_lap'];
    $e = $_POST['ktp_lap'];
    $f = $_POST['nm_lap'];
    $g = $_POST['notelp_lap'];

    $id = mysqli_insert_id($conn);
    $path = "assets/upload/1.jpeg";
    $q = mysqli_query($conn, "INSERT into tb_laporan values (null,'$a','$path','$c','$d','$e','$f','$g',null,'Diterima')");

    if ($q) {
        file_put_contents($path, base64_decode($b));
        $response["success"] = true;
        $response["message"] = "Successfully";
    }else {
        $response["success"] = false;
        $response["message"] = "Failure!";
    }
}else {
    $response["success"] = false;
    $response["message"] = "Error!";
}

echo json_encode($response);

?>