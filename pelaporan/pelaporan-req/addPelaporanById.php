<?php 

include 'koneksi.php';

if ($conn) {
	$kd_kat = $_POST['kd_kat'];
	$lokasi = $_POST['lokasi_lap'];
	$ketlap = $_POST['ket_lap'];
	$ktp = $_POST['ktp_lap'];
	$namaLap = $_POST['nm_lap'];
	$notelp = $_POST['notelp_lap'];
	date_default_timezone_set('Asia/Jakarta');
	$tgl = date('d-m-Y h:i:s');
	$status = "Pending";
	$image = $_POST['foto_lap'];

	$number = rand(100,100000);
	$upload_path = '../assets/uploads/' . $ktp . $number . '.jpg';

	$sql = mysqli_query($conn, "INSERT INTO tb_laporan values(null, '$kd_kat', '$upload_path', '$lokasi', '$ketlap', '$tgl', '$status', '$ktp')");

	if ($sql) {
		file_put_contents($upload_path, base64_decode($image));
		echo json_encode(array('response' => "image success uploaded ..."));
	}
	else  {
		echo json_encode(array('response' => "upload image falied ..."));
	}

}