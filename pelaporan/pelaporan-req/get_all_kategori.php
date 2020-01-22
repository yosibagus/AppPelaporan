<?php 

include 'koneksi.php';
$kategori = array();

$kategori["error"] = false;
$kategori["message"] = "Berhasil mendapatkan data laporan";

$sql = "SELECT * FROM tb_kategori";
$res = mysqli_query($conn,$sql);
while($row = mysqli_fetch_object($res)){
	$kategori['kategori'][] = $row;
}
echo json_encode($kategori);